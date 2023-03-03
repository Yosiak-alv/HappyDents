<?php

namespace Database\Seeders;

use App\Models\clinic\Patient;
use App\Models\clinic\PatientSystem;
use App\Models\clinic\System;
use Illuminate\Database\Seeder;

class PatientSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PatientSystem::factory(15)->sequence(fn($sqn) =>[
            'patient_id' => Patient::all(['id'])->random(),
            'system_id' => System::all(['id'])->random()
        ])->create();
    }
}
