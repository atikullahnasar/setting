<div id="GoogleRecaptcha" class="tab-pane" role="tabpanel">
    <form id="google-recaptcha-settings-form"   method="POST">
        @csrf
        <input type="hidden" name="_key" value="google_recaptcha_settings">

        <div class="row g-3">
            <!-- Enable Google Recaptcha -->
            <div class="col-12">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="google_recaptcha_enabled" name="google_recaptcha_enabled" {{ isset($settings['google_recaptcha_settings']['google_recaptcha_enabled']) && $settings['google_recaptcha_settings']['google_recaptcha_enabled'] == 'on' ? 'checked' : '' }}>
                    <label class="form-check-label" for="google_recaptcha_enabled">Enable Google ReCaptcha</label>
                </div>
            </div>

            <!-- Recaptcha Key -->
            <div class="col-md-6">
                <label class="form-label">Recaptcha Key</label>
                <input type="text" name="recaptcha_key" class="form-control" placeholder="Enter recaptcha key" value="{{ $settings['google_recaptcha_settings']['recaptcha_key'] ?? '' }}">
            </div>

            <!-- Recaptcha Secret -->
            <div class="col-md-6">
                <label class="form-label">Recaptcha Secret</label>
                <input type="text" name="recaptcha_secret" class="form-control" placeholder="Enter recaptcha secret" value="{{ $settings['google_recaptcha_settings']['recaptcha_secret'] ?? '' }}">
            </div>

            <!-- Submit Button -->
            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
