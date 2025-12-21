<div id="GoogleRecaptcha" role="tabpanel" class="space-y-6">
    <form id="google-recaptcha-settings-form" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="_key" value="google_recaptcha_settings">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Enable Google Recaptcha -->
            <div class="md:col-span-2 flex items-center gap-4">
                <label for="google_recaptcha_enabled" class="text-sm font-medium text-gray-700">
                    Enable Google ReCaptcha
                </label>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="hidden" name="google_recaptcha_enabled" value="off">
                    <input type="checkbox" id="google_recaptcha_enabled" name="google_recaptcha_enabled" class="sr-only peer" value="on" {{ isset($settings['google_recaptcha_settings']['google_recaptcha_enabled']) && $settings['google_recaptcha_settings']['google_recaptcha_enabled'] == 'on' ? 'checked' : '' }}>
                    <span class="relative w-11 h-6 bg-gray-300 rounded-full
                                 after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                 after:bg-white after:border after:border-gray-300 after:rounded-full
                                 after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600
                                 peer-checked:after:translate-x-full"></span>
                </label>
            </div>

            <!-- Recaptcha Key -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Recaptcha Key</label>
                <input type="text" name="recaptcha_key" placeholder="Enter recaptcha key"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       value="{{ $settings['google_recaptcha_settings']['recaptcha_key'] ?? '' }}">
            </div>

            <!-- Recaptcha Secret -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Recaptcha Secret</label>
                <input type="text" name="recaptcha_secret" placeholder="Enter recaptcha secret"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       value="{{ $settings['google_recaptcha_settings']['recaptcha_secret'] ?? '' }}">
            </div>

            <!-- Submit Button -->
            <div class="md:col-span-2 pt-4">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-medium transition">
                    Save
                </button>
            </div>

        </div>
    </form>
</div>
