<div id="faqSection" role="tabpanel" aria-labelledby="faqSection-tab" >
     <h5 class="mb-3 text-center">FAQ</h6>
    <form id="faqSectionForm" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_key" value="faq_section">

        <div class="row g-3">
            <!-- Name -->
            <div class="col-md-6 col-12">
                <label for="faqName" class="form-label">Name</label>
                <input type="text" id="faqName" name="name" class="form-control" placeholder="Enter name" value="{{ $settings['faq_section']['name'] ?? '' }}">
            </div>

            <!-- Section Enabled -->
            <div class="col-md-6 col-12">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input" type="checkbox" id="faqEnabled" name="enabled" {{ ($settings['faq_section']['enabled'] ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="faqEnabled">Section Enabled</label>
                </div>
            </div>

            <!-- Main Title -->
            <div class="col-md-6 col-12">
                <label class="form-label">Main Title</label>
                <input type="text" name="main_title" class="form-control" placeholder="Enter main title" value="{{ $settings['faq_section']['main_title'] ?? '' }}">
            </div>

            <!-- Main Info -->
            <div class="col-md-6 col-12">
                <label class="form-label">Main Info</label>
                <input type="text" name="main_info" class="form-control" placeholder="Enter main info" value="{{ $settings['faq_section']['main_info'] ?? '' }}">
            </div>

            <!-- Image -->
            <div class="col-md-6 col-12">
                <label class="form-label">Image</label>
                <input type="file" name="banner_image" class="form-control">
                @if(isset($settings['faq_section']['banner_image']))
                    <img src="{{ asset('storage/' . $settings['faq_section']['banner_image']) }}" class="img-thumbnail mt-2" style="width:64px; height:64px; object-fit:cover;">
                @endif
            </div>

            <!-- Submit -->
            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
