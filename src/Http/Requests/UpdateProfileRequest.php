<?php

namespace atikullahnasar\setting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateProfileRequest extends FormRequest
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
        $userId = auth()->id(); // current logged-in user

        if ($this->type === 'info') {
            return [
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'email',
                    'string',
                    'max:255',
                    'regex:/^[^@\s]+@[^@\s]+\.[^@\s]+$/',
                    Rule::unique('users')->ignore($userId),
                ],
                'phone' => 'nullable|string|max:20',
                'avatar' => 'nullable|image|max:2048',
            ];
        } elseif ($this->type === 'pass') {
            return [
                'current_password' => 'required',
                'password' => [
                    'nullable',
                    'string',
                    'confirmed',
                    Password::min(8)
                        ->mixedCase()
                        ->letters()
                        ->numbers()
                        ->symbols()
                        ->uncompromised(),
                    'different:email',
                ],
            ];
        }

        return []; // default if type is missing
    }

    public function messages(): array
    {
        return [
            'email.regex' => 'The email must be in the format: example@example.com',
            'password.different' => 'Password cannot be the same as your email.',
        ];
    }

    // Optional: force type to be required
    public function prepareForValidation()
    {
        $this->merge([
            'type' => $this->type ?? '',
        ]);
    }
}
