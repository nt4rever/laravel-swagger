<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'CategoryCreateRequest',
    required: ['user_id', 'name'],
    properties: [
        new OAT\Property(
            property: 'user_id',
            type: 'integer',
            example: '1'
        ),
        new OAT\Property(
            property: 'name',
            type: 'string',
            example: 'to-do-list'
        ),
    ]
)]
class CategoryCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (bool) $this->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => ['exists:users,id'],
            'name' => ['required', 'string'],
        ];
    }
}
