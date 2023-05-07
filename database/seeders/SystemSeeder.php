<?php

namespace Database\Seeders;

use App\Models\clinic\System;
use Illuminate\Database\Seeder;

class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $Systems = [
            'Sistema Nervioso',
            'Sistema Endocrino',
            'Sistema Circulatorio',
            'Sistema Digestivo',
            'Sistema Respiratorio',
            'Sistema Excretor',
            'Sistema Reproductor',
            'Sistema Muscular',
            'Sistema Esqueletico',
            'Sistema Inmunologico',
            'Sistema Linfatico',
            'Sistema Integumentario'
        ];

        System::factory(count($Systems))->sequence(fn ($sequence)=>[
            'name' => $Systems[$sequence->index]
        ])->create();
    }
}
