<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerBookingRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'b_car_id' => 'required|exists:cars,id',
            'b_start_date' => 'required|date|after_or_equal:today',
            'b_end_date' => 'required|date|after_or_equal:b_start_date',
            'b_from_location' => 'required|string',
            'b_to_location' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'b_car_id.required' => 'Please select a car for booking.',
            'b_car_id.exists' => 'The selected car does not exist.',
            'b_start_date.required' => 'Start date is required.',
            'b_start_date.date' => 'Start date must be a valid date.',
            'b_start_date.after_or_equal' => 'Start date cannot be in the past.',
            'b_end_date.required' => 'End date is required.',
            'b_end_date.date' => 'End date must be a valid date.',
            'b_end_date.after_or_equal' => 'End date cannot be before the start date.',
            'b_from_location.required' => 'From location is required.',
            'b_from_location.string' => 'From location must be a valid string.',
            'b_to_location.required' => 'To location is required.',
            'b_to_location.string' => 'To location must be a valid string.',
        ];
    }
}
