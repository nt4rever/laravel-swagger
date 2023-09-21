<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class QueryFilter
{
    /**
     * @var Request
     */
    public $request;

    /**
     * @var array
     */
    protected $filters;

    /**
     * @var array
     */
    protected $search;

    /**
     * @var $builder
     */
    protected $builder;

    /**
     * @var string|null
     */
    protected $orderFields = null;

    /**
     * @var string
     */
    protected $orderType = 'desc';

    /**
     * @var $filterable
     */
    protected $filterable;

    /**
     * QueryFilter constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->filters = $request->all();
    }

    /**
     * @param Builder $builder
     * @param array $filterFields
     * @param array $orderFields
     * @return Builder
     */
    public function apply(Builder $builder, array $filterFields, array $orderFields = [])
    {
        $this->builder = $builder;
        $this->orderFields = $orderFields;
        $subFilters = Arr::only($this->filters, $filterFields);

        foreach ($subFilters as $name => $value) {
            $method = 'filter' . Str::studly($name);

            if (is_null($value) || $value == '') {
                continue;
            }

            if (method_exists($this, $method)) {
                $this->{$method}($value);
                continue;
            }

            if (empty($this->filterable) || !is_array($this->filterable)) {
                continue;
            }

            if (in_array($name, $this->filterable)) {
                $this->builder->where($name, $value);
                continue;
            }

            if (key_exists($name, $this->filterable)) {
                $this->builder->where($this->filterable[$name], $value);
                continue;
            }
        }

        return $this->builder;
    }
}