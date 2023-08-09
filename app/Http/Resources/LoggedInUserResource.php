<?php

namespace App\Http\Resources;

use App\Enums\TokenAbility;
use App\Models\User;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'LoggedInUserResource',
    properties: [
        new OAT\Property(
            property: 'user',
            type: 'object',
            ref: '#/components/schemas/UserResource'
        ),
        new OAT\Property(
            property: 'access_token',
            type: 'object',
            ref: '#/components/schemas/AccessTokenResource'
        ),
        new OAT\Property(
            property: 'refresh_token',
            type: 'object',
            ref: '#/components/schemas/AccessTokenResource'
        ),
    ]
)]
class LoggedInUserResource extends JsonResource
{
    /**
     * Create a new Resource instance.
     *
     * @param  User  $user
     * @return void
     */
    public function __construct(private User $user)
    {
        parent::__construct($user);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|Arrayable|JsonSerializable
    {
        $token = $this->user->createToken('access_token', [TokenAbility::ACCESS_API->value], now()->addMinutes(config('sanctum.expiration')));
        $refreshToken = $this->user->createToken('refresh_token', [TokenAbility::ISSUE_ACCESS_TOKEN->value], now()->addMinutes(config('sanctum.rt_expiration')));

        return [
            'user' => new UserResource($this->user),
            'access_token' => new AccessTokenResource($token),
            'refresh_token' => new AccessTokenResource($refreshToken),
        ];
    }
}
