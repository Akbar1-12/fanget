<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation Rules
     */
    public function rules(): array
    {
        return [

            'name' => ['required', 'string', 'max:255'],

            'artist_name' => ['required', 'string', 'max:255'],

            'email' => ['required', 'email', 'unique:users,email'],

            'password' => ['required', 'confirmed', 'min:8'],

        ];
    }

    /**
     * Custom Messages
     */
    public function messages(): array
    {
        return [

            'name.required' => 'Your name is required.',

            'artist_name.required' => 'Artist name is required.',

            'email.required' => 'Email is required.',

            'email.unique' => 'This email is already registered.',

            'password.required' => 'Password is required.',

            'password.confirmed' => 'Passwords do not match.',

            'password.min' => 'Password must be at least 8 characters.',

        ];
    }
}
