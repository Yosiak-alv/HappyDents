<?php

namespace Database\Seeders;

use App\Models\clinic\BranchOffice;
use App\Models\clinic\Patient;
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
        $branches = BranchOffice::all(['id']);
        Patient::factory(25)->sequence(fn($sqn) =>[
            'branch_office_id' => $branches->random()
        ])->create();
    }
}