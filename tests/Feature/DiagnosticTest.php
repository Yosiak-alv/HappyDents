<?php
use App\Models\clinic\Diagnostic;
use App\Models\Role;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

beforeEach(function () {
    Role::factory()->create([
        'type' => 'administrador'
    ]);
    $this->user = User::factory()->create();
});

it('Se Observan los Diagnosticos Registrados', function () {
    $response = $this->get('/paciente/diagnostico/1');

    $response->assertStatus(302);
});

it('Permite Agregar Nuevo Diagnostico', function () {
    $response = $this->actingAs($this->user)->get('/paciente/diagnostico/1');

    $response->assertStatus(200);
});

it('Si Diagnostico No Existe Retorna Mensaje', function () {
    $response = $this->actingAs($this->user)->get('/paciente/diagnostico/1/edit');

    $response->assertStatus(404);
});


