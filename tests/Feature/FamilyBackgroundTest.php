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

it('Comprobar si Existe Pagina de Antecedentes en Expediente de Paciente', function () {
    $response = $this->get('/paciente/antecedentes-familiares/19/edit');

    $response->assertStatus(302);
});

it('Si Antecedente Familiar No Existe Retorna Mensaje', function () {
    $response = $this->actingAs($this->user)->get('/pacientes/1');

    $response->assertStatus(404);
});

it('Permite Editar Antecedent Familiar Existente', function () {
    $response = $this->actingAs($this->user)->get('/paciente/antecedentes-familiares/19/edit');

    $response->assertStatus(404);
});

it('Permite Agregar Nuevo Antecedente Familiar', function () {
    $response = $this->get('/paciente/antecedentes-familiares/1');

    $response->assertStatus(302);
});

