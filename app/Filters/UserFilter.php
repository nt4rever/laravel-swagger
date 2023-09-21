<?php

namespace App\Filters;

class UserFilter extends QueryFilter
{
    protected $filterable = [
        'myId' => 'id',
        'name',
        'email',
    ];

    public function filterName($name)
    {
        return $this->builder->where('name', 'ILIKE', '%' . $name . '%');
    }
}