<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class AdminSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    public function rules(): array
    {
        $supplier = $this->route('supplier');

        $emailRule = ['required', 'email', 'valid_email'];
        if ($supplier) {
            $emailRule[] = Rule::unique('users', 'email')->ignore($supplier->id);
        } else {
            $emailRule[] = 'unique:users,email';
        }

        $passwordRule = $supplier ? ['nullable', Password::defaults()] : ['required', Password::defaults()];

        return [
            'name' => 'required|string|max:100',
            'email' => $emailRule,
            'password' => $passwordRule,
            'status' => ['required', Rule::in(['1', '0'])],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Supplier name is required.',
            'email.required' => 'Email address is required.',
            'email.unique' => 'This email is already registered.',
            'email.valid_email' => 'The email address is not acceptable.',
            'status.required' => 'Please select a status.',
            'status.in' => 'The selected status is invalid.',
            'password.required' => 'Password is required.',
            'password.password' => 'Password must be at least 8 characters long, contain uppercase and lowercase letters, numbers, and special characters.',
        ];
    }
}
