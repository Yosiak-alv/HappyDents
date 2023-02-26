<?php

namespace Database\Seeders;

use App\Models\Detention;
use App\Models\Odontogram;
use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OdontogramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patients = Patient::all(['id']);
        $detention = Detention::all(['id']);
        Odontogram::factory(10)->sequence(fn($sqn) => [
            'patient_id' => $patients->random(),
            'detention_id' => $detention->random()
        ])->create();
    }
}
