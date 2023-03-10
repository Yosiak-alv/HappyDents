<?php

namespace Database\Seeders;

use App\Models\clinic\Patient;
use App\Models\clinic\Treatment;
use App\Models\clinic\Visit;
use Illuminate\Database\Seeder;

class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Visit::factory(20)->create();
    }
}
