<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Invitado;

class RsvpForm extends Component
{
    public Invitado $invitado;
    
    public $asistira;
    public $cupos_confirmados;
    public $mensaje_novios;

    public function mount(Invitado $invitado)
    {
        $this->invitado = $invitado;
        $this->cupos_confirmados = $invitado->cupos_max;
    }

    protected function rules()
    {
        return [
            'asistira' => 'required|boolean',
            'cupos_confirmados' => 'required_if:asistira,true|integer|min:1|max:' . $this->invitado->cupos_max,
            'mensaje_novios' => 'nullable|string|max:500',
        ];
    }

    public function guardarRsvp()
    {
        $this->validate();

        if (!$this->asistira) {
            $this->cupos_confirmados = 0;
        }

        $this->invitado->update([
            'asistira' => $this->asistira,
            'cupos_confirmados' => $this->cupos_confirmados,
            'mensaje_novios' => $this->mensaje_novios,
            'confirmado_el' => now(),
        ]);
    }

    public function render()
    {
        return view('livewire.rsvp-form');
    }
}