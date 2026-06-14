<?php

namespace App\Livewire;

use App\Mail\RsvpRecibidoNotification;
use App\Models\Invitado;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

 // Asegura que tu clase Mailable esté importada aquí

class RsvpForm extends Component
{
    // Campos del formulario vinculados a la vista
    public $nombre_familia = '';

    public $cupos_confirmados = '';

    public $nombres_asistentes = '';

    public $mensaje_novios = '';

    public $aceptar_terminos = false; // El check de conformidad obligatorio

    // Mensaje de éxito tras enviar
    public $enviado = false;

    /**
     * Reglas de validación para evitar campos vacíos
     */
    protected function rules()
    {
        return [
            'nombre_familia' => 'required|string|max:255',
            'cupos_confirmados' => 'required|integer|min:1|max:20',
            'nombres_asistentes' => 'required|string|min:5',
            'mensaje_novios' => 'nullable|string|max:500',
            'aceptar_terminos' => 'accepted', // Obliga a que marquen el check
        ];
    }

    /**
     * Mensajes personalizados de error en español
     */
    protected $messages = [
        'nombre_familia.required' => 'Por favor, dinos el nombre de tu familia o grupo.',
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
        // 1. Ejecutar validaciones estrictas
        $this->validate();

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
        // 🌟 AQUÍ VA EL NUEVO BLOQUE CORREGIDO:
        try {
            // Enviamos el correo usando tu clase Mailable pasándole el modelo recién creado ($invitado)
            Mail::to([
                'hector14mejias@gmail.com',
                'tecnohogar2001@gmail.com'
            ])->send(new RsvpRecibidoNotification($invitado));

        } catch (\Exception $e) {
            // Guarda el error real en storage/logs/laravel.log por si necesitas auditarlo
            Log::error('Error enviando correo de boda: '.$e->getMessage());
        }

        // 4. Activar pantalla de éxito
        $this->enviado = true;
    }

    public function render()
    {
        // Renderiza usando el layout público de la invitación móvil
        return view('livewire.rsvp-form')
            ->layout('layouts.app');
    }
}
