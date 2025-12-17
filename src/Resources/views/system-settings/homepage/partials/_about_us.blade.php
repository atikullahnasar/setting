<div id="aboutUs" role="tabpanel" aria-labelledby="aboutUs-tab">
    <h5 class="mb-3 text-center">AboutUs</h5>
    <form id="aboutUsForm" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_key" value="about_us">

        <div class="row g-3">
            <!-- Name -->
            <div class="col-md-6 col-12">
                <label for="aboutUsName" class="form-label">Name</label>
                <input type="text" id="aboutUsName" name="name" placeholder="Enter name" class="form-control" value="{{ $settings['about_us']['name'] ?? '' }}">
            </div>

            <!-- Section Enabled -->
            <div class="col-md-6 col-12">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input" type="checkbox" id="aboutUsEnabled" name="enabled" {{ ($settings['about_us']['enabled'] ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="aboutUsEnabled">Section Enabled</label>
                </div>
            </div>

            <!-- Box 1 Title -->
            <div class="col-md-6 col-12">
                <label for="box1Title" class="form-label">1 Box Title</label>
                <input type="text" id="box1Title" name="box1_title" placeholder="Enter box-1 title" class="form-control" value="{{ $settings['about_us']['box1_title'] ?? '' }}">
            </div>

            <!-- Box 1 Image -->
            <div class="col-md-6 col-12">
                <label for="box1Image" class="form-label">Box Image</label>
                <input type="file" id="box1Image" name="box1_image" class="form-control">
                @if(isset($settings['about_us']['box1_image']))
                    <img src="{{ asset('storage/' . $settings['about_us']['box1_image']) }}" alt="" class="img-thumbnail mt-2" style="width: 64px; height: 64px; object-fit: cover;">
                @endif
            </div>

            <!-- Box 1 Learn More -->
            <div class="col-12">
                <label for="box1LearnMore" class="form-label">1 Box Learn More</label>
                <input type="url" id="box1LearnMore" name="box1_learn_more" placeholder="Write the URL for learn more" class="form-control" value="{{ $settings['about_us']['box1_learn_more'] ?? '' }}">
            </div>

            <!-- Box 1 Info -->
            <div class="col-12">
                <label class="form-label">1 Box Info</label>
                <div id="toolbar-container-aboutUs1"></div>
                <div id="aboutUsQuill1" style="height: 150px;"></div>
            </div>

            <!-- Box 1 Points -->
            <div class="col-12" id="pointList1">
                @if(isset($settings['about_us']['box1_points']))
                    @foreach($settings['about_us']['box1_points'] as $point)
                        <div class="input-group mb-2 pointItem">
                            <input type="text" name="box1_points[]" class="form-control" placeholder="Enter point" value="{{ $point }}">
                            <button type="button" class="btn btn-outline-danger remove-button" data-target=".pointItem"><iconify-icon icon="ic:twotone-close"></iconify-icon></button>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="col-12">
                <button type="button" class="btn btn-outline-primary btn-sm addNewPoint" data-target="pointList1" data-name="box1_points[]">
                    <iconify-icon icon="simple-line-icons:plus" class="me-2"></iconify-icon> Add
                </button>
            </div>

            <!-- Box 2 Title -->
            <div class="col-md-6 col-12">
                <label for="box2Title" class="form-label">2 Box Title</label>
                <input type="text" id="box2Title" name="box2_title" placeholder="Enter box-2 title" class="form-control" value="{{ $settings['about_us']['box2_title'] ?? '' }}">
            </div>

            <!-- Box 2 Image -->
            <div class="col-md-6 col-12">
                <label for="box2Image" class="form-label">Box Image</label>
                <input type="file" id="box2Image" name="box2_image" class="form-control">
                @if(isset($settings['about_us']['box2_image']))
                    <img src="{{ asset('storage/' . $settings['about_us']['box2_image']) }}" alt="" class="img-thumbnail mt-2" style="width: 64px; height: 64px; object-fit: cover;">
                @endif
            </div>

            <!-- Box 2 Learn More -->
            <div class="col-12">
                <label for="box2LearnMore" class="form-label">2 Box Learn More</label>
                <input type="url" id="box2LearnMore" name="box2_learn_more" placeholder="Write the URL for learn more" class="form-control" value="{{ $settings['about_us']['box2_learn_more'] ?? '' }}">
            </div>

            <!-- Box 2 Info -->
            <div class="col-12">
                <label class="form-label">2 Box Info</label>
                <div id="toolbar-container-aboutUs2"></div>
                <div id="aboutUsQuill2" style="height: 150px;"></div>
            </div>

            <!-- Box 2 Points -->
            <div class="col-12" id="pointList2">
                @if(isset($settings['about_us']['box2_points']))
                    @foreach($settings['about_us']['box2_points'] as $point)
                        <div class="input-group mb-2 pointItem">
                            <input type="text" name="box2_points[]" class="form-control" placeholder="Enter point" value="{{ $point }}">
                            <button type="button" class="btn btn-outline-danger remove-button" data-target=".pointItem"><iconify-icon icon="ic:twotone-close"></iconify-icon></button>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="col-12">
                <button type="button" class="btn btn-outline-primary btn-sm addNewPoint" data-target="pointList2" data-name="box2_points[]">
                    <iconify-icon icon="simple-line-icons:plus" class="me-2"></iconify-icon> Add
                </button>
            </div>

            <!-- Submit Button -->
            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
