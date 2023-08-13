<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'CategoryResource',
    properties: [
        new OAT\Property(
            property: 'id',
            type: 'integer',
            example: 1
        ),
        new OAT\Property(
            property: 'uuid',
            type: 'string',
            example: '550e8400-e29b-41d4-a716-446655440000'
        ),
        new OAT\Property(
            property: 'name',
            type: 'string',
            example: 'to-do-list'
        ),
        new OAT\Property(
            property: 'created_at',
            type: 'datetime',
            example: '2022-08-27T16:14:46.000000Z'
        ),
        new OAT\Property(
            property: 'updated_at',
            type: 'datetime',
            example: '2022-08-27T16:14:46.000000Z'
        ),
    ]
)]
class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
