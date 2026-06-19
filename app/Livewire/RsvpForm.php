<?php

namespace App\Livewire;

use App\Mail\RsvpRecibidoNotification;
use App\Models\Invitado;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class RsvpForm extends Component
{
    // Campos del formulario vinculados a la vista
    public $nombre_familia = '';
    public $cupos_confirmados = '';
    public $nombres_asistentes = '';
    public $mensaje_novios = '';
    public $aceptar_terminos = false; 

    // Mensaje de éxito tras enviar
    public $enviado = false;

    /**
     * Reglas de validación base
     */
    protected function rules()
    {
        return [
            // 🔥 CANDADO 1: unique en la tabla invitados, columna nombre_familia
            'nombre_familia' => 'required|string|max:255|unique:invitados,nombre_familia',
            'cupos_confirmados' => 'required|integer|min:1|max:20',
            'nombres_asistentes' => 'required|string|min:5',
            'mensaje_novios' => 'nullable|string|max:500',
            'aceptar_terminos' => 'accepted', 
        ];
    }

    /**
     * Mensajes personalizados de error en español
     */
    protected $messages = [
        'nombre_familia.required' => 'Por favor, dinos el nombre de tu familia o grupo.',
        'nombre_familia.unique' => 'Ya existe una familia registrada con ese apellido. Por favor, sé más específico (ej. Martínez Rondón).',
        'cupos_confirmados.required' => 'Indica cuántas personas asistirán.',
        'cupos_confirmados.min' => 'La cantidad de asistentes debe ser al menos 1.',
        'nombres_asistentes.required' => 'Escribe los nombres de las personas que te acompañarán.',
        'nombres_asistentes.min' => 'Por favor, escribe los nombres completos de los asistentes.',
        'aceptar_terminos.accepted' => 'Debes marcar la casilla para confirmar que estás de acuerdo.',
    ];

    /**
     * Procesa la confirmación de asistencia
     */
    public function confirmarAsistencia()
    {
        // 1. Ejecutar las validaciones estándar (Aquí rebota si el apellido ya existe)
        $this->validate();

        // 🔥 CANDADO 2: Validar cantidad exacta de personas escritas
        // Limpiamos comas, saltos de línea o guiones comunes que use el invitado y los volvemos un array
        // Soportará formatos como: "Héctor, Daniela" o "Héctor - Daniela" o "Héctor\nDaniela"
        $asistentesArray = preg_split('/[,;\-\n\r]+/', $this->nombres_asistentes);
        
        // Eliminamos espacios en blanco extra de cada nombre y quitamos elementos vacíos
        $asistentesArray = array_filter(array_map('trim', $asistentesArray));

        // Contamos cuántas personas logramos extraer del string
        $totalPersonasEscritas = count($asistentesArray);

        if ($totalPersonasEscritas !== (int) $this->cupos_confirmados) {
            $this->addError('nombres_asistentes', "Seleccionaste {$this->cupos_confirmados} cupos, pero escribiste el nombre de {$totalPersonasEscritas} personas. Por favor, especifica exactamente los nombres separados por comas.");
            return;
        }

        // 2. Guardar el registro en la base de datos
        $invitado = Invitado::create([
            'nombre_familia' => $this->nombre_familia,
            'cupos_confirmados' => $this->cupos_confirmados,
            'nombres_asistentes' => $this->nombres_asistentes,
            'mensaje_novios' => $this->mensaje_novios,
            'asistira' => true,
            'confirmado_el' => now(),
        ]);

        // 3. Notificar a los novios por correo electrónico
        try {
            Mail::to([
                'hector14mejias@gmail.com',
                'danielamoralesr20@gmail.com',
            ])->send(new RsvpRecibidoNotification($invitado));

        } catch (\Exception $e) {
            Log::error('Error enviando correo de boda: '.$e->getMessage());
        }

        // 4. Activar pantalla de éxito
        $this->enviado = true;
    }

    public function render()
    {
        return view('livewire.rsvp-form')
            ->layout('layouts.app');
    }
}