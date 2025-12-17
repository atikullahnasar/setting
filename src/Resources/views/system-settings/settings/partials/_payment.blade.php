<div id="Payment" class="tab-pane" role="tabpanel">
    <form id="payment-settings-form" method="POST">
        @csrf
        <input type="hidden" name="_key" value="payment_settings">

        <div class="row g-3">
            <!-- Currency Icon -->
            <div class="col-md-6">
                <label class="form-label">Currency Icon</label>
                <input type="text" name="currency_icon" class="form-control" value="{{ $settings['payment_settings']['currency_icon'] ?? '' }}">
            </div>

            <!-- Currency Code -->
            <div class="col-md-6">
                <label class="form-label">Currency Code</label>
                <input type="text" name="currency_code" class="form-control" value="{{ $settings['payment_settings']['currency_code'] ?? '' }}">
            </div>

            <!-- Stripe Payment -->
            <div class="col-12">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="stripe_payment" id="stripe_payment" {{ isset($settings['payment_settings']['stripe_payment']) && $settings['payment_settings']['stripe_payment'] == 'on' ? 'checked' : '' }}>
                    <label class="form-check-label" for="stripe_payment">Stripe Payment</label>
                </div>
            </div>

            <!-- Stripe Keys -->
            <div class="col-md-6">
                <label class="form-label">Stripe Account Key</label>
                <input type="text" name="stripe_key" class="form-control" value="{{ $settings['payment_settings']['stripe_key'] ?? '' }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Stripe Secret Key</label>
                <input type="text" name="stripe_secret" class="form-control" value="{{ $settings['payment_settings']['stripe_secret'] ?? '' }}">
            </div>

            <!-- Stripe Mode -->
            <div class="col-12">
                <label class="form-label">Stripe Account Mode</label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stripe_mode" id="stripe_sandbox" value="sandbox" {{ isset($settings['payment_settings']['stripe_mode']) && $settings['payment_settings']['stripe_mode'] == 'sandbox' ? 'checked' : '' }}>
                        <label class="form-check-label" for="stripe_sandbox">Sandbox</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stripe_mode" id="stripe_live" value="live" {{ isset($settings['payment_settings']['stripe_mode']) && $settings['payment_settings']['stripe_mode'] == 'live' ? 'checked' : '' }}>
                        <label class="form-check-label" for="stripe_live">Live</label>
                    </div>
                </div>
            </div>

            <!-- Paypal Payment -->
            <div class="col-12">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="paypal_payment" id="paypal_payment" {{ isset($settings['payment_settings']['paypal_payment']) && $settings['payment_settings']['paypal_payment'] == 'on' ? 'checked' : '' }}>
                    <label class="form-check-label" for="paypal_payment">Paypal Payment</label>
                </div>
            </div>

            <!-- Paypal Keys -->
            <div class="col-md-6">
                <label class="form-label">Paypal Client ID</label>
                <input type="text" name="paypal_client_id" class="form-control" value="{{ $settings['payment_settings']['paypal_client_id'] ?? '' }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Paypal Secret Key</label>
                <input type="text" name="paypal_secret" class="form-control" value="{{ $settings['payment_settings']['paypal_secret'] ?? '' }}">
            </div>

            <!-- Paypal Mode -->
            <div class="col-12">
                <label class="form-label">Paypal Account Mode</label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paypal_mode" id="paypal_sandbox" value="sandbox" {{ isset($settings['payment_settings']['paypal_mode']) && $settings['payment_settings']['paypal_mode'] == 'sandbox' ? 'checked' : '' }}>
                        <label class="form-check-label" for="paypal_sandbox">Sandbox</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paypal_mode" id="paypal_live" value="live" {{ isset($settings['payment_settings']['paypal_mode']) && $settings['payment_settings']['paypal_mode'] == 'live' ? 'checked' : '' }}>
                        <label class="form-check-label" for="paypal_live">Live</label>
                    </div>
                </div>
            </div>

            <!-- Bank Transfer -->
            <div class="col-12">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="bank_transfer_payment" id="bank_transfer_payment" {{ isset($settings['payment_settings']['bank_transfer_payment']) && $settings['payment_settings']['bank_transfer_payment'] == 'on' ? 'checked' : '' }}>
                    <label class="form-check-label" for="bank_transfer_payment">Bank Transfer Payment</label>
                </div>
            </div>

            <!-- Bank Details -->
            <div class="col-md-6">
                <label class="form-label">Bank Name</label>
                <input type="text" name="bank_name" class="form-control" value="{{ $settings['payment_settings']['bank_name'] ?? '' }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Bank Holder Name</label>
                <input type="text" name="bank_holder_name" class="form-control" value="{{ $settings['payment_settings']['bank_holder_name'] ?? '' }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Bank Account Number</label>
                <input type="text" name="bank_account_number" class="form-control" value="{{ $settings['payment_settings']['bank_account_number'] ?? '' }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Bank IFSC</label>
                <input type="text" name="bank_ifsc" class="form-control" value="{{ $settings['payment_settings']['bank_ifsc'] ?? '' }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Other Details</label>
                <input type="text" name="other_details" class="form-control" value="{{ $settings['payment_settings']['other_details'] ?? '' }}">
            </div>

            <!-- Flutterwave Payment -->
            <div class="col-12">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="flutterwave_payment" id="flutterwave_payment" {{ isset($settings['payment_settings']['flutterwave_payment']) && $settings['payment_settings']['flutterwave_payment'] == 'on' ? 'checked' : '' }}>
                    <label class="form-check-label" for="flutterwave_payment">Flutterwave Payment</label>
                </div>
            </div>

            <!-- Flutterwave Keys -->
            <div class="col-md-6">
                <label class="form-label">Public Key</label>
                <input type="text" name="flutterwave_public_key" class="form-control" value="{{ $settings['payment_settings']['flutterwave_public_key'] ?? '' }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Secret Key</label>
                <input type="text" name="flutterwave_secret_key" class="form-control" value="{{ $settings['payment_settings']['flutterwave_secret_key'] ?? '' }}">
            </div>

            <!-- Flutterwave Mode -->
            <div class="col-12">
                <label class="form-label">Flutterwave Account Mode</label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flutterwave_mode" id="flutterwave_sandbox" value="sandbox" {{ isset($settings['payment_settings']['flutterwave_mode']) && $settings['payment_settings']['flutterwave_mode'] == 'sandbox' ? 'checked' : '' }}>
                        <label class="form-check-label" for="flutterwave_sandbox">Sandbox</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flutterwave_mode" id="flutterwave_live" value="live" {{ isset($settings['payment_settings']['flutterwave_mode']) && $settings['payment_settings']['flutterwave_mode'] == 'live' ? 'checked' : '' }}>
                        <label class="form-check-label" for="flutterwave_live">Live</label>
                    </div>
                </div>
            </div>

            <!-- Paddle Payment -->
            <div class="col-12">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="paddle_payment" id="paddle_payment" {{ isset($settings['payment_settings']['paddle_payment']) && $settings['payment_settings']['paddle_payment'] == 'on' ? 'checked' : '' }}>
                    <label class="form-check-label" for="paddle_payment">Paddle Payment</label>
                </div>
            </div>

            <!-- Paddle Keys -->
            <div class="col-md-6">
                <label class="form-label">Public Key</label>
                <input type="text" name="paddle_api_key" class="form-control" value="{{ $settings['payment_settings']['paddle_api_key'] ?? '' }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Secret Key</label>
                <input type="text" name="paddle_secret_key" class="form-control" value="{{ $settings['payment_settings']['paddle_secret_key'] ?? '' }}">
            </div>

            <!-- Paddle Mode -->
            <div class="col-12">
                <label class="form-label">Paddle Account Mode</label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paddle_mode" id="paddle_sandbox" value="sandbox" {{ isset($settings['payment_settings']['paddle_mode']) && $settings['payment_settings']['paddle_mode'] == 'sandbox' ? 'checked' : '' }}>
                        <label class="form-check-label" for="paddle_sandbox">Sandbox</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paddle_mode" id="paddle_live" value="live" {{ isset($settings['payment_settings']['paddle_mode']) && $settings['payment_settings']['paddle_mode'] == 'live' ? 'checked' : '' }}>
                        <label class="form-check-label" for="paddle_live">Live</label>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
