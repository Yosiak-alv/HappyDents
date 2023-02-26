<?php

namespace Database\Seeders;

use App\Models\Hospitalization;
use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HospitalizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hospitalization::factory(10)->sequence(fn($sqn) => [
            'patient_id' => Patient::all(['id'])->random(),

        ])->create();
    }
}
