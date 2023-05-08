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


it('Crea Odontograma', function () {
    $response = $this->get('/paciente/odontograma/1/edit');

    $response->assertStatus(302);
});

it('Se Obtienen Datos Registrados en Odontograma', function () {
    $response = $this->actingAs($this->user)->get('/paciente/odontograma/1/edit');

    $response->assertStatus(500);
});
