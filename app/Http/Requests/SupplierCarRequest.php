<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SupplierCarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->role === 'supplier';
    }

    public function rules()
    {
        return [
            'c_name' => 'required|string|max:255|alpha_num_space_dash',
            'c_type' => 'required|string|max:100|alpha_space',
            'c_location' => 'required|string|max:255|regex:/^[A-Za-z0-9\s,.\-]+$/',
            'c_price_per_day' => 'required|numeric|min:100|max:100000',
            'c_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'c_status'     => ['required', Rule::in(['1', '0'])],
        ];
    }

    public function messages()
    {
        return [
            'c_name.required' => 'Please enter the car name.',
            'c_name.alpha_num_space_dash' => 'Car name may only contain letters, numbers, spaces, and hyphens.',
            'c_name.max' => 'Car name cannot exceed 255 characters.',
            'c_type.required' => 'Please enter the car type.',
            'c_type.alpha_space' => 'Car type may only contain letters and spaces.',
            'c_type.max' => 'Car type cannot exceed 100 characters.',
            'c_location.required' => 'Please enter the car location.',
            'c_location.regex' => 'Location may only contain letters, numbers, commas, dots, spaces, and hyphens.',
            'c_location.max' => 'Location cannot exceed 255 characters.',
            'c_price_per_day.required' => 'Please enter the car’s price per day.',
            'c_price_per_day.numeric' => 'Price per day must be a valid number.',
            'c_price_per_day.min' => 'Price per day must be at least ₹100.',
            'c_price_per_day.max' => 'Price per day cannot exceed ₹100,000.',
            'c_image.image' => 'Uploaded file must be an image.',
            'c_image.mimes' => 'Image must be a JPG or PNG file.',
            'c_image.max' => 'Image size must not exceed 2MB.',
            'c_status.required'        => 'Please select a status.',
            'c_status.in'              => 'The selected status is invalid.',
        ];
    }
}
