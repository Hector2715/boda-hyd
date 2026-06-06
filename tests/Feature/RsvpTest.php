<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Invitado;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
        $invitado = \App\Models\Invitado::create([
            'nombre_familia' => 'Familia Martínez',
            'token' => 'martinez456',
            'cupos_max' => 2,
        ]);

        // 2. Act & Assert: Simulamos el comportamiento del componente Livewire
        // Intentamos enviar que asistirán 3 personas (violando el límite de 2)
        \Livewire\Livewire::test(\App\Livewire\RsvpForm::class, ['invitado' => $invitado])
            ->set('asistira', true)
            ->set('cupos_confirmados', 3)
            ->call('guardarRsvp')
            ->assertHasErrors(['cupos_confirmados' => 'max']); 
            // Esperamos que falle la validación indicando que excedió el 'max'
    }
}