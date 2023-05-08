<?php

namespace Database\Seeders;

use App\Models\clinic\BranchOffice;
use Illuminate\Database\Seeder;

class BranchOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $BranchOffice = [
            'Happy Dents San Miguel',
            'Happy Dents San Salvador'
        ];

        $Department = [
            'San Miguel',
            'San Salvador'
        ];

        $Address = [
            'Torre médica, local 12B',
            'Medicentro la Esperanza, local 211-C'
        ];

        BranchOffice::factory(count($BranchOffice))->sequence(fn($sequence) => [
            'name' => $BranchOffice[$sequence->index],
            'department' => $Department[$sequence->index],
            'address' => $Address[$sequence->index]
        ])->create();

    }
}
