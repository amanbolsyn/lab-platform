<?php

namespace App\Http\Requests\Api\v1\Item;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "data.attributes.name" => 'required|string',
            "data.attributes.description" => 'required|string',
            "data.attributes.quantity" => 'required|integer',
            "data.attributes.comment" => 'string',
            "data.attributes.projects" => 'array|max:5',
            "data.attributes.categories" => 'array',

            'relationships.categories.*' => 'exists:categories,id',
        ];
    }

    public function attributes(): array
    {
        return [
            "data.attributes.name" => 'name',
            "data.attributes.description" => 'description',
            "data.attributes.quantity" => 'quantity',
            "data.attributes.comment" => 'comment',
            "data.attributes.projects" => 'projects',

            'relationships.categories.*' => 'categories',
        ];
    }
}
