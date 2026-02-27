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
            "data.attributes.fullname" => ["required", "string", " max:63"],
            "data.attributes.email" => ["required", "email", "unique:users,email", "max:255", "ends_with:@astanait.edu.kz"],
            "data.attributes.group" => ["required", "max:17", "regex:/^[A-Za-z]+-[0-9]+$/"],
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


    public function messages(): array
    {
        return [
            "data.attributes.fullname.required" => "The fullname field is required",
            "data.attributes.fullname.max" => "The fullname field exceeds max characters",
            "data.attributes.fullname.string" => "The fullname field must be a string",


            "data.attributes.email.required" => "The email field is required",
            "data.attributes.email.email" => "Invalid email address",
            "data.attributes.email.max" => "The email field exceeds max characters",
            "data.attributes.email.ends_with"  => "Invalid email address",
            "data.attributes.email.unique"  => "Email is already registered",

            "data.attributes.group.reqiured"  => "The group field is required",
            "data.attributes.group.max"  => "The group filed exceeds max characters",
            "data.attributes.group.regex"  => "Invalid group",


            "data.attributes.password.required"  => "The password field is required",
            "data.attributes.password.confirmed"  => "The passwords don't match",
            "data.attributes.password.min"  => "The password must be at least 8 characters long",
            "data.attributes.password.*.letters"  => "The password must contain at least one letter",
            "data.attributes.password.*.numbers"  => "The password must contain at least one number",
            "data.attributes.password.*.mixed"  => "The password must contain at least upper and lower case letters",
            "data.attributes.password.*.symbols"  => "The password must contain at least one symbol",

            "data.attributes.read_safety_precautions.required" => "The reading safety precations is required",
            "data.attributes.read_safety_precautions.boolean" => "The read_safety_precautions field has to be boolean value",
            "data.attributes.read_safety_precautions.accepted" => "The read_safety_precautions field has to be truthy",

            "relationships.program.id.required"  => "The program field is required",
            "relationships.program.id.exists"  => "The program name does not exist",

        ];
    }
}
