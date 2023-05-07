<?php

namespace Database\Seeders;

use App\Models\clinic\Treatment;
use Illuminate\Database\Seeder;

class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $Treatments = [
            'Limpieza Dental',
            'Obturaciones',
            'Exodoncia Simple',
            'Exodoncia Complicada',
            'Cirugia Simple',
            'Cirugia Complicada',
            'Endoncia Monoradicular',
            'Endodoncia Multiradicular',
            'Reconstruccion Poste de Fibra de Vidrio',
            'Reconstruccion Forma Dentina',
            'Recosntruccion Incrustacion',
            'Corona Metal Porcelana',
            'Corona Porcelana',
            'Corona Ceromero',
            'Valplas Unilateral',
            'Valplas Bilateral',
            'Removible Convencional',
            'Protesis Completa',
            'Cirugia Periodontal',
            'Implantes',
            'Ortodoncia'
        ];

        $Prices = [
            25.00,
            30.00,
            25.00,
            50.00,
            50.00,
            100.00,
            125.00,
            175.00,
            70.00,
            90.00,
            200.00,
            100.00,
            200.00,
            225.00,
            300.00,
            600.00,
            300.00,
            125.00,
            200.00,
            1500.00,
            1500.00
        ];

        Treatment::factory(count($Treatments))->sequence(fn($sequence) => [
            'name' => $Treatments[$sequence->index],
            'price' => $Prices[$sequence->index]
        ])->create();

    }
}
