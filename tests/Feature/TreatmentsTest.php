<?php
use App\Models\clinic\Treatment;
use App\Models\Role;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

beforeEach(function () {
    Role::factory()->create([
        'type' => 'administrador'
    ]);
    $this->user = User::factory()->create();
});

it('has treatments page', function () {
    $response = $this->get('/tratamientos');

    $response->assertStatus(302);
});

it('Se Obtienen los Tratamientos Registrados', function () {
    $response = $this->actingAs($this->user)->get('/tratamientos');

    $response->assertStatus(200);
});

it('Si Tratamiento No Existe Retorna Mensaje', function () {
    $response = $this->actingAs($this->user)->get('/tratamientos/1/edit');

    $response->assertStatus(404);
});

it('Permite Ver Datos de Tratamiento', function () {
    $response = $this->actingAs($this->user)->get('/tratamientos/1/edit');

    $response->assertStatus(404);
});

it('Permite Ver Datos de un Tratamiento', function () {
    Treatment::factory()->create();
    $response = $this->actingAs($this->user)->get('/tratamientos/1/edit');

    $response->assertStatus(200);
});

it('Permite Crear un Tratamiento', function () {

    $response = $this->actingAs($this->user)->followingRedirects()->post('/tratamientos', [
        'name' => 'prueba',
        'price' => 50.54
    ]);

    $response->assertInertia(fn(Assert $page) => $page->where('flash.level', 'success'));
});
