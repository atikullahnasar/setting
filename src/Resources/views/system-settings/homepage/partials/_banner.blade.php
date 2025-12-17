<div id="banner" role="tabpanel" aria-labelledby="banner-tab">
    <h5 class="mb-3 text-center ">Banner</h5>
    <form id="bannerForm" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_key" value="banner_settings">

        <div class="row g-3">
            <!-- Header Title -->
            <div class="col-md-6 col-12">
                <label for="headerTitle" class="form-label">Header Title</label>
                <input type="text" id="headerTitle" name="header_title" placeholder="Enter header title" class="form-control" value="{{ $settings['banner_settings']['header_title'] ?? '' }}">
            </div>

            <!-- Section Enabled -->
            <div class="col-md-6 col-12">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input" type="checkbox" id="bannerEnabled" name="enabled" {{ ($settings['banner_settings']['enabled'] ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="bannerEnabled">Section Enabled</label>
                </div>
            </div>

            <!-- Header Subtitle -->
            <div class="col-md-6 col-12">
                <label for="headerSubtitle" class="form-label">Header Subtitle</label>
                <input type="text" id="headerSubtitle" name="header_subtitle" placeholder="Enter header sub-title" class="form-control" value="{{ $settings['banner_settings']['header_subtitle'] ?? '' }}">
            </div>

            <!-- Header Button Text -->
            <div class="col-md-6 col-12">
                <label for="headerButtonText" class="form-label">Header Button Text</label>
                <input type="text" id="headerButtonText" name="header_button_text" placeholder="Enter header button text" class="form-control" value="{{ $settings['banner_settings']['header_button_text'] ?? '' }}">
            </div>

            <!-- Header Button Link -->
            <div class="col-md-6 col-12">
                <label for="headerButtonLink" class="form-label">Header Button Link</label>
                <input type="url" id="headerButtonLink" name="header_button_link" placeholder="Enter header button link" class="form-control" value="{{ $settings['banner_settings']['header_button_link'] ?? '' }}">
            </div>

            <!-- Header Sub Image -->
            <div class="col-md-6 col-12">
                <label for="headerSubImage" class="form-label">Header Sub Image</label>
                <input type="file" id="headerSubImage" name="header_sub_image" class="form-control">
                @if(isset($settings['banner_settings']['header_sub_image']))
                    <img src="{{ asset('storage/' . $settings['banner_settings']['header_sub_image']) }}" alt="" class="img-thumbnail mt-2" style="width: 64px; height: 64px; object-fit: cover;">
                @endif
            </div>

            <!-- Main Image -->
            <div class="col-md-6 col-12">
                <label for="headerMainImage" class="form-label">Main Image</label>
                <input type="file" id="headerMainImage" name="header_main_image" class="form-control">
                @if(isset($settings['banner_settings']['header_main_image']))
                    <img src="{{ asset('storage/' . $settings['banner_settings']['header_main_image']) }}" alt="" class="img-thumbnail mt-2" style="width: 64px; height: 64px; object-fit: cover;">
                @endif
            </div>

            <!-- Submit Button -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
