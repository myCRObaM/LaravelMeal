<?php

namespace App\Http\Filter;

use App\Interfaces\IFilter;
use Illuminate\Database\Eloquent\Builder;

class DiffTimeFilter implements IFilter
{
    public static function addFilter(Builder $query, string $parameter)
    {
        $time = new \DateTime();
        $time->setTimestamp($parameter);

        $query = $query->withTrashed()
            ->where('created_at', '>', $time)
            ->orWhere('updated_at', '>', $time)
            ->orWhere('deleted_at', '>', $time);
            
        return $query;
    }
}
