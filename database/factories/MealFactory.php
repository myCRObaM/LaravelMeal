<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Language;
use App\Models\Meal;
use Illuminate\Database\Eloquent\Factories\Factory;

class MealFactory extends Factory
{

    protected $model = Meal::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $languages = Language::all();
        $categories = Category::all();

        $randomNumber = rand(0, (count($categories) * 2));

        $data = array();

        if ($randomNumber < count($categories)) {
            $data['category_id'] = $categories[$randomNumber]->id;
        }

        foreach ($languages as $locale) {
            $data[$locale->locale] = [
                'title' => "Title na {$locale->locale}",
                'description' => "Description na {$locale->locale}"
            ];
        }
        return $data;
    }
}
