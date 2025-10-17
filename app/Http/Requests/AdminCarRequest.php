<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminCarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $rules = [
            'c_name' => 'required|string|max:255|alpha_num_space_dash',
            'c_type' => 'required|string|max:100|alpha_space',
            'c_location' => 'required|string|max:255|regex:/^[A-Za-z0-9\s,.\-]+$/',
            'c_price_per_day' => 'required|numeric|min:100|max:100000',
            'c_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'c_status' => ['required', Rule::in(['1', '0'])],
        ];
        if ($this->isMethod('post')) {
            $rules['c_user_id'] = 'required|exists:users,id';
        }
        return $rules;
    }


    public function messages(): array
    {
        return [
            'c_user_id.required' => 'Please select a supplier.',
            'c_user_id.exists' => 'Selected supplier does not exist.',
            'c_name.required' => 'Please enter the car name.',
            'c_name.regex' => 'Car name can only contain letters, numbers, spaces, and dashes.',
            'c_type.required' => 'Please enter the car type.',
            'c_type.regex' => 'Car type can only contain letters and spaces.',
            'c_location.required' => 'Please enter the car location.',
            'c_location.regex' => 'Car location contains invalid characters.',
            'c_price_per_day.required' => 'Please enter the price per day.',
            'c_price_per_day.numeric' => 'Price per day must be a number.',
            'c_price_per_day.min' => 'Price per day must be at least 100.',
            'c_price_per_day.max' => 'Price per day cannot exceed 100,000.',
            'c_image.image' => 'Uploaded file must be an image.',
            'c_image.mimes' => 'Image must be a file of type: jpg, jpeg, png.',
            'c_image.max' => 'Image size should not exceed 2MB.',
            'c_status.required' => 'Please select the car status.',
            'c_status.in' => 'Car status must be either active or inactive.',
        ];
    }
}
