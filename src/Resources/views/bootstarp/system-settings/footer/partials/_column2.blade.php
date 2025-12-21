<div id="column2" role="tabpanel" aria-labelledby="column2-tab" style="display:none;">
    <form id="column2Form" method="POST">
        @csrf
        <input type="hidden" name="_key" value="footer_column2">

        <div class="row">
            <!-- Name -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter name" value="{{ $settings['footer_column2']['name'] ?? 'column2' }}">
            </div>

            <!-- Pages Checkboxes -->
            <div class="col-md-6 mb-3">
                <label class="form-label d-block">Pages</label>
                @foreach($customPages as $page)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="pages[]" value="{{ $page->id }}" id="page_{{ $page->id }}"
                            {{ in_array($page->id, $settings['footer_column2']['pages'] ?? []) ? 'checked' : '' }}>
                        <label class="form-check-label" for="page_{{ $page->id }}">{{ $page->title }}</label>
                    </div>
                @endforeach
            </div>

            <!-- Enabled Switch -->
            <div class="col-md-6 mb-3">
                <div class="form-check form-switch">
                    <input type="hidden" name="enabled" value="off">
                    <input type="checkbox" class="form-check-input" name="enabled" id="footer_column2_enabled" {{ isset($settings['footer_column2']['enabled']) && $settings['footer_column2']['enabled'] == 'on' ? 'checked' : '' }}>
                    <label class="form-check-label" for="footer_column2_enabled">Footer Column 2 Enabled</label>
                </div>
            </div>

            <!-- Submit -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
