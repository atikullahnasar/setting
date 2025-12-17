<?php

namespace atikullahnasar\setting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFooterSocialRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'facebook' => ['nullable', 'url'],
            'instagram' => ['nullable', 'url'],
            'twitter' => ['nullable', 'url'],
            'linkedIn' => ['nullable', 'url'],
            'threads' => ['nullable', 'url'],
        ];
    }

    public function messages()
    {
        return  [
            'facebook.url' => 'The Facebook link must be a valid URL.',
            'instagram.url' => 'The Instagram link must be a valid URL.',
            'twitter.url' => 'The Twitter link must be a valid URL.',
            'linkedIn.url' => 'The LinkedIn link must be a valid URL.',
            'threads.url' => 'The Threads link must be a valid URL.',
        ];
    }
}
