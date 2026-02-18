<?php

namespace App\Http\Requests\Api\v1\Program;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgramRequest extends FormRequest
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
            "data.attributes.code" => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            "data.attributes.name.required" => 'The program name is required',
            "data.attributes.code.required" => 'The program code is required',

            "data.attributes.name.string" => 'The program name has to be a string',
            "data.attributes.code.string" => 'The program code has to be a string',
        ];
    }
}
