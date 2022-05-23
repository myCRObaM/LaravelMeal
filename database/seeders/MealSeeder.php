<?php

namespace Database\Seeders;

use App\Models\Meal;
use Database\Factories\MealFactory;
use Illuminate\Database\Seeder;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Meal::factory()->times(10)->create();
    }
}
