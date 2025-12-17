<div id="offer" role="tabpanel" aria-labelledby="offer-tab">
     <h5 class="mb-3 text-center ">Offer</h5>
    <form id="offerForm" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_key" value="offer">

        <div class="row g-3">
            <!-- Name -->
            <div class="col-md-6 col-12">
                <label for="offerName" class="form-label">Name</label>
                <input type="text" id="offerName" name="name" placeholder="Enter name" class="form-control" value="{{ $settings['offer']['name'] ?? '' }}">
            </div>

            <!-- Section Enabled -->
            <div class="col-md-6 col-12">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input" type="checkbox" id="offerEnabled" name="enabled" {{ ($settings['offer']['enabled'] ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="offerEnabled">Section Enabled</label>
                </div>
            </div>

            <!-- Main Title -->
            <div class="col-md-6 col-12">
                <label for="offerMainTitle" class="form-label">Main Title</label>
                <input type="text" id="offerMainTitle" name="main_title" placeholder="Enter main title" class="form-control" value="{{ $settings['offer']['main_title'] ?? '' }}">
            </div>

            <!-- Main Info -->
            <div class="col-md-6 col-12">
                <label for="offerMainInfo" class="form-label">Main Info</label>
                <input type="text" id="offerMainInfo" name="main_info" placeholder="Enter main info" class="form-control" value="{{ $settings['offer']['main_info'] ?? '' }}">
            </div>

            <!-- Offer Items List -->
            <div class="col-12" id="offerList">
                @if(isset($settings['offer']['items']))
                @foreach($settings['offer']['items'] as $item)
                        <div class="offerItem border p-3 row g-3 mt-2 mb-2">
                            <!-- Title -->
                            <div class="col-md-5 col-12">
                                <label class="form-label">Title</label>
                                <input type="text" name="items[][title]" placeholder="Enter title" class="form-control" value="{{ $item['title'] ?? '' }}">
                            </div>

                            <!-- Image -->
                            <div class="col-md-5 col-12">
                                <label class="form-label">Image</label>
                                <input type="file" name="items[][image]" class="form-control">
                                @if(isset($item['image']))
                                    @php
                                        $imagePath = is_array($item['image']) && isset($item['image'][0]) ? $item['image'][0] : $item['image'];
                                    @endphp
                                    @if($imagePath)
                                        <img src="{{ asset('storage/' . $imagePath) }}" alt="" class="w-16 h-16 object-cover mt-2">
                                    @endif
                                @endif

                            </div>

                            <!-- Info -->
                            <div class="col-12">
                                <label class="form-label">Info</label>
                                <input type="text" name="items[][info]" placeholder="Enter info" class="form-control" value="{{ $item['info'] ?? '' }}">
                            </div>

                            <!-- Item Enabled -->
                            <div class="col-md-2 col-6">
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" type="checkbox" name="items[][enabled]" {{ ($item['enabled'] ?? false) ? 'checked' : '' }}>
                                    <label class="form-check-label">Enabled</label>
                                </div>
                            </div>

                            <!-- Remove Button -->
                            <div class="col-md-2 col-6">
                                <button type="button" class="btn btn-outline-danger remove-button"  data-target=".offerItem"><iconify-icon icon="ic:twotone-close" class="text-xl"></iconify-icon></button>
                            </div>
                        </div>
                @endforeach
                @endif
            </div>

            <!-- Add New Offer Item Button -->
            <div class="col-12">
                <button type="button" class="btn btn-outline-primary addOfferItem">
                    <iconify-icon icon="simple-line-icons:plus" class="me-2"></iconify-icon> Add
                </button>
            </div>

            <!-- Submit Button -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
