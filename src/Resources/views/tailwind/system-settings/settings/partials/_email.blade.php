<div id="Email" role="tabpanel" class="space-y-6">
    <form id="email-settings-form" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="_key" value="email_settings">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Sender Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sender Name</label>
                <input type="text" name="sender_name" placeholder="Enter sender name"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       value="{{ $settings['email_settings']['sender_name'] ?? '' }}">
            </div>

            <!-- Sender Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sender Email</label>
                <input type="email" name="sender_email" placeholder="Enter sender email"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       value="{{ $settings['email_settings']['sender_email'] ?? '' }}">
            </div>

            <!-- SMTP Driver -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">SMTP Driver</label>
                <input type="text" name="smtp_driver" placeholder="Enter SMTP driver"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       value="{{ $settings['email_settings']['smtp_driver'] ?? '' }}">
            </div>

            <!-- SMTP Host -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">SMTP Host</label>
                <input type="text" name="smtp_host" placeholder="Enter SMTP host"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       value="{{ $settings['email_settings']['smtp_host'] ?? '' }}">
            </div>

            <!-- SMTP Username -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">SMTP Username</label>
                <input type="text" name="smtp_username" placeholder="Enter SMTP username"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       value="{{ $settings['email_settings']['smtp_username'] ?? '' }}">
            </div>

            <!-- SMTP Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">SMTP Password</label>
                <input type="text" name="smtp_password" placeholder="Enter SMTP password"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       value="{{ $settings['email_settings']['smtp_password'] ?? '' }}">
            </div>

            <!-- SMTP Encryption -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">SMTP Encryption</label>
                <input type="text" name="smtp_encryption" placeholder="Enter SMTP encryption"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       value="{{ $settings['email_settings']['smtp_encryption'] ?? '' }}">
            </div>

            <!-- SMTP Port -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">SMTP Port</label>
                <input type="text" name="smtp_port" placeholder="Enter SMTP port"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       value="{{ $settings['email_settings']['smtp_port'] ?? '' }}">
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
