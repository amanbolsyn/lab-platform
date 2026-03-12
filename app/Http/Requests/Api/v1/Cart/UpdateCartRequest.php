<?php

namespace App\Http\Requests\Api\v1\Cart;

use App\Models\Cart;
use App\Rules\Item\CheckItemStock;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCartRequest extends FormRequest
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
            "data.attributes.due_date" => ['date', 'date_format:Y-m-d'],
            "data.attributes.comment" => ["string"],
            "data.attributes.status" => ["required", Rule::in(Cart::STATUS_LEVELS)],

            "included" => ['array'],
            "included.*.attributes.id" => ['required', 'integer', 'exists:items,id', 'distinct',],
            "included.*.attributes.quantity" => ['required', 'int', 'min:0']
        ];
    }

    public function attributes(): array
    {
        return [
            "data.attributes.due_date" => "due date",
            "data.attributes.comment" => "comment",
            "data.attributes.status" => "status", 
            "included.*.attributes.quantity" => "quantity",
            "included.*.attributes.id" => "item id"
        ];
    }
}
