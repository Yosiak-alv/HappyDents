<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\System;
use App\Models\Treatment;
use App\Models\Visit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Visit::factory(20)->sequence(fn($sqn) =>[
            'patient_id' => Patient::all(['id'])->random(),
            'treatment_id' => Treatment::all(['id'])->random()
        ])->create();
    }
}
