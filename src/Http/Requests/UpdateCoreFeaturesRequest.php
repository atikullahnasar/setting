<?php

namespace atikullahnasar\setting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCoreFeaturesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'nullable|string|max:255',
            'enabled' => 'nullable|boolean',
            'main_title' => 'nullable|string|max:255',
            'main_info' => 'nullable|string|max:500',
            'items' => 'nullable|array',
            'items.*.title' => 'nullable|string|max:255',
            'items.*.sub_title' => 'nullable|string|max:500',
            'items.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
