<?php

namespace atikullahnasar\setting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFooterColumn1Request extends FormRequest
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
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
            'contact' => ['nullable', 'regex:/^[0-9+\s\-()]+$/', 'max:255'],
            'enabled' => 'nullable|in:on,off',
            'links' => 'nullable|array',
            'links.*.title' => 'nullable|string|max:255',
            'links.*.url' => 'nullable|url|max:255',
        ];
    }
}
