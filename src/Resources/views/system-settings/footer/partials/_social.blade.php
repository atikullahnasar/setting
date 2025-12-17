<div id="social" role="tabpanel" aria-labelledby="social-tab" style="display:none;">
    <form id="socialForm" method="POST">
        @csrf
        <input type="hidden" name="_key" value="footer_social">
        <div class="row">

            <!-- Name -->
            <div class="col-md-8 mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter name" value="{{ $settings['footer_social']['name'] ?? 'Help' }}">
            </div>

            <!-- Footer Social Enabled -->
            <div class="col-md-4 mt-2  form-check form-switch mb-3">
                <input type="hidden" name="enabled" value="off">
                <input type="checkbox" class="form-check-input" name="enabled" id="footer_social_enabled" {{ ($settings['footer_social']['enabled'] ?? 'off') === 'on' ? 'checked' : '' }}>
                <label class="form-check-label" for="footer_social_enabled">Footer Social Enabled</label>
            </div>
        </div>

        @php
            $socials = [
                ['name' => 'Facebook', 'key' => 'facebook'],
                ['name' => 'Instagram', 'key' => 'instagram'],
                ['name' => 'Twitter', 'key' => 'twitter'],
                ['name' => 'LinkedIn', 'key' => 'linkedIn'],
                ['name' => 'Threads', 'key' => 'threads'],
            ];
        @endphp

        @foreach ($socials as $social)
            <div class="row mb-3 align-items-center">
                <!-- URL Input -->
                <div class="col-md-8 mb-2 mb-md-0">
                    <label class="form-label">{{ $social['name'] }}</label>
                    <input type="url" name="{{ $social['key'] }}" class="form-control" placeholder="Enter {{ $social['name'] }} URL"
                        value="{{ $settings['footer_social'][$social['key']] ?? '' }}">
                </div>

                <!-- Enabled Switch -->
                <div class="col-md-4">
                    <div class="form-check form-switch mt-2 mt-md-0">
                        <input type="hidden" name="{{ $social['key'] }}_enabled" value="off">
                        <input type="checkbox" class="form-check-input" name="{{ $social['key'] }}_enabled" id="{{ $social['key'] }}_enabled"
                            {{ (($settings['footer_social'][$social['key'].'_enabled'] ?? 'off') === 'on' || ($settings['footer_social'][$social['key'].'_enabled'] ?? false) === true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="{{ $social['key'] }}_enabled">Enabled</label>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Submit Button -->
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
