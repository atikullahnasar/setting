<div id="General" class="tab-pane" role="tabpanel">
    <form id="general-settings-form"   method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_key" value="general_settings">

        <div class="row g-3">
            <!-- Application Name -->
            <div class="col-md-6">
                <label class="form-label">Application Name</label>
                <input type="text" name="application_name" class="form-control" placeholder="Enter application name" value="{{ $settings['general_settings']['application_name'] ?? '' }}">
            </div>

            <!-- Copyright -->
            <div class="col-md-6">
                <label class="form-label">Copyright</label>
                <input type="text" name="copyright" class="form-control" placeholder="Enter copyright" value="{{ $settings['general_settings']['copyright'] ?? '' }}">
            </div>

            <!-- Logo -->
            <div class="col-md-6">
                <label class="form-label">Logo</label>
                <div class="d-flex gap-3 align-items-center">
                    <div class="position-relative" style="width: 120px; height: 120px; border: 1px dashed #ced4da; border-radius: .375rem; overflow: hidden;">
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-1"></button>
                        <img id="uploaded-img__preview" src="{{ isset($settings['general_settings']['logo']) ? asset('storage/' . $settings['general_settings']['logo']) : asset('assets/images/logo.png') }}" class="img-fluid h-100 w-100" alt="Logo">
                    </div>
                    <label class="btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center" style="width: 120px; height: 120px; cursor: pointer;">
                        <i class="ri-camera-line fs-4"></i>
                        Upload
                        <input type="file" id="upload-file" name="logo" hidden>
                    </label>
                </div>
            </div>

            <!-- Favicon -->
            <div class="col-md-6">
                <label class="form-label">Favicon</label>
                <div class="d-flex gap-3 align-items-center">
                    <div class="position-relative" style="width: 120px; height: 120px; border: 1px dashed #ced4da; border-radius: .375rem; overflow: hidden;">
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-1"></button>
                        <img id="uploaded-img_fav__preview" src="{{ isset($settings['general_settings']['favicon']) ? asset('storage/' . $settings['general_settings']['favicon']) : asset('assets/images/logo.png') }}" class="img-fluid h-100 w-100" alt="Favicon">
                    </div>
                    <label class="btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center" style="width: 120px; height: 120px; cursor: pointer;">
                        <i class="ri-camera-line fs-4"></i>
                        Upload
                        <input type="file" id="upload-file_fav" name="favicon" hidden>
                    </label>
                </div>
            </div>

            <!-- Light Logo -->
            <div class="col-md-6">
                <label class="form-label">Light Logo</label>
                <div class="d-flex gap-3 align-items-center">
                    <div class="position-relative" style="width: 120px; height: 120px; border: 1px dashed #ced4da; border-radius: .375rem; overflow: hidden;">
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-1"></button>
                        <img id="uploaded-img_Light__preview" src="{{ isset($settings['general_settings']['logo_light']) ? asset('storage/' . $settings['general_settings']['logo_light']) : asset('assets/images/logo.png') }}" class="img-fluid h-100 w-100" alt="Light Logo">
                    </div>
                    <label class="btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center" style="width: 120px; height: 120px; cursor: pointer;">
                        <i class="ri-camera-line fs-4"></i>
                        Upload
                        <input type="file" id="upload-file_Light" name="logo_light" hidden>
                    </label>
                </div>
            </div>

            <!-- Landing Page Logo -->
            <div class="col-md-6">
                <label class="form-label">Landing Page Logo</label>
                <div class="d-flex gap-3 align-items-center">
                    <div class="position-relative" style="width: 120px; height: 120px; border: 1px dashed #ced4da; border-radius: .375rem; overflow: hidden;">
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-1"></button>
                        <img id="uploaded-img_Page__preview" src="{{ isset($settings['general_settings']['landing_page_logo']) ? asset('storage/' . $settings['general_settings']['landing_page_logo']) : asset('assets/images/logo.png') }}" class="img-fluid h-100 w-100" alt="Landing Page Logo">
                    </div>
                    <label class="btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center" style="width: 120px; height: 120px; cursor: pointer;">
                        <i class="ri-camera-line fs-4"></i>
                        Upload
                        <input type="file" id="upload-file_Page" name="landing_page_logo" hidden>
                    </label>
                </div>
            </div>

            <!-- Checkboxes -->
            <div class="col-md-6">
                <label class="form-label d-block">Owner Email Verification</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="owner_email_verification" {{ isset($settings['general_settings']['owner_email_verification']) && $settings['general_settings']['owner_email_verification'] == 'on' ? 'checked' : '' }} id="Owner_Email_Verification">
                    <label class="form-check-label" for="Owner_Email_Verification">Enable</label>
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label d-block">Registration Page</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="registration_page" {{ isset($settings['general_settings']['registration_page']) && $settings['general_settings']['registration_page'] == 'on' ? 'checked' : '' }} id="Registration_Page">
                    <label for="Registration_Page" class="form-check-label">Enable</label>
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label d-block">Landing Page</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="landing_page" {{ isset($settings['general_settings']['landing_page']) && $settings['general_settings']['landing_page'] == 'on' ? 'checked' : '' }} id="Landing_Page">
                    <label for="Landing_Page" class="form-check-label">Enable</label>
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label d-block">Pricing Feature</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" id="pricingFeature" type="checkbox" name="pricing_feature" {{ isset($settings['general_settings']['pricing_feature']) && $settings['general_settings']['pricing_feature'] == 'on' ? 'checked' : '' }}>
                    <label for="pricingFeature" class="form-check-label">Enable</label>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
