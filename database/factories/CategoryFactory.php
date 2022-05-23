<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
	    static $counter = 1;
        $languages = Language::all();
        $data = array('slug' => 'CATEGORY-'.$counter);
        
        foreach ($languages as $locale) {
            $data[$locale->locale] = [
                'title' => "Title category-{$counter} na {$locale->locale}"
            ];
        }
        $counter++;
        return $data;
    }
}
