<div id="SiteSEO" class="tab-pane" role="tabpanel">
    <form id="site-seo-settings-form" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_key" value="site_seo_settings">

        <div class="row g-3">
            <!-- Meta Title -->
            <div class="col-md-6">
                <label class="form-label">Meta Title</label>
                <input type="text" name="meta_title" class="form-control" placeholder="Enter meta title" value="{{ $settings['site_seo_settings']['meta_title'] ?? '' }}">
            </div>

            <!-- Meta Keyword -->
            <div class="col-md-6">
                <label class="form-label">Meta Keyword</label>
                <input type="text" name="meta_keyword" class="form-control" placeholder="Enter meta keyword" value="{{ $settings['site_seo_settings']['meta_keyword'] ?? '' }}">
            </div>

            <!-- Meta Description -->
            <div class="col-md-12">
                <label class="form-label">Meta Description</label>
                <input type="text" name="meta_description" class="form-control" placeholder="Enter meta description" value="{{ $settings['site_seo_settings']['meta_description'] ?? '' }}">
            </div>

            <!-- Meta Image -->
            <div class="col-md-12">
                <label class="form-label">Meta Image</label>
                <div class="d-flex gap-3 align-items-center">
                    <div class="position-relative" style="width: 120px; height: 120px; border: 1px dashed #ced4da; border-radius: .375rem; overflow: hidden;">
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-1"></button>
                        <img id="uploaded-meta-image-preview" src="{{ isset($settings['site_seo_settings']['meta_image']) ? asset('storage/' . $settings['site_seo_settings']['meta_image']) : asset('assets/images/logo.png') }}" class="img-fluid h-100 w-100" alt="Meta Image">
                    </div>
                    <label class="btn btn-outline-secondary d-flex flex-column align-items-center justify-content-center" style="width: 120px; height: 120px; cursor: pointer;">
                        <i class="ri-camera-line fs-4"></i>
                        Upload
                        <input type="file" id="upload-meta-image" name="meta_image" hidden>
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
