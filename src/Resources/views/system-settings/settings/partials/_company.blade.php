<div id="Company" class="tab-pane" role="tabpanel">
    <form id="company-settings-form" method="POST">
        @csrf
        <input type="hidden" name="_key" value="company_settings">

        <div class="row g-3">
            <!-- Company Name -->
            <div class="col-md-6">
                <label class="form-label">Company Name</label>
                <input type="text" name="company_name" class="form-control" placeholder="Enter company name" value="{{ $settings['company_settings']['company_name'] ?? '' }}">
            </div>

            <!-- Company Email -->
            <div class="col-md-6">
                <label class="form-label">Company Email</label>
                <input type="email" name="company_email" class="form-control" placeholder="Enter company email" value="{{ $settings['company_settings']['company_email'] ?? '' }}">
            </div>

            <!-- Phone Number -->
            <div class="col-md-6">
                <label class="form-label">Phone Number</label>
                <input type="tel" name="company_phone_number" pattern="^\+?[0-9\s\-\(\)]{7,20}$" class="form-control" placeholder="Enter phone number" value="{{ $settings['company_settings']['company_phone_number'] ?? '' }}">
            </div>

            <!-- Address -->
            <div class="col-md-6">
                <label class="form-label">Address</label>
                <input type="text" name="company_address" class="form-control" placeholder="Enter address" value="{{ $settings['company_settings']['company_address'] ?? '' }}">
            </div>

            <!-- Currency Icon -->
            <div class="col-md-6">
                <label class="form-label">Currency Icon</label>
                <input type="text" name="company_currency_icon" class="form-control" placeholder="Enter currency icon" value="{{ $settings['company_settings']['company_currency_icon'] ?? '' }}">
            </div>

            <!-- Timezone -->
            <div class="col-md-6">
                <label class="form-label">Timezone</label>
                <select class="form-select" name="company_timezone" id="company_timezone">
                    @foreach($countries as $country)
                        @php
                            $timezones = json_decode($country->timezones, true);
                        @endphp
                        @foreach($timezones as $timezone)
                            <option value="{{ $timezone['zoneName'] }}" {{ (isset($settings['company_settings']['company_timezone']) && $settings['company_settings']['company_timezone'] == $timezone['zoneName']) ? 'selected' : '' }}>
                                ({{ $timezone['gmtOffsetName'] }}) {{ $timezone['zoneName'] }} ({{ $timezone['tzName'] }})
                            </option>
                        @endforeach
                    @endforeach
                </select>
            </div>

            <!-- Invoice Number Prefix -->
            <div class="col-md-6">
                <label class="form-label">Invoice Number Prefix</label>
                <input type="text" name="invoice_number_prefix" class="form-control" placeholder="Enter invoice number prefix" value="{{ $settings['company_settings']['invoice_number_prefix'] ?? '' }}">
            </div>

            <!-- Expense Number Prefix -->
            <div class="col-md-6">
                <label class="form-label">Expense Number Prefix</label>
                <input type="text" name="expense_number_prefix" class="form-control" placeholder="Enter expense number prefix" value="{{ $settings['company_settings']['expense_number_prefix'] ?? '' }}">
            </div>

            <!-- Agreement Number Prefix -->
            <div class="col-md-6">
                <label class="form-label">Agreement Number Prefix</label>
                <input type="text" name="agreement_number_prefix" class="form-control" placeholder="Enter agreement number prefix" value="{{ $settings['company_settings']['agreement_number_prefix'] ?? '' }}">
            </div>

            <!-- System Date Format -->
            <div class="col-md-6">
                <label class="form-label d-block">System Date Format</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="company_date_format" id="company_date_format1" value="M j, Y" {{ isset($settings['company_settings']['company_date_format']) && $settings['company_settings']['company_date_format'] == 'M j, Y' ? 'checked' : '' }}>
                    <label class="form-check-label" for="company_date_format1">May 25,2025</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="company_date_format" id="company_date_format2" value="y-m-d" {{ isset($settings['company_settings']['company_date_format']) && $settings['company_settings']['company_date_format'] == 'y-m-d' ? 'checked' : '' }}>
                    <label class="form-check-label" for="company_date_format2">25-05-25</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="company_date_format" id="company_date_format3" value="d-m-y" {{ isset($settings['company_settings']['company_date_format']) && $settings['company_settings']['company_date_format'] == 'd-m-y' ? 'checked' : '' }}>
                    <label class="form-check-label" for="company_date_format3">25-05-25</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="company_date_format" id="company_date_format4" value="m-d-y" {{ isset($settings['company_settings']['company_date_format']) && $settings['company_settings']['company_date_format'] == 'm-d-y' ? 'checked' : '' }}>
                    <label class="form-check-label" for="company_date_format4">05-25-25</label>
                </div>
            </div>

            <!-- System Time Format -->
            <div class="col-md-6">
                <label class="form-label d-block">System Time Format</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="company_time_format" id="company_time_format1" value="H:i" {{ isset($settings['company_settings']['company_time_format']) && $settings['company_settings']['company_time_format'] == 'H:i' ? 'checked' : '' }}>
                    <label class="form-check-label" for="company_time_format1">09:34</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="company_time_format" id="company_time_format2" value="g:i A" {{ isset($settings['company_settings']['company_time_format']) && $settings['company_settings']['company_time_format'] == 'g:i A' ? 'checked' : '' }}>
                    <label class="form-check-label" for="company_time_format2">9:34 AM</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="company_time_format" id="company_time_format3" value="g:i a" {{ isset($settings['company_settings']['company_time_format']) && $settings['company_settings']['company_time_format'] == 'g:i a' ? 'checked' : '' }}>
                    <label class="form-check-label" for="company_time_format3">9:34 am</label>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
