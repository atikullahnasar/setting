<?php

namespace atikullahnasar\setting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfferRequest extends FormRequest
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
            'main_info' => 'nullable|string|max:500',
            'items' => 'nullable|array',
            'items.*.title' => 'nullable|string|max:255',
            'items.*.description' => 'nullable|string|max:500',
            'items.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'items.*.enabled' => 'nullable|boolean',
            'items.*.info' => 'nullable|string|max:500',
        ];
    }
}
