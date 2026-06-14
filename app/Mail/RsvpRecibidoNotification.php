<?php

namespace App\Mail;

use App\Models\Invitado;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RsvpRecibidoNotification extends Mailable
{
    use Queueable, SerializesModels;

    // Propiedad pública para que esté disponible automáticamente en la vista Blade
    public Invitado $invitado;

    public function __construct(Invitado $invitado)
    {
        $this->invitado = $invitado;
    }

    public function envelope(): Envelope
    {
        // El asunto del correo cambiará dinámicamente según la respuesta del invitado
        $status = $this->invitado->asistira ? '✅ Confirmado' : '❌ Declinado';

        return new Envelope(
            subject: "RSVP Boda: {$status} - {$this->invitado->nombre_familia}",
        );

    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.rsvp-notification', // Ruta de la vista HTML del correo
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
