<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'administrador',
            'doctor',
            'asistente dental',
            'recepcionista'
        ];
        
        Role::factory(count($roles))->sequence(fn ($sqn) => ['type' => $roles[$sqn->index]])->create();
    }
}
