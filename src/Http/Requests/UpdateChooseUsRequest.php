<?php

namespace atikullahnasar\setting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChooseUsRequest extends FormRequest
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
            'name' => 'nullable|string|max:255',
            'enabled' => 'nullable|boolean',
            'main_title' => 'nullable|string|max:255',
            'banner_image' => 'nullable|image|max:2048',
            'items' => 'nullable|array',
            'items.*.info' => 'nullable|string|max:255',
            'items.*.details' => 'nullable|string|max:1000',
            'items.*.image' => 'nullable|image|max:2048',
        ];
    }
}
