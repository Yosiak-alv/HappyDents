<?php

namespace Database\Seeders;

use App\Models\clinic\Hospitalization;
use App\Models\clinic\Patient;
use Illuminate\Database\Seeder;

class HospitalizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hospitalization::factory(10)->create();
    }
}
