<?php

namespace atikullahnasar\setting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFooterColumn3Request extends FormRequest
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
            'enabled' => 'nullable|in:on,off',
            'pages' => 'nullable|array',
            'pages.*' => 'nullable|exists:beft_custom_pages,id',
        ];
    }
}
