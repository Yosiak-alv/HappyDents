<?php

namespace Database\Seeders;

use App\Models\clinic\System;
use Illuminate\Database\Seeder;

class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        System::factory(5)->create();
    }
}
