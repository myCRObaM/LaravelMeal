<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Language;
use App\Models\Meal;
use Exception;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function index() {
        return Meal::all();
    }

    public function indexCreate(Request $request) {
        $meal = new Meal();
        app()->setLocale('en');
        
        /*
        try {
            foreach (['hr', 'en', 'nl', 'fr', 'de'] as $locale) {
                $language = new Language();
                $language->locale = $locale;
                $language->save();
            }
        } catch (Exception $e) {
            // ignore ako postoje podatci
        }

        $languages = Language::all();

        foreach ($languages as $locale) {
            $meal->translateOrNew($locale->id)->title = "Title na {$locale->locale}";
            $meal->translateOrNew($locale->id)->description = "Description na {$locale->locale}";
        }
        $meal->save();
        */
        $paginate = 20;
        $mealQuery = Meal::query();
        if ($request->has('per_page')) {
            $paginate = $request->get('per_page');
        }

        if ($request->has('with')) {
            $possible = array(
				'ingredients',
				'category',
				'tags'
			);

            $got = array_intersect($possible, explode(',', $request->get('with')));
            $mealQuery = $mealQuery->with($got);
        }
        

        return $mealQuery->paginate($paginate);
        return $mealQuery::all();
    }
}
