<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call([
            BranchOfficeSeeder::class,
            DetentionSeeder::class,
            TreatmentSeeder::class,
            SystemSeeder::class,

            PatientSeeder::class,
            DiagnosticSeeder::class,
            HospitalizationSeeder::class,
            
            FamilyBackgroundSeeder::class,
            VisitSeeder::class,

            RoleSeeder::class,
            UserSeeder::class
       ]);
    }
}
