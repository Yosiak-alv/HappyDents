<?php

namespace Database\Seeders;

use App\Models\FamilyBackground;
use App\Models\Patient;
use App\Models\System;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FamilyBackgroundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FamilyBackground::factory(10)->sequence(fn($sqn) => [
            'patient_id' => Patient::all(['id'])->random(),
            'system_id' => System::all(['id'])->random()
        ])->create();
    }
}
