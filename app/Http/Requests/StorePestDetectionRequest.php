<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePestDetectionRequest extends FormRequest
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
            'district_id' => 'nullable|exists:districts,id',
            'predicted_pest_id' => 'nullable|exists:pests,id',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'confidence_score' => 'nullable|numeric|between:0,1',
            'notes' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'image.required' => 'Please upload an image of the pest or disease.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'Only JPEG, PNG, and JPG images are allowed.',
            'image.max' => 'Image size must not exceed 5MB.',
            'district_id.exists' => 'Selected district is invalid.',
            'predicted_pest_id.exists' => 'Selected pest is invalid.',
            'latitude.between' => 'Latitude must be between -90 and 90.',
            'longitude.between' => 'Longitude must be between -180 and 180.',
            'confidence_score.between' => 'Confidence score must be between 0 and 1.',
        ];
    }
}