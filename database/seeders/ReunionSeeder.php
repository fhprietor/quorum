<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReunionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Reunion::factory(5)->create();
    }
}
