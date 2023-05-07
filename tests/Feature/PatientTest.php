<?php
use App\Models\clinic\BranchOffice;
use App\Models\clinic\Patient;
use App\Models\Role;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

beforeEach(function () {
    BranchOffice::factory()->create();
    Role::factory()->create([
        'type' => 'administrador'
    ]);
    $this->user = User::factory()->create();
});

it('Contolador de Pacientes Funcional', function () {
    $response = $this->get('/pacientes');

    $response->assertStatus(302);
});

it('Se Obtienen los Pacientes Registrados', function () {
    $response = $this->actingAs($this->user)->get('/pacientes');

    $response->assertStatus(200);
});

it('Si Paciente No Existe Retorna Mensaje', function () {
    $response = $this->actingAs($this->user)->get('/pacientes/1');

    $response->assertStatus(404);
});

it('Permite Ver Datos de un Paciente', function () {
    Patient::factory()->create();
    $response = $this->actingAs($this->user)->get('/pacientes/1');

    $response->assertStatus(200);
});

it('Permite Crear un Paciente', function () {

    $response = $this->actingAs($this->user)->followingRedirects()->post('/pacientes', [
        'dui' => '70817762-1',
        'name' => 'Luis',
        'lastname' => 'Bonilla',
        'genre' => 'Hombre',
        'branch_office_id' => '1',
        'email' => 'luis@example.com',
        'phone' => '7052-4111',
        'second_phone' => '7850-4306',
        'address' => 'mi casa',
        'occupation' => 'nini',
        'birthdate' => '09/08/2001',
        'contact_name' => 'Diego',
        'contact_phone' => '2270-6049',
        'contact_email' => 'diego@example.com'
    ]);
    //$response->assertStatus(303);
    $response->assertInertia(fn (Assert $page) => $page->where('flash.level', 'success'));
});
