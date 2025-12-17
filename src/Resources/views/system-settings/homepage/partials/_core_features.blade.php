<div id="coreFeatures" role="tabpanel" aria-labelledby="coreFeatures-tab" >
     <h5 class="mb-3 text-center ">Core Features</h5>
    <form id="coreFeaturesForm" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_key" value="core_features">

        <div class="row g-3">
            <!-- Name -->
            <div class="col-md-6 col-12">
                <label for="coreFeaturesName" class="form-label">Name</label>
                <input type="text" id="coreFeaturesName" name="name" placeholder="Enter name" class="form-control" value="{{ $settings['core_features']['name'] ?? '' }}">
            </div>

            <!-- Section Enabled -->
            <div class="col-md-6 col-12">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input" type="checkbox" id="coreFeaturesEnabled" name="enabled" {{ ($settings['core_features']['enabled'] ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="coreFeaturesEnabled">Section Enabled</label>
                </div>
            </div>

            <!-- Main Title -->
            <div class="col-md-6 col-12">
                <label class="form-label">Main Title</label>
                <input type="text" name="main_title" placeholder="Enter main title" class="form-control" value="{{ $settings['core_features']['main_title'] ?? '' }}">
            </div>

            <!-- Main Info -->
            <div class="col-md-6 col-12">
                <label class="form-label">Main Info</label>
                <input type="text" name="main_info" placeholder="Enter main info" class="form-control" value="{{ $settings['core_features']['main_info'] ?? '' }}">
            </div>

            <!-- Core Feature Items -->
            <div class="col-12" id="coreFeatureList">
                @if(isset($settings['core_features']['items']))
                    @foreach($settings['core_features']['items'] as $item)
                        <div class="CoreFeatureItem row g-3 align-items-end mb-2">
                            <div class="col-md-4 col-12">
                                <label class="form-label">Title</label>
                                <input type="text" name="items[][title]" placeholder="Enter title" class="form-control" value="{{ $item['title'] ?? '' }}">
                            </div>
                            <div class="col-md-4 col-12">
                                <label class="form-label">Sub Title</label>
                                <input type="text" name="items[][sub_title]" placeholder="Enter sub-title" class="form-control" value="{{ $item['sub_title'] ?? '' }}">
                            </div>
                            <div class="col-md-3 col-10">
                                <label class="form-label">Image</label>
                                <input type="file" name="items[][image]" class="form-control">
                                @if(isset($item['image']))
                                    <img src="{{ asset('storage/' . $item['image']) }}" class="img-thumbnail mt-2" style="width:64px; height:64px; object-fit:cover;">
                                @endif
                            </div>
                            <div class="col-md-1 col-2">
                                <button type="button" class="btn btn-outline-danger remove-button" data-target=".CoreFeatureItem">
                                    <iconify-icon icon="ic:twotone-close"></iconify-icon>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Add New Core Feature Item -->
            <div class="col-12">
                <button type="button" class="btn btn-outline-primary addCoreFeature">
                    <iconify-icon icon="simple-line-icons:plus" class="me-2"></iconify-icon> Add
                </button>
            </div>

            <!-- Submit -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
