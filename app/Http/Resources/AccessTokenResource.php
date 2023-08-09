<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'AccessTokenResource',
    properties: [
        new OAT\Property(
            property: 'token',
            type: 'string',
            example: '6|JeXDJdhmaQN4Nl3T3DaD9sE20PoPrdUx15W0m2eA'
        ),
        new OAT\Property(
            property: 'expires_at',
            type: 'datetime',
            example: '2023-08-09T03:22:18.000000Z'
        ),
        new OAT\Property(
            property: 'type',
            type: 'string',
            example: 'bearer'
        ),
    ]
)]
class AccessTokenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|Arrayable|JsonSerializable
    {
        return [
            'token' => $this->plainTextToken,
            'expires_at' => $this->accessToken->expires_at,
            'type' => 'bearer',
        ];
    }
}
