<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Language;
use App\Models\Meal;
use Exception;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function index()
    {
        return Meal::all();
    }

    public function indexCreate(Request $request)
    {
        app()->setLocale('en');

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

        if ($request->has('category')) {
            $categoryFilter = strtolower($request->get('category'));
            if ($categoryFilter == "null") {
                $mealQuery = $mealQuery->whereNull('category_id');
            } else if ($categoryFilter == "!null") {
                $mealQuery = $mealQuery->WhereNotNull('category_id');
            } else {
                $mealQuery = $mealQuery->where('category_id', '=', $categoryFilter);
            }
        }

        if ($request->has('tags')) {
            $got = explode(',', $request->get('tags'));
            //$mealQuery = $mealQuery->where('tag_id', $got);
            foreach ($got as $tag) {
                $mealQuery = $mealQuery->whereHas('tags', function ($q) use ($tag) {
                    $q = $q->where('tag_id', '=', $tag);
                });
            }
        }

        if ($request->has('diff_time')) {
            $time = new \DateTime();
            $time->setTimestamp($request->get('diff_time'));

            $mealQuery = $mealQuery->withTrashed()
                ->where('created_at', '>', $time)
                ->orWhere('updated_at', '>', $time)
                ->orWhere('deleted_at', '>', $time);
        }

        return $mealQuery->paginate($paginate);
    }
}
