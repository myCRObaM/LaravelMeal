<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Meal;
use App\Models\Tag;
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
        $ingredients = Ingredient::all();
        $tags = Tag::all();

        Meal::factory()->times(10)->create()->each(function ($meal) use ($ingredients,$tags) { 
            
            $randomIng = rand(0, (count($ingredients) * 2));
            $randomTag = rand(0, (count($tags) * 2));

            if ($randomIng < count($ingredients)) {
                $meal->ingredients()->saveMany(
                    $ingredients->random(rand(1, count($ingredients) / 3))
                );
            }

            if ($randomTag < count($tags)) {
                $meal->tags()->saveMany(
                    $tags->random(rand(1, count($tags) / 3))
                );
            }
    	});
    }
}
