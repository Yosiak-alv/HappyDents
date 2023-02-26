<?php

namespace Database\Seeders;

use App\Models\Diagnostic;
use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
