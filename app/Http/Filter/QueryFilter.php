<?php

namespace App\Http\Filter;

use App\Http\Requests\QueryString;
use Illuminate\Database\Eloquent\Builder;

class QueryFilter 
{
    private $request;

    public function __construct(QueryString $request) {
        $this->request = $request;
    }

    public function filter(Builder $query)
    {
        if ($this->request->has('with')) {
            $query = WithFilter::addFilter($query, $this->request->get('with'));
        }
        if ($this->request->has('category')) {
            $query = CategoryFilter::addFilter($query, $this->request->get('category'));
        }
        if ($this->request->has('tags')) {
            $query = TagsFilter::addFilter($query, $this->request->get('tags'));
        }
        if ($this->request->has('diff_time')) {
            $query = DiffTimeFilter::addFilter($query, $this->request->get('diff_time'));
        }
        return $query;
    }
}