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
}