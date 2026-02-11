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
            "data.attributes.name" => 'required|string',
            "data.attributes.description" => 'required|string',
            "data.attributes.quantity" => 'required|integer'
        ];
    }


    public function messages(): array
    {
        return [
            "data.attributes.name.required" => 'The name field is required ',
            "data.attributes.description.required" => 'The description field is required',
            "data.attributes.quantity.required" => 'The quantity field is required', 

            "data.attributes.name.string" => 'The name field must be a string',
            "data.attributes.description.string" => 'The description field must be a string',
            "data.attributes.quantity.integer" => 'The quantity must be an integer'
        ];
    }
}
