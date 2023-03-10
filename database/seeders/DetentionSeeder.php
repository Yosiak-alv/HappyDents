<?php

namespace Database\Seeders;

use App\Models\clinic\Detention;
use Illuminate\Database\Seeder;

class DetentionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Detention::factory(5)->create();
    }
}
