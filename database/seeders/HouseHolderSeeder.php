<?php

namespace Database\Seeders;

use App\Models\HouseHolder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HouseHolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HouseHolder::factory()->count(10)->create();
    }
}
