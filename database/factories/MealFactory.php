<?php

namespace Database\Factories;

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
        $data = [];
        foreach ($languages as $locale) {
            $data[$locale->locale] = [
                'title' => "Title na {$locale->locale}",
                'description' => "Description na {$locale->locale}"
            ];
        }
        return $data;
    }
}
