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
            'data.attributes.categories.*' => 'exists:categories,id',
        ];
    }


    public function messages(): array
    {
        return [
            "data.attributes.name.required" => 'The name field is required ',
            "data.attributes.name.string" => 'The name field must be a string',

            "data.attributes.description.required" => 'The description field is required',
            "data.attributes.description.string" => 'The description field must be a string',

            "data.attributes.quantity.required" => 'The quantity field is required',
            "data.attributes.quantity.integer" => 'The quantity must be an integer',

            "data.attributes.comment.string" => 'The comment has to be a string',

            "data.attributes.projects.array" => 'The projects field has to be an array',
            "data.attributes.projects.max" => 'Maximum projects number was reached',

            'data.attributes.categories.*.exists' => 'Selected category does not exists',
        ];
    }
}
