<div id="aboutFooter" role="tabpanel" aria-labelledby="aboutFooter-tab">
    <h5 class="mb-3 text-center">AboutUS - Footer</h5>
    <form id="aboutFooterForm"  method="POST">
        @csrf
        <input type="hidden" name="_key" value="about_footer">

        <div class="row g-3">
            <!-- Name -->
            <div class="col-md-6 col-12">
                <label for="aboutFooterName" class="form-label">Name</label>
                <input type="text" id="aboutFooterName" name="name" placeholder="Enter name" class="form-control" value="{{ $settings['about_footer']['name'] ?? '' }}">
            </div>

            <!-- Section Enabled -->
            <div class="col-md-6 col-12">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input" type="checkbox" id="aboutFooterEnabled" name="enabled" {{ ($settings['about_footer']['enabled'] ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="aboutFooterEnabled">Section Enabled</label>
                </div>
            </div>

            <!-- Main Title -->
            <div class="col-md-6 col-12">
                <label for="aboutFooterMainTitle" class="form-label">Main Title</label>
                <input type="text" id="aboutFooterMainTitle" name="main_title" placeholder="Enter main title" class="form-control" value="{{ $settings['about_footer']['main_title'] ?? '' }}">
            </div>

            <!-- Main Info -->
            <div class="col-md-6 col-12">
                <label for="aboutFooterMainInfo" class="form-label">Main Info</label>
                <input type="text" id="aboutFooterMainInfo" name="main_info" placeholder="Enter main info" class="form-control" value="{{ $settings['about_footer']['main_info'] ?? '' }}">
            </div>

            <!-- Submit Button -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
