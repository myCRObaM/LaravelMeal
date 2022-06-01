<?php

namespace App\Http\Filter;

use App\Interfaces\IFilter;
use Illuminate\Database\Eloquent\Builder;

class TagsFilter implements IFilter
{
    public static function addFilter(Builder $query, string $parameter)
    {
        $got = explode(',', $parameter);

        foreach ($got as $tag) {
            $query = $query->whereHas('tags', function ($q) use ($tag) {
                $q = $q->where('tag_id', '=', $tag);
            });
        }

        return $query;
    }
}
