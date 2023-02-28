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
        Treatment::factory(15)->create();
    }
}
