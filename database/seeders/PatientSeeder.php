<?php

namespace Database\Seeders;

use App\Models\clinic\Detention;
use App\Models\clinic\Patient;
use App\Models\clinic\System;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dententions = Detention::select(['id'])->get(); //odontograma
        $patient_systems = System::select(['id'])->get(); //sistema paciente

        Patient::factory(10)->create()->each(function($patient) use ($dententions,$patient_systems){
            foreach($dententions->random(rand(1,$dententions->count())) as $dentention){
                $patient->detentions()->attach($dentention);
            }

            foreach($patient_systems->random(rand(1,$patient_systems->count())) as $patient_system){
                $patient->systems()->attach($patient_system);
            }
        });
    }
}
