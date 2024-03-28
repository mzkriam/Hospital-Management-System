<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Section::factory()->count(5)->create();
    }
}
