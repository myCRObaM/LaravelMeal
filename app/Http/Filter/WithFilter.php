<?php

namespace App\Http\Filter;

use App\Interfaces\IFilter;
use Illuminate\Database\Eloquent\Builder;

class WithFilter implements IFilter
{
    private static $possible = array(
        'ingredients',
        'category',
        'tags'
    );

    public static function addFilter(Builder $query, string $parameter)
    {
        $got = array_intersect(self::$possible, explode(',', $parameter));
        $query = $query->with($got);
        return $query;
    }
}