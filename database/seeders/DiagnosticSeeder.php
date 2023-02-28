<?php

namespace Database\Seeders;

use App\Models\clinic\Diagnostic;
use App\Models\clinic\Patient;
use Illuminate\Database\Seeder;

class DiagnosticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Diagnostic::factory(25)->sequence(fn($sqn) =>[
            'patient_id' => Patient::all(['id'])->random()
        ])->create();
    }
}
