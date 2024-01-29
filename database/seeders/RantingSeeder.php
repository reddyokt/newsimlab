<?php

namespace Database\Seeders;

use App\Models\Ranting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RantingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Ranting::factory()->count(60)->create();
    }
}
