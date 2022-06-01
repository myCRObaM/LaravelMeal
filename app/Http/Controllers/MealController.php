<?php

namespace App\Http\Controllers;

use App\Http\Filter\QueryFilter;
use App\Http\Requests\QueryString;
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

    public function indexFiltered(QueryString $request, QueryFilter $queryFilter)
    {
        app()->setLocale($request->query('lang'));

        $mealQuery = Meal::query();
        $mealQuery = $queryFilter->filter($mealQuery);

        return $mealQuery->paginate($request->get('per_page'));
    }
}
