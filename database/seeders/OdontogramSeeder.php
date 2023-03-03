<?php

namespace Database\Seeders;

use App\Models\clinic\Detention;
use App\Models\clinic\Odontogram;
use App\Models\clinic\Patient;
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
