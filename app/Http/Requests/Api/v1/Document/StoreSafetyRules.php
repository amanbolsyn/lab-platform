<?php

namespace App\Http\Requests\Api\v1\Document;

use Illuminate\Foundation\Http\FormRequest;

class StoreSafetyRules extends FormRequest
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
            'data.attributes.document' => ['required', 'string', 'max:63'],
            'relationships.file' => ['array', 'required', 'max:1'],
            'relationships.file.*' => ['file', 'mimes:pdf,docx,doc', 'max:5120'] //5120 -> 5mb file 
        ];
    }
}
