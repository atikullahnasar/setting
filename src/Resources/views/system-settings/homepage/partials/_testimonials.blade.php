<div id="testimonials" role="tabpanel" aria-labelledby="testimonials-tab" class="">
    <h5 class="mb-3 text-center">Testimonials</h5>
    <form id="testimonialsForm" method="POST">
        @csrf
        <input type="hidden" name="_key" value="testimonials">

        <div class="row g-3">
            <!-- Name -->
            <div class="col-md-6 col-12">
                <label for="testimonialsName" class="form-label">Name</label>
                <input type="text" id="testimonialsName" name="name" placeholder="Enter name" class="form-control" value="{{ $settings['testimonials']['name'] ?? '' }}">
            </div>

            <!-- Section Enabled -->
            <div class="col-md-6 col-12">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input" type="checkbox" id="testimonialsEnabled" name="enabled" {{ ($settings['testimonials']['enabled'] ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="testimonialsEnabled">Section Enabled</label>
                </div>
            </div>

            <!-- Main Title -->
            <div class="col-md-6 col-12">
                <label for="testimonialsTitle" class="form-label">Main Title</label>
                <input type="text" id="testimonialsTitle" name="main_title" placeholder="Enter main title" class="form-control" value="{{ $settings['testimonials']['main_title'] ?? '' }}">
            </div>

            <!-- Main Info -->
            <div class="col-md-6 col-12">
                <label for="testimonialsInfo" class="form-label">Main Info</label>
                <input type="text" id="testimonialsInfo" name="main_info" placeholder="Enter main info" class="form-control" value="{{ $settings['testimonials']['main_info'] ?? '' }}">
            </div>

            <!-- Submit Button -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
