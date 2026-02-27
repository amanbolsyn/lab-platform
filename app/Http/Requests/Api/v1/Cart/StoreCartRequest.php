<?php

namespace App\Http\Requests\Api\v1\Cart;

use Illuminate\Foundation\Http\FormRequest;

class StoreCartRequest extends FormRequest
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
            "data.attributes.dueDate" => ['required', 'date', 'date_format:Y-m-d'],
            "data.attributes.purpose" => ['required', 'string'],

            "included" => ['required', 'array'],
            "included.*.type" => ['required', 'in:order'],
            "included.*.attributes.quantity" => ['required', 'integer', 'min:1'],
            "included.*.attributes.id" => ['required', 'integer', 'exists:items,id']
        ];
    }

    public function messages(): array
    {
        return [
            "data.attributes.dueDate.required" => 'The due date field is required',
            "data.attributes.dueDate.date" => 'The due date field has to be a date',
            "data.attributes.dueDate.date_format" => 'The due date format is invalid',

            "data.attributes.purpose.required" => 'The purpose field is required',
            "data.attributes.purpose.string" => 'The purpose field has to be a string',
        ];
    }
}
