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

it('has users page', function () {
    $response = $this->get('/users');

    $response->assertStatus(302);
});

it('Se Obtienen los Usuarios Existentes', function () {
    $response = $this->actingAs($this->user)->get('/users');

    $response->assertStatus(200);
});

it('Si Usuario No Existe Retorna Mensaje', function () {
    $response = $this->actingAs($this->user)->get('/users/1');

    $response->assertStatus(403);
});

it('Permite Ver Datos de un Usuario', function () {
    User::factory()->create();
    $response = $this->actingAs($this->user)->get('/users/1');

    $response->assertStatus(403);
});

it('Permite Crear un Usuario', function () {

    $response = $this->actingAs($this->user)->followingRedirects()->post('/users', [
        'name' => 'prueba doctor',
        'email' => 'luis@example.com',
        'password' => 'password',
        'role_id' => '2'
    ]);

    $response->assertInertia(fn(Assert $page) => $page->where('flash.level', null));
});
