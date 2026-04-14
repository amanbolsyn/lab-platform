<?php

namespace App\Http\Requests\Api\v1\Program;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            "data.attributes.program" => ['required', 'string', "max:255", Rule::unique('programs', 'program')->ignore($this->program->id)],
            "data.attributes.code" => ['required', 'string', "max:63", Rule::unique('programs', 'code')->ignore($this->program->id)],
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
