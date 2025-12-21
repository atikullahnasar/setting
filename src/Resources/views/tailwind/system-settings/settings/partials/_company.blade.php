<div id="Company" role="tabpanel" class="space-y-6">
    <form id="company-settings-form" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="_key" value="company_settings">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Company Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
                <input type="text" name="company_name"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       placeholder="Enter company name"
                       value="{{ $settings['company_settings']['company_name'] ?? '' }}">
            </div>

            <!-- Company Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Company Email</label>
                <input type="email" name="company_email"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       placeholder="Enter company email"
                       value="{{ $settings['company_settings']['company_email'] ?? '' }}">
            </div>

            <!-- Phone Number -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                <input type="tel" name="company_phone_number"
                       pattern="^\+?[0-9\s\-\(\)]{7,20}$"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       placeholder="Enter phone number"
                       value="{{ $settings['company_settings']['company_phone_number'] ?? '' }}">
            </div>

            <!-- Address -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                <input type="text" name="company_address"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       placeholder="Enter address"
                       value="{{ $settings['company_settings']['company_address'] ?? '' }}">
            </div>

            <!-- Currency Icon -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Currency Icon</label>
                <input type="text" name="company_currency_icon"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       placeholder="Enter currency icon"
                       value="{{ $settings['company_settings']['company_currency_icon'] ?? '' }}">
            </div>

            <!-- Timezone -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Timezone</label>
                <select name="company_timezone" id="company_timezone"
                        class="w-full rounded border border-gray-300 px-3 py-2">
                    @foreach($countries as $country)
                        @foreach(json_decode($country->timezones, true) as $timezone)
                            <option value="{{ $timezone['zoneName'] }}"
                                {{ ($settings['company_settings']['company_timezone'] ?? '') === $timezone['zoneName'] ? 'selected' : '' }}>
                                ({{ $timezone['gmtOffsetName'] }}) {{ $timezone['zoneName'] }} ({{ $timezone['tzName'] }})
                            </option>
                        @endforeach
                    @endforeach
                </select>
            </div>

            <!-- Invoice Prefix -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Invoice Number Prefix</label>
                <input type="text" name="invoice_number_prefix"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       placeholder="Enter invoice number prefix"
                       value="{{ $settings['company_settings']['invoice_number_prefix'] ?? '' }}">
            </div>

            <!-- Expense Prefix -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Expense Number Prefix</label>
                <input type="text" name="expense_number_prefix"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       placeholder="Enter expense number prefix"
                       value="{{ $settings['company_settings']['expense_number_prefix'] ?? '' }}">
            </div>

            <!-- Agreement Prefix -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Agreement Number Prefix</label>
                <input type="text" name="agreement_number_prefix"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       placeholder="Enter agreement number prefix"
                       value="{{ $settings['company_settings']['agreement_number_prefix'] ?? '' }}">
            </div>

            <!-- Date Format -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">System Date Format</label>
                <div class="space-y-2">
                    @foreach(['M j, Y'=>'May 25, 2025','y-m-d'=>'25-05-25','d-m-y'=>'25-05-25','m-d-y'=>'05-25-25'] as $val=>$label)
                        <label class="flex items-center gap-2 text-sm">
                            <input type="radio" name="company_date_format" value="{{ $val }}"
                                   class="text-blue-600 focus:ring-blue-500"
                                   {{ ($settings['company_settings']['company_date_format'] ?? '') === $val ? 'checked' : '' }}>
                            {{ $label }}
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Time Format -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">System Time Format</label>
                <div class="space-y-2">
                    @foreach(['H:i'=>'09:34','g:i A'=>'9:34 AM','g:i a'=>'9:34 am'] as $val=>$label)
                        <label class="flex items-center gap-2 text-sm">
                            <input type="radio" name="company_time_format" value="{{ $val }}" class="text-blue-600 focus:ring-blue-500" {{ ($settings['company_settings']['company_time_format'] ?? '') === $val ? 'checked' : '' }}>
                            {{ $label }}
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Submit -->
            <div class="md:col-span-2 pt-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-medium transition">
                    Save
                </button>
            </div>

        </div>
    </form>
</div>
