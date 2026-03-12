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
            "data.attributes.program" => ['required', 'string', "max:255", "unique:programs,program"],
            "data.attributes.code" => ['required', 'string', "max:63", "unique:programs,code"],
        ];
    }

    public function attributes()
    {
        return [
            "data.attributes.program" => "program",
            "data.attributes.code" => "code"
        ];
    }
}
