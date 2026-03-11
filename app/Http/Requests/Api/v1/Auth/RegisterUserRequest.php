<?php

namespace App\Http\Requests\Api\v1\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
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
            "data.attributes.fullname" => ["required", "string", "max:63"],
            "data.attributes.email" => ["required", "email", "unique:users,email", "max:255", "ends_with:@astanait.edu.kz"],
            "data.attributes.group" => ["required", "string",  "max:17", "regex:/^[A-Za-z]+-[0-9]+$/"],
            "data.attributes.password" => [
                "required",
                "confirmed",
                Password::min(8)
                    ->letters()
                    ->numbers()
                    ->mixedCase()
                    ->symbols(),
            ],
            "data.attributes.read_safety_precautions" => ["required", "boolean", "accepted"],
            "relationships.program.id"  => ["required", "exists:programs,id"],
        ];
    }

    public function attributes()
    {
        return [
            "data.attributes.fullname" => "fullname",
            "data.attributes.email" => "email",
            "data.attributes.group" => "group",
            "data.attributes.password" => "password",
            "data.attributes.read_safety_precautions" => "read safety precautions",

            "relationships.program.id" => "program"
        ];
    }

    public function messages(){
        return [
            "data.attributes.email.unique" => "Invalid credentials", 
        ]; 
    }
}
