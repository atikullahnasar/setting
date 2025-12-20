<div id="chooseUS" role="tabpanel" aria-labelledby="chooseUS-tab" >
    <h5 class="mb-3 text-center ">Choose Us</h5>

    <form id="chooseUsForm" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_key" value="choose_us">

        <div class="row g-3">
            <!-- Name -->
            <div class="col-md-6 col-12">
                <label for="chooseUsName" class="form-label">Name</label>
                <input type="text" id="chooseUsName" name="name" class="form-control" placeholder="Enter name" value="{{ $settings['choose_us']['name'] ?? '' }}">
            </div>

            <!-- Section Enabled -->
            <div class="col-md-6 col-12">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input" type="checkbox" id="chooseUsEnabled" name="enabled" {{ ($settings['choose_us']['enabled'] ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="chooseUsEnabled">Section Enabled</label>
                </div>
            </div>

            <!-- Main Title -->
            <div class="col-12">
                <label for="chooseUsMainTitle" class="form-label">Main Title</label>
                <input type="text" id="chooseUsMainTitle" name="main_title" class="form-control" placeholder="Enter main title" value="{{ $settings['choose_us']['main_title'] ?? '' }}">
            </div>

            <!-- Items List -->
            <div class="col-12" id="chooseUsList">
                @if(isset($settings['choose_us']['items']))
                    @foreach($settings['choose_us']['items'] as $index => $item)
                        <div class="chooseUsItem row g-3 align-items-end border p-3 rounded mb-2">
                            <div class="col-md-4 col-12">
                                <label class="form-label">Main Info</label>
                                <input type="text" name="items[{{ $index }}][info]" class="form-control" value="{{ $item['info'] ?? '' }}">
                            </div>
                            <div class="col-md-4 col-12">
                                <label class="form-label">Main Details</label>
                                <input type="text" name="items[{{ $index }}][details]" class="form-control" value="{{ $item['details'] ?? '' }}">
                            </div>
                            <div class="col-md-3 col-10">
                                <label class="form-label">Main Image</label>
                                <input type="file" name="items[{{ $index }}][image]" class="form-control">
                                @if(isset($item['image']))
                                    <img src="{{ asset('storage/' . $item['image']) }}" class="img-thumbnail mt-2" style="width:64px; height:64px; object-fit:cover;">
                                @endif
                            </div>
                            <div class="col-md-1 col-2">
                                <button type="button" class="btn btn-outline-danger remove-chooseUsItem">
                                    <iconify-icon icon="ic:twotone-close"></iconify-icon>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Add Item Button -->
            <div class="col-12">
                <button type="button" class="btn btn-outline-primary addChooseUsItem">
                    <iconify-icon icon="simple-line-icons:plus" class="me-2"></iconify-icon> Add
                </button>
            </div>

            <!-- Banner Image -->
            <div class="col-12">
                <label class="form-label">Banner Image</label>
                <input type="file" name="banner_image" class="form-control">
                @if(isset($settings['choose_us']['banner_image']))
                    <img src="{{ asset('storage/' . $settings['choose_us']['banner_image']) }}" alt="" class="img-thumbnail mt-2" style="width:64px; height:64px; object-fit:cover;">
                @endif
            </div>

            <!-- Submit Button -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
