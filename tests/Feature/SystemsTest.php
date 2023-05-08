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

it('Comprueba que existe la Pagina de Sistemas en Expediente de Paciente', function () {
    $response = $this->get('/pacientes/1');

    $response->assertStatus(302);
});

it('Se Obtienen los Sistemas con sus Respectivas Condiciones', function () {
    $response = $this->actingAs($this->user)->get('/pacientes/1');

    $response->assertStatus(404);
});

it('Permite Editar Condicion de Sistemas de un Paciente', function () {
    $response = $this->get('/paciente/sistema/1/edit');

    $response->assertStatus(302);
});


