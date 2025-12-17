<div id="column1" role="tabpanel" aria-labelledby="column1-tab">
    <form id="column1Form" method="POST">
        @csrf
        <input type="hidden" name="_key" value="footer_column1">

        <div class="row">
            <!-- Name -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter name" value="{{ $settings['footer_column1']['name'] ?? 'column1' }}">
            </div>

            <!-- Enabled Switch -->
            <div class="col-md-6 mb-3 d-flex align-items-center">
                <div class="form-check form-switch w-100">
                    <input type="hidden" name="enabled" value="off">
                    <input type="checkbox" class="form-check-input" name="enabled" id="footer_column1_enabled" {{ isset($settings['footer_column1']['enabled']) && $settings['footer_column1']['enabled'] == 'on' ? 'checked' : '' }}>
                    <label class="form-check-label" for="footer_column1_enabled">Footer Column 1 Enabled</label>
                </div>
            </div>

            <!-- Email -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{ $settings['footer_column1']['email'] ?? '' }}">
            </div>

            <!-- Contact -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Contact</label>
                <input type="tel" name="contact" class="form-control" placeholder="Enter contact" value="{{ $settings['footer_column1']['contact'] ?? '+880' }}">
            </div>

            <!-- Address -->
            <div class="col-12 mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" placeholder="Enter address" value="{{ $settings['footer_column1']['address'] ?? '' }}">
            </div>

            <!-- Submit -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
