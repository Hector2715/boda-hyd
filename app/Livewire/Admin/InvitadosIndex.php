<?php

namespace App\Livewire\Admin;

use App\Models\Invitado;
use Livewire\Component;
use Livewire\WithPagination;

class InvitadosIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    // Propiedades compartidas para Creación y Edición
    public $selectedInvitado = null;

    public $selected_id = null; // Para almacenar el ID del invitado seleccionado para edición

    public $isEditing = false; // Nos dice si el modal está en modo Crear o Editar

    // Campos del formulario vinculados con wire:model
    public $nombre_familia = '';

    public $cupos_confirmados = '';

    public $nombres_asistentes = '';

    public $asistira = 1;

    public $mensaje_novios = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Define las reglas de validación obligatorias para que no se vayan campos vacíos
     */
    protected function rules()
    {
        return [
            'nombre_familia' => 'required|string|max:255',
            'cupos_confirmados' => 'required|integer|min:1',
            'nombres_asistentes' => 'required|string|min:3',
            'asistira' => 'required|boolean',
            'mensaje_novios' => 'nullable|string|max:500',
        ];
    }

    /**
     * Mensajes de error personalizados en español
     */
    protected $messages = [
        'nombre_familia.required' => 'El nombre de la familia es obligatorio.',
        'cupos_confirmados.required' => 'Debes ingresar cuántas personas asisten.',
        'cupos_confirmados.min' => 'La cantidad mínima de asistentes debe ser 1.',
        'nombres_asistentes.required' => 'Escribe los nombres de las personas que asistirán.',
        'nombres_asistentes.min' => 'Los nombres de los asistentes deben ser más específicos.',
    ];

    /**
     * Prepara el modal para AGREGAR manualmente una nueva familia
     */
    public function iniciarCreacionManual()
    {
        $this->resetValidation();
        $this->reset(['nombre_familia', 'nombres_asistentes', 'cupos_confirmados', 'mensaje_novios', 'isEditing']);
        $this->asistira = 1;
        $this->cupos_confirmados = 1;
        $this->isEditing = false;

        // 🌟 ORDENAMOS ABRIR EL MODAL DESDE REGLAS CONTROLADAS
        $this->js("
            const modalEl = document.getElementById('#modalFormulario');
            if (modalEl) {
                const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
                modalInstance.show();
            }
        ");
    }

    public function seleccionarFamilia($id)
    {
        $this->resetValidation();
        $invitado = Invitado::findOrFail($id);

        $this->selected_id = $invitado->id;
        $this->nombre_familia = $invitado->nombre_familia;
        $this->nombres_asistentes = $invitado->nombres_asistentes;
        $this->cupos_confirmados = $invitado->cupos_confirmados;
        $this->asistira = $invitado->asistira;
        $this->mensaje_novios = $invitado->mensaje_novios;
        $this->isEditing = true;

        // 🌟 CARGAMOS LOS DATOS Y LUEGO PARAMOS EL MODAL EN PANTALLA
        $this->js("
            const modalEl = document.getElementById('modalFormulario');
            if (modalEl) {
                const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
                modalInstance.show();
            }
        ");
    }

    public function guardar()
    {
        $this->validate();

        if ($this->isEditing) {
            $invitado = Invitado::findOrFail($this->selected_id);
            $invitado->update([
                'nombre_familia' => $this->nombre_familia,
                'cupos_confirmados' => $this->cupos_confirmados,
                'nombres_asistentes' => $this->nombres_asistentes,
                'asistira' => $this->asistira,
                'mensaje_novios' => $this->mensaje_novios,
            ]);
            session()->flash('message', 'Familia actualizada correctamente.');
        } else {
            Invitado::create([
                'nombre_familia' => $this->nombre_familia,
                'cupos_confirmados' => $this->cupos_confirmados,
                'nombres_asistentes' => $this->nombres_asistentes,
                'asistira' => $this->asistira,
                'mensaje_novios' => $this->mensaje_novios,
                'confirmado_el' => now(),
            ]);
            session()->flash('message', 'Nueva familia registrada manualmente con éxito.');
        }

        // 🌟 CIERRE SEGURO EVITANDO ERRORES "NULL" EN CONSOLA
        $this->js("
                const modalEl = document.getElementById('modalFormulario');
                if (modalEl) {
                    const modalInstance = bootstrap.Modal.getInstance(modalEl);
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                }
                
                // Limpieza manual forzada de residuos de Bootstrap
                const backdrops = document.querySelectorAll('.modal-backdrop');
                backdrops.forEach(backdrop => backdrop.remove());
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            ");

        $this->reset(['nombre_familia', 'cupos_confirmados', 'nombres_asistentes', 'mensaje_novios', 'selected_id', 'isEditing']);
    }

    public function eliminarInvitado($id)
    {
        Invitado::findOrFail($id)->delete();
        session()->flash('message', 'Registro eliminado correctamente.');
    }

    public function render()
    {
        $totalConfirmados = Invitado::where('asistira', true)->sum('cupos_confirmados');
        $totalFamilias = Invitado::count();
        $totalCancelados = Invitado::where('asistira', false)->count();

        $invitados = Invitado::where('nombre_familia', 'like', '%'.$this->search.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.invitados-index', [
            'invitados' => $invitados,
            'totalConfirmados' => $totalConfirmados,
            'totalFamilias' => $totalFamilias,
            'totalCancelados' => $totalCancelados,
        ]);
    }
}
