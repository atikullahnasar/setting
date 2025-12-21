<div id="column1" role="tabpanel" aria-labelledby="column1-tab">
    <form id="column1Form" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="_key" value="footer_column1">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Name -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Name</label>
                <input type="text" name="name"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Enter name"
                       value="{{ $settings['footer_column1']['name'] ?? 'column1' }}">
            </div>

            <!-- Enabled Switch -->
            <!-- Footer Social Enabled -->
            <div class="flex items-center md:justify-start">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="hidden" name="enabled" value="off">
                    <input type="checkbox" name="enabled" id="footer_column1_enabled" class="sr-only peer" {{ isset($settings['footer_column1']['enabled']) && $settings['footer_column1']['enabled'] == 'on' ? 'checked' : '' }}>
                    <span class="relative w-9 h-5 bg-gray-400 peer-focus:outline-none rounded-full peer dark:bg-gray-500 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-primary-600"></span>
                </label>
                <label for="footer_column1_enabled" class="relative inline-flex items-center cursor-pointer">
                    <span class="ml-3 text-gray-700 font-medium">Footer Column 1 Enabled</span>
                </label>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Enter email"
                       value="{{ $settings['footer_column1']['email'] ?? '' }}">
            </div>

            <!-- Contact -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Contact</label>
                <input type="tel" name="contact"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Enter contact"
                       value="{{ $settings['footer_column1']['contact'] ?? '+880' }}">
            </div>

            <!-- Address -->
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-medium mb-1">Address</label>
                <input type="text" name="address"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Enter address"
                       value="{{ $settings['footer_column1']['address'] ?? '' }}">
            </div>

            <!-- Submit -->
            <div class="md:col-span-2">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded font-medium transition-colors">
                    Save
                </button>
            </div>

        </div>
    </form>
</div>
