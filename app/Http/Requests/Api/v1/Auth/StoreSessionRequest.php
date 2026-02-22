<?php

namespace App\Http\Requests\Api\v1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class StoreSessionRequest extends FormRequest
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
            'data.attributes.email' => ['required', 'string', 'email', 'ends_with:@astanait.edu.kz'],
            'data.attributes.password' => ['required', 'string', 'min:8'],
        ];
    }


    public function messages(): array
    {
        return [
            'data.attributes.email.required'   => 'Email is required.',
            'data.attributes.email.email'      => 'Invalid email address',
            'data.attributes.email.ends_with'  => 'Invalid email address',
        ];
    }
}
