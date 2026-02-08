<?php

namespace App\Http\Requests\Api\v1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class CreateSessionRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'ends_with:@astanait.edu.kz'],
            'password' => ['required', 'string', 'min:6'],
        ];
    }


    public function messages(): array
    {
        return [
            'email.required'   => 'Email is required.',
            'email.email'      => 'Invalid email address',
            'email.ends_with'  => 'Invalid email address',
        ];
    }
}
