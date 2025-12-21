<div id="Payment" role="tabpanel" class="space-y-6">
    <form id="payment-settings-form" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="_key" value="payment_settings">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Currency Icon -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Currency Icon</label>
                <input type="text" name="currency_icon"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       value="{{ $settings['payment_settings']['currency_icon'] ?? '' }}">
            </div>

            <!-- Currency Code -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Currency Code</label>
                <input type="text" name="currency_code"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       value="{{ $settings['payment_settings']['currency_code'] ?? '' }}">
            </div>

            <!-- Stripe Payment Switch -->
            <div class="md:col-span-2 flex items-center gap-4">
                <label for="stripe_payment" class="text-sm font-medium text-gray-700">Stripe Payment</label>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="hidden" name="stripe_payment" value="off">
                    <input type="checkbox" id="stripe_payment" name="stripe_payment" class="sr-only peer" value="on" {{ isset($settings['payment_settings']['stripe_payment']) && $settings['payment_settings']['stripe_payment'] == 'on' ? 'checked' : '' }}>
                    <span class="relative w-11 h-6 bg-gray-300 rounded-full
                                 after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                 after:bg-white after:border after:border-gray-300 after:rounded-full
                                 after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600
                                 peer-checked:after:translate-x-full"></span>
                </label>
            </div>

            <!-- Stripe Keys -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Stripe Account Key</label>
                <input type="text" name="stripe_key"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       value="{{ $settings['payment_settings']['stripe_key'] ?? '' }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Stripe Secret Key</label>
                <input type="text" name="stripe_secret"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       value="{{ $settings['payment_settings']['stripe_secret'] ?? '' }}">
            </div>

            <!-- Stripe Mode Radios -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Stripe Account Mode</label>
                <div class="flex gap-6">
                    <label class="inline-flex items-center gap-2">
                        <input type="radio" name="stripe_mode" id="stripe_sandbox" value="sandbox" class="peer" {{ isset($settings['payment_settings']['stripe_mode']) && $settings['payment_settings']['stripe_mode'] == 'sandbox' ? 'checked' : '' }}>
                        <span>Sandbox</span>
                    </label>
                    <label class="inline-flex items-center gap-2">
                        <input type="radio" name="stripe_mode" id="stripe_live" value="live" class="peer" {{ isset($settings['payment_settings']['stripe_mode']) && $settings['payment_settings']['stripe_mode'] == 'live' ? 'checked' : '' }}>
                        <span>Live</span>
                    </label>
                </div>
            </div>

            <!-- Paypal Payment Switch -->
            <div class="md:col-span-2 flex items-center gap-4">
                <label for="paypal_payment" class="text-sm font-medium text-gray-700">Paypal Payment</label>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="hidden" name="paypal_payment" value="off">
                    <input type="checkbox" id="paypal_payment" name="paypal_payment" class="sr-only peer" value="on" {{ isset($settings['payment_settings']['paypal_payment']) && $settings['payment_settings']['paypal_payment'] == 'on' ? 'checked' : '' }}>
                    <span class="relative w-11 h-6 bg-gray-300 rounded-full
                                 after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                 after:bg-white after:border after:border-gray-300 after:rounded-full
                                 after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600
                                 peer-checked:after:translate-x-full"></span>
                </label>
            </div>

            <!-- Paypal Keys -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Paypal Client ID</label>
                <input type="text" name="paypal_client_id"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       value="{{ $settings['payment_settings']['paypal_client_id'] ?? '' }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Paypal Secret Key</label>
                <input type="text" name="paypal_secret"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       value="{{ $settings['payment_settings']['paypal_secret'] ?? '' }}">
            </div>

            <!-- Paypal Mode Radios -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Paypal Account Mode</label>
                <div class="flex gap-6">
                    <label class="inline-flex items-center gap-2">
                        <input type="radio" name="paypal_mode" id="paypal_sandbox" value="sandbox" class="peer" {{ isset($settings['payment_settings']['paypal_mode']) && $settings['payment_settings']['paypal_mode'] == 'sandbox' ? 'checked' : '' }}>
                        <span>Sandbox</span>
                    </label>
                    <label class="inline-flex items-center gap-2">
                        <input type="radio" name="paypal_mode" id="paypal_live" value="live" class="peer" {{ isset($settings['payment_settings']['paypal_mode']) && $settings['payment_settings']['paypal_mode'] == 'live' ? 'checked' : '' }}>
                        <span>Live</span>
                    </label>
                </div>
            </div>

            <!-- Bank Transfer Switch -->
            <div class="md:col-span-2 flex items-center gap-4">
                <label for="bank_transfer_payment" class="text-sm font-medium text-gray-700">Bank Transfer Payment</label>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="hidden" name="bank_transfer_payment" value="off">
                    <input type="checkbox" id="bank_transfer_payment" name="bank_transfer_payment" class="sr-only peer" value="on" {{ isset($settings['payment_settings']['bank_transfer_payment']) && $settings['payment_settings']['bank_transfer_payment'] == 'on' ? 'checked' : '' }}>
                    <span class="relative w-11 h-6 bg-gray-300 rounded-full
                                 after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                 after:bg-white after:border after:border-gray-300 after:rounded-full
                                 after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600
                                 peer-checked:after:translate-x-full"></span>
                </label>
            </div>

            <!-- Bank Details -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bank Name</label>
                <input type="text" name="bank_name"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       value="{{ $settings['payment_settings']['bank_name'] ?? '' }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bank Holder Name</label>
                <input type="text" name="bank_holder_name"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       value="{{ $settings['payment_settings']['bank_holder_name'] ?? '' }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bank Account Number</label>
                <input type="text" name="bank_account_number"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       value="{{ $settings['payment_settings']['bank_account_number'] ?? '' }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bank IFSC</label>
                <input type="text" name="bank_ifsc"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       value="{{ $settings['payment_settings']['bank_ifsc'] ?? '' }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Other Details</label>
                <input type="text" name="other_details"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       value="{{ $settings['payment_settings']['other_details'] ?? '' }}">
            </div>

            <!-- Submit Button -->
            <div class="md:col-span-2 pt-4">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-medium transition">
                    Save
                </button>
            </div>

        </div>
    </form>
</div>
