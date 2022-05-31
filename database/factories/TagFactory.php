<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $counter = 1;
        $languages = Language::all();
        $data = array('slug' => 'TAG-'.$counter);
        
        foreach ($languages as $locale) {
            $data[$locale->locale] = [
                'title' => "Title tag-{$counter} na {$locale->locale}"
            ];
        }
        $counter++;
        return $data;
    }
}
