<?php

namespace Database\Seeders;

use App\Models\clinic\FamilyBackground;
use App\Models\clinic\Patient;
use App\Models\clinic\System;
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
