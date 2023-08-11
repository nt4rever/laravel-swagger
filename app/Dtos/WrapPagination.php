<?php

namespace App\Dtos;

use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'WrapPagination',
    type: 'object',
    properties:
    [
        new OAT\Property(
            property: 'data',
            type: 'array',
            items: new OAT\Items()
        ),
        new OAT\Property(
            property: 'total',
            type: 'integer',
            example: 100
        ),
        new OAT\Property(
            property: 'page',
            type: 'integer',
            example: 1
        ),
        new OAT\Property(
            property: 'per_page',
            type: 'integer',
            example: 10
        ),
        new OAT\Property(
            property: 'has_next',
            type: 'bool',
            example: true
        ),
        new OAT\Property(
            property: 'has_prev',
            type: 'bool',
            example: false
        ),
    ]
)]
class WrapPagination
{
    public $data;

    public $total;

    public $page;

    public $per_page;

    public $has_next;

    public $has_prev;

    public function __construct(
        $collection
    ) {
        $this->data = $collection->items();
        $this->total = $collection->total();
        $this->page = $collection->currentPage();
        $this->per_page = $collection->perPage();
        $this->has_next = (bool) $collection->nextPageUrl();
        $this->has_prev = (bool) $collection->previousPageUrl();
    }
}
