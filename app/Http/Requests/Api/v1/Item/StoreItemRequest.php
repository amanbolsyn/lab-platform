<?php

namespace App\Http\Requests\Api\v1\Item;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
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
            "data.attributes.name" => ['required', 'string'],
            "data.attributes.description" => ['required', 'string'],
            "data.attributes.stock" => ['required'],
            "data.attributes.comment" => ['string'],
            "data.attributes.project_links" => ['array', 'max:5'],


            "relationships.categories" => ['array'],
            "relationships.categories.*" => ['exists:categories,id', 'distinct'],

            "relationships.images" => ['array', 'max:10'],
            "relationships.images.*" => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }


    public function attributes(): array
    {
        return [
            "data.attributes.name" => 'name',
            "data.attributes.description" => 'description',
            "data.attributes.stock" => 'stock',
            "data.attributes.comment" => 'comment',
            "data.attributes.project_links" => 'project links',

            'relationships.categories' => 'categories',
            'relationships.categories.*' => 'categories',

            "relationships.images" => 'images',
            "relationships.images.*" => 'images',

        ];
    }
}
