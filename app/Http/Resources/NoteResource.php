<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'NoteResource',
    properties: [
        new OAT\Property(property: 'uuid', type: 'string', example: '550e8400-e29b-41d4-a716-446655440000'),
        new OAT\Property(property: 'title', type: 'string', example: 'Hello World'),
        new OAT\Property(property: 'created_at', type: 'datetime', example: '2022-08-27T16:14:46.000000Z'),
        new OAT\Property(property: 'updated_at', type: 'datetime', example: '2022-08-27T16:14:46.000000Z'),
    ]
)]
class NoteResource extends JsonResource
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
            'uuid' => $this->uuid,
            'title' => $this->title,
            'content' => $this->contents(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
