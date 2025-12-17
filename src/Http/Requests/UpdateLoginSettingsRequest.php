<?php

namespace atikullahnasar\setting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoginSettingsRequest extends FormRequest
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
            'auth_page_enabled' => 'nullable|in:yes,no',
            'auth_page_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',

            'CoreFeatureTitle' => 'required|array',
            'CoreFeatureTitle.*' => 'required|string|max:255',

            'CoreFeatureSubTitle' => 'required|array',
            'CoreFeatureSubTitle.*' => 'required|string|max:500',
        ];
    }
    public function messages(): array
    {
        return [
            'CoreFeatureTitle.required' => 'The core feature title field is required.',
            'CoreFeatureTitle.*.required' => 'Each core feature title is required.',
            'CoreFeatureTitle.*.string' => 'Each core feature title must be a string.',
            'CoreFeatureTitle.*.max' => 'Each core feature title may not be greater than 255 characters.',

            'CoreFeatureSubTitle.required' => 'The core feature subtitle field is required.',
            'CoreFeatureSubTitle.*.required' => 'Each core feature subtitle is required.',
            'CoreFeatureSubTitle.*.string' => 'Each core feature subtitle must be a string.',
            'CoreFeatureSubTitle.*.max' => 'Each core feature subtitle may not be greater than 500 characters.',
        ];
    }
}
