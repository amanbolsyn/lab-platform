<?php

namespace App\Http\Requests\Api\v1\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can(
            'updateWithAttributes',
            [User::class, $this->all()]
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */


    public function rules(): array
    {
        return [
            "data.attributes.fullname" => 'required|string',
            "data.attributes.role" => 'string',
        ];
    }

    public function messages()
    {
        return [
            "data.attributes.name.required" => 'The program name is required',

            "data.attributes.name.string" => 'The program name has to be a string',
            "data.attributes.role.string" => 'The program code has to be a string',
        ];
    }
}
