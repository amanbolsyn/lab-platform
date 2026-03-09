<?php

namespace App\Http\Requests\Api\v1\Cart;

use App\Rules\Item\CheckItemQuantity;
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
            "data.attributes.purpose" => ['required', 'string'],
            "data.attributes.dueDate" => ['required', 'date', 'date_format:Y-m-d'],

            "included" => ['required', 'array', new CheckItemQuantity],
            "included.*.attributes.id" => ['required', 'integer', 'exists:items,id', 'distinct'],
            "included.*.attributes.quantity" => ['required', 'int', 'min:1']
        ];
    }

    public function attributes(): array
    {
        return [
            "data.attributes.purpose" => "purpose",
            "data.attributes.dueDate" => "due date",
            "included.*.attributes.quantity" => "quantity",
            "included.*.attributes.id" => "item id"
        ];
    }
}
