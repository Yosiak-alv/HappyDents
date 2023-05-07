<?php
use App\Models\Role;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

beforeEach(function () {
    Role::factory()->create([
        'type' => 'administrador'
    ]);
    $this->user = User::factory()->create();
});

it('Permite Editar Hospitalizacion Existente', function () {
    $response = $this->get('/paciente/hospitalizacion/1/edit');

    $response->assertStatus(302);
});

it('Se Obtienen las Hospitalizaciones Registrados', function () {
    $response = $this->actingAs($this->user)->get('/paciente/hospitalizacion/1/edit');

    $response->assertStatus(404);
});

it('Permite Crear Hospitalizacion', function () {
    $response = $this->get('/paciente/hospitalizacion/1');

    $response->assertStatus(302);
});

