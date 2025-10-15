<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SupplierCarRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Only logged-in suppliers can create/update cars
        return Auth::check() && Auth::user()->role === 'supplier';
    }

    public function rules(): array
    {
        return [
            'c_name' => 'required|string|max:255',
            'c_type' => 'required|string|max:100',
            'c_location' => 'required|string|max:255',
            'c_price_per_day' => 'required|numeric|min:0',
            'c_image' => 'nullable|image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'c_name.required' => 'Car name is required.',
            'c_type.required' => 'Car type is required.',
            'c_location.required' => 'Car location is required.',
            'c_price_per_day.required' => 'Price per day is required.',
            'c_price_per_day.numeric' => 'Price must be a number.',
            'c_image.image' => 'Uploaded file must be an image.',
            'c_image.max' => 'Image cannot be larger than 2MB.',
        ];
    }
}
