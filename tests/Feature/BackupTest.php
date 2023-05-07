<?php
use App\Models\Role;
use App\Models\User;

beforeEach(function () {
    Role::factory()->create([
        'type' => 'administrador'
    ]);
    $this->user = User::factory()->create();
});

it('has backup page', function () {
    $response = $this->get('/backupss');

    $response->assertStatus(302);
});

it('Se Obtienen los Respaldos Creados', function () {
    $response = $this->actingAs($this->user)->get('/backupss');

    $response->assertStatus(200);
});

it('Permite Crear Respaldos', function () {
    $response = $this->actingAs($this->user)->get('/backupss');

    $response->assertStatus(200);
});

