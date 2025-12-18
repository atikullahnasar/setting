<div id="headerMenu" role="tabpanel" aria-labelledby="headerMenu-tab">
     <h5 class="mb-3 text-center ">Header Menu</h5>
    <form id="headerMenuForm" method="POST">
        @csrf
        <input type="hidden" name="_key" value="header_menu">

        <div class="row g-3">
            <!-- Name -->
            <div class="col-md-6 col-12">
                <label for="headerMenuName" class="form-label">Name</label>
                <input type="text" id="headerMenuName" name="name" placeholder="Enter name" class="form-control" value="{{ $settings['header_menu']['name'] ?? '' }}">
            </div>

            <!-- Section Enabled -->
            <div class="col-md-6 col-12">
                <div class="form-check form-switch mt-4">
                    <input class="form-check-input" type="checkbox" id="headerMenuEnabled" name="enabled" {{ ($settings['header_menu']['enabled'] ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="headerMenuEnabled">Section Enabled</label>
                </div>
            </div>

            <!-- Menu Pages -->
            <div class="col-md-6 col-12">
                <label class="form-label d-block">Menu Pages</label>
                <div class="d-flex flex-wrap gap-2">
                    @forelse($customPages as $page)
                        <div class="form-check form-switch me-3 mb-2">
                            <input class="form-check-input" type="checkbox" id="page-{{ $page->id }}" name="pages[]" value="{{ $page->id }}" {{ in_array($page->id, $settings['header_menu']['pages'] ?? []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="page-{{ $page->id }}">{{ $page->title }}</label>
                        </div>
                    @empty
                        <span class="text-muted">No pages available</span>
                    @endforelse
                </div>
            </div>

            <!-- Submit Button -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
