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
        BranchOffice::factory(2)->create();
    }
}
