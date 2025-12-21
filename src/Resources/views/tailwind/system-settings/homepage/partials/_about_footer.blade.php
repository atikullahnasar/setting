<div id="aboutFooter" role="tabpanel" aria-labelledby="aboutFooter-tab" class="space-y-6">
    <h5 class="text-center text-xl font-semibold mb-4">AboutUS - Footer</h5>

    <form id="aboutFooterForm" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="_key" value="about_footer">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Name -->
            <div>
                <label for="aboutFooterName" class="block text-gray-700 font-medium mb-1">Name</label>
                <input type="text" id="aboutFooterName" name="name" placeholder="Enter name"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ $settings['about_footer']['name'] ?? '' }}">
            </div>

            <!-- Section Enabled -->
            <div class="flex items-center md:justify-end gap-4">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="hidden" name="enabled" value="off">
                    <input type="checkbox" name="enabled" id="aboutFooterEnabled" class="sr-only peer" value="on"
                           {{ ($settings['about_footer']['enabled'] ?? false) ? 'checked' : '' }}>
                    <span class="relative w-11 h-6 bg-gray-300 rounded-full peer-checked:bg-green-600
                                 after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                 after:bg-white after:border after:border-gray-300 after:rounded-full
                                 after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full"></span>
                </label>
                <label class="font-medium text-gray-700" for="aboutFooterEnabled">Section Enabled</label>
            </div>

            <!-- Main Title -->
            <div>
                <label for="aboutFooterMainTitle" class="block text-gray-700 font-medium mb-1">Main Title</label>
                <input type="text" id="aboutFooterMainTitle" name="main_title" placeholder="Enter main title"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ $settings['about_footer']['main_title'] ?? '' }}">
            </div>

            <!-- Main Info -->
            <div>
                <label for="aboutFooterMainInfo" class="block text-gray-700 font-medium mb-1">Main Info</label>
                <input type="text" id="aboutFooterMainInfo" name="main_info" placeholder="Enter main info"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ $settings['about_footer']['main_info'] ?? '' }}">
            </div>

            <!-- Submit Button -->
            <div class="md:col-span-2">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-medium transition-colors">
                    Save
                </button>
            </div>

        </div>
    </form>
</div>
