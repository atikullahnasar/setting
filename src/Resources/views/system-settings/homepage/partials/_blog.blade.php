<div id="blog" role="tabpanel" aria-labelledby="blog-tab" class="">
    <h5 class="mb-3 text-center underline">Blog</h5>
    <form id="blogForm" method="POST">
        @csrf
        <input type="hidden" name="_key" value="blog">

        <div class="row g-3">
            <!-- Name -->
            <div class="col-md-6 col-12">
                <label for="blogName" class="form-label">Name</label>
                <input type="text" id="blogName" name="name" placeholder="Enter name" class="form-control" value="{{ $settings['blog']['name'] ?? '' }}">
            </div>

            <!-- Section Enabled -->
            <div class="col-md-6 col-12">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input" type="checkbox" id="blogEnabled" name="enabled" {{ ($settings['blog']['enabled'] ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="blogEnabled">Section Enabled</label>
                </div>
            </div>

            <!-- Main Title -->
            <div class="col-md-6 col-12">
                <label for="blogMainTitle" class="form-label">Main Title</label>
                <input type="text" id="blogMainTitle" name="main_title" placeholder="Enter main title" class="form-control" value="{{ $settings['blog']['main_title'] ?? '' }}">
            </div>

            <!-- Main Info -->
            <div class="col-md-6 col-12">
                <label for="blogMainInfo" class="form-label">Main Info</label>
                <input type="text" id="blogMainInfo" name="main_info" placeholder="Enter main info" class="form-control" value="{{ $settings['blog']['main_info'] ?? '' }}">
            </div>

            <!-- Submit Button -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
