<?php

namespace atikullahnasar\setting\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGeneralSettings extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // text fields
            'application_name' => 'nullable|string|max:255',
            'copyright' => 'nullable|string|max:255',

            // boolean switches
            'owner_email_verification' => 'nullable|in:on,off',
            'registration_page' => 'nullable|in:on,off',
            'landing_page' => 'nullable|in:on,off',
            'pricing_feature' => 'nullable|in:on,off',

            // images
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg,ico|max:2048',
            'logo_light' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'landing_page_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'meta_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',

            'header_sub_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'header_main_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'box1_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'box2_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'box3_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'box4_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'application_name.string' => 'Application name must be text.',
            'logo.image' => 'Logo must be an image.',
            'favicon.image' => 'Favicon must be an image.',
        ];
    }
}
