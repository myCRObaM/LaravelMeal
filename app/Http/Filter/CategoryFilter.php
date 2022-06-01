<?php

namespace App\Http\Filter;

use App\Interfaces\IFilter;
use Illuminate\Database\Eloquent\Builder;

class CategoryFilter implements IFilter
{
    public static function addFilter(Builder $query, string $parameter)
    {
        $categoryFilter = strtolower($parameter);
        if ($categoryFilter == "null") {
            $query = $query->whereNull('category_id');
        } else if ($categoryFilter == "!null") {
            $query = $query->WhereNotNull('category_id');
        } else {
            $query = $query->where('category_id', '=', $categoryFilter);
        }
        return $query;
    }
}