<div id="overView" role="tabpanel" aria-labelledby="overView-tab">
     <h5 class="mb-3 text-center ">OverView</h5>
    <form id="overviewForm" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_key" value="overview">

        <div class="row g-3">
            <!-- Name -->
            <div class="col-md-6 col-12">
                <label for="overviewName" class="form-label">Name</label>
                <input type="text" id="overviewName" name="name" placeholder="Enter name" class="form-control" value="{{ $settings['overview']['name'] ?? '' }}">
            </div>

            <!-- Section Enabled -->
            <div class="col-md-6 col-12">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input" type="checkbox" id="overviewEnabled" name="enabled" {{ ($settings['overview']['enabled'] ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="overviewEnabled">Section Enabled</label>
                </div>
            </div>

            <!-- Boxes (1 to 4) -->
            @for ($i = 1; $i <= 4; $i++)
                <!-- Box Title -->
                <div class="col-md-4 col-12">
                    <label for="box{{ $i }}Title" class="form-label">{{ $i }} Box Title</label>
                    <input type="text" id="box{{ $i }}Title" name="box{{ $i }}_title" placeholder="Enter box title" class="form-control" value="{{ $settings['overview']['box' . $i . '_title'] ?? '' }}">
                </div>

                <!-- Box Number -->
                <div class="col-md-4 col-12">
                    <label for="box{{ $i }}Number" class="form-label">{{ $i }} Box Number</label>
                    <input type="number" id="box{{ $i }}Number" min="1" name="box{{ $i }}_number" placeholder="Enter number" class="form-control" value="{{ $settings['overview']['box' . $i . '_number'] ?? '' }}">
                </div>

                <!-- Box Image -->
                <div class="col-md-4 col-12">
                    <label class="form-label">{{ $i }} Box Image</label>
                    <input type="file" name="box{{ $i }}_image" class="form-control">
                    @if(isset($settings['overview']['box' . $i . '_image']))
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $settings['overview']['box' . $i . '_image']) }}" alt="" class="rounded-circle" style="width:40px; height:40px; object-fit:cover;">
                        </div>
                    @endif
                </div>
            @endfor

            <!-- Submit Button -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
