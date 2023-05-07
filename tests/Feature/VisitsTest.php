<?php
use App\Models\clinic\Visit;
use App\Models\Role;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

beforeEach(function () {
    Role::factory()->create([
        'type' => 'administrador'
    ]);
    $this->user = User::factory()->create();
});

it('has visits page', function () {
    $response = $this->get('/visitas');

    $response->assertStatus(302);
});

it('Se Obtienen las Visitas Registradas', function () {
    $response = $this->actingAs($this->user)->get('/visitas');

    $response->assertStatus(200);
});

it('Si Visita No Existe Retorna Mensaje', function () {
    $response = $this->actingAs($this->user)->get('/visitas/1/edit');

    $response->assertStatus(404);
});

it('Permite Ver Datos de Tratamiento', function () {
    $response = $this->actingAs($this->user)->get('/visitas/1/edit');

    $response->assertStatus(404);
});

it('Permite Registrar Visita', function () {
    $response = $this->get('/visitas');

    $response->assertStatus(302);
});
