<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Builder;

interface IFilter 
{
    public static function addFilter(Builder $query, string $parameter);
}