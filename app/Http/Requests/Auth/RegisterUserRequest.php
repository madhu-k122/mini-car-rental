<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:100', 'allowcharactersandspace'],
            'email'    => ['required', 'email', 'max:100', 'unique:users,email', 'valid_email'],
            'password' => ['required', Password::defaults()],
            'role'     => ['required', Rule::in(['admin', 'supplier'])],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'Full name is required.',
            'name.allowcharactersandspace' => 'Full name allowed characters and space',
            'email.required'       => 'Email is required.',
            'email.email'          => 'Please provide a valid email address.',
            'email.valid_email' => 'The email address is not acceptable.',
            'email.unique'         => 'This email is already registered.',
            'password.required'    => 'Password is required.',
            'password.password' => 'Password must be at least 8 characters long, contain uppercase and lowercase letters,       numbers, and special characters.',
            'role.required' => 'Please select a role.',
            'role.required'        => 'Please select a role.',
            'role.in'              => 'The selected role is invalid.',
        ];
    }
}
