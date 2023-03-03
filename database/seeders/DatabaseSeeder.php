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
           PatientSeeder::class,
           DetentionSeeder::class,
           OdontogramSeeder::class,
           DiagnosticSeeder::class,
           HospitalizationSeeder::class,
           SystemSeeder::class,
           FamilyBackgroundSeeder::class,
           TreatmentSeeder::class,
           VisitSeeder::class,
           PatientSystemSeeder::class //da error , al hacerlo por separado si funciona
       ]);
    }
}
