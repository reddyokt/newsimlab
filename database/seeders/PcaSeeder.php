<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PCA;

class PcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        PCA::factory()->count(20)->create();
    }
}
