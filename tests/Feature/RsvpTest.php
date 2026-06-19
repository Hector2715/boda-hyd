<?php

namespace Tests\Feature;

use App\Livewire\RsvpForm;
use App\Mail\RsvpRecibidoNotification;
use App\Models\Invitado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Tests\TestCase;

class RsvpTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_token_valido_puede_cargar_la_invitacion_personalizada()
    {
        // 1. Arrange: Creamos el invitado simulado
        $invitado = Invitado::create([
            'nombre_familia' => 'Familia Pérez',
            'token' => 'token123',
            'cupos_max' => 4,
        ]);

        // 2. Act: Petición directa a la URL
        $response = $this->get('/invitacion/token123');

        // 3. Assert: Validamos estado y contenido
        $response->assertStatus(200);
        $response->assertSee('Familia Pérez');
    }

    public function test_un_token_invalido_retorna_un_error_404()
    {
        // Act
        $response = $this->get('/invitacion/token-falso');

        // Assert
        $response->assertStatus(404);
    }

    public function test_un_invitado_no_puede_confirmar_mas_cupos_de_los_permitidos()
    {
        // 1. Arrange: Creamos un invitado que solo tiene 2 pases asignados
        $invitado = Invitado::create([
            'nombre_familia' => 'Familia Martínez',
            'token' => 'martinez456',
            'cupos_max' => 2,
        ]);

        // 2. Act & Assert: Simulamos el comportamiento del componente Livewire
        // Intentamos enviar que asistirán 3 personas (violando el límite de 2)
        Livewire::test(RsvpForm::class, ['invitado' => $invitado])
            ->set('asistira', true)
            ->set('cupos_confirmados', 3)
            ->call('guardarRsvp')
            ->assertHasErrors(['cupos_confirmados' => 'max']);
        // Esperamos que falle la validación indicando que excedió el 'max'
    }

    public function test_un_correo_de_notificacion_es_enviado_cuando_un_invitado_confirma_su_rsvp()
    {
        // 1. Activamos el cascarón (Fake) de correos para congelar los despachos reales
        Mail::fake();

        // 2. Preparamos un invitado de prueba en la base de datos MariaDB
        $invitado = Invitado::create([
            'nombre_familia' => 'Familia Martínez',
            'token' => 'token-correo-test',
            'cupos_max' => 5,
        ]);

        // 3. Simulamos la interacción del componente Livewire enviando el formulario
        Livewire::test(RsvpForm::class, ['invitado' => $invitado])
            ->set('asistira', true)
            ->set('cupos_confirmados', 3)
            ->set('mensaje_novios', '¡Allí estaremos celebrando!')
            ->call('guardarRsvp');

        // 4. Afirmaciones (Asserts) de Oro:
        // Aseguramos que se envió exactamente UN correo en total
        Mail::assertSent(RsvpRecibidoNotification::class, 1);

        // Aseguramos que el correo fue enviado a la dirección correcta de los novios
        Mail::assertSent(RsvpRecibidoNotification::class, function ($mail) use ($invitado) {
            return $mail->hasTo('bodahectorydaniela@gmail.com') &&
                $mail->invitado->id === $invitado->id &&
                $mail->invitado->nombre_familia === 'Familia Martínez';
        });
    }
}
