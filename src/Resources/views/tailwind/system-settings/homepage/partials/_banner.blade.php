<div id="banner" role="tabpanel" aria-labelledby="banner-tab" class="space-y-6">
    <h5 class="text-center text-xl font-semibold mb-4">Banner</h5>

    <form id="bannerForm" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <input type="hidden" name="_key" value="banner_settings">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Header Title -->
            <div>
                <label for="headerTitle" class="block text-gray-700 font-medium mb-1">Header Title</label>
                <input type="text" id="headerTitle" name="header_title" placeholder="Enter header title"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ $settings['banner_settings']['header_title'] ?? '' }}">
            </div>

            <!-- Section Enabled Switch -->
            <div class="flex items-center md:justify-end gap-4">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="hidden" name="enabled" value="off">
                    <input type="checkbox" name="enabled" id="bannerEnabled" class="sr-only peer" value="on"
                           {{ ($settings['banner_settings']['enabled'] ?? false) ? 'checked' : '' }}>
                    <span class="relative w-11 h-6 bg-gray-300 rounded-full
                                 after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                 after:bg-white after:border after:border-gray-300 after:rounded-full
                                 after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600
                                 peer-checked:after:translate-x-full"></span>
                </label>
                <label class="font-medium text-gray-700" for="bannerEnabled">Section Enabled</label>
            </div>

            <!-- Header Subtitle -->
            <div>
                <label for="headerSubtitle" class="block text-gray-700 font-medium mb-1">Header Subtitle</label>
                <input type="text" id="headerSubtitle" name="header_subtitle" placeholder="Enter header sub-title"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ $settings['banner_settings']['header_subtitle'] ?? '' }}">
            </div>

            <!-- Header Button Text -->
            <div>
                <label for="headerButtonText" class="block text-gray-700 font-medium mb-1">Header Button Text</label>
                <input type="text" id="headerButtonText" name="header_button_text" placeholder="Enter header button text"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ $settings['banner_settings']['header_button_text'] ?? '' }}">
            </div>

            <!-- Header Button Link -->
            <div>
                <label for="headerButtonLink" class="block text-gray-700 font-medium mb-1">Header Button Link</label>
                <input type="url" id="headerButtonLink" name="header_button_link" placeholder="Enter header button link"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ $settings['banner_settings']['header_button_link'] ?? '' }}">
            </div>

            <!-- Header Sub Image -->
            <div>
                <label for="headerSubImage" class="block text-gray-700 font-medium mb-1">Header Sub Image</label>
                <input type="file" id="headerSubImage" name="header_sub_image"
                       class="w-full border border-gray-300 rounded px-3 py-2">
                @if(isset($settings['banner_settings']['header_sub_image']))
                    <img src="{{ asset('storage/' . $settings['banner_settings']['header_sub_image']) }}" alt=""
                         class="mt-2 rounded-md w-16 h-16 object-cover">
                @endif
            </div>

            <!-- Main Image -->
            <div>
                <label for="headerMainImage" class="block text-gray-700 font-medium mb-1">Main Image</label>
                <input type="file" id="headerMainImage" name="header_main_image"
                       class="w-full border border-gray-300 rounded px-3 py-2">
                @if(isset($settings['banner_settings']['header_main_image']))
                    <img src="{{ asset('storage/' . $settings['banner_settings']['header_main_image']) }}" alt=""
                         class="mt-2 rounded-md w-16 h-16 object-cover">
                @endif
            </div>

            <!-- Submit Button -->
            <div class="md:col-span-2 mt-3">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-medium transition-colors">
                    Save
                </button>
            </div>

        </div>
    </form>
</div>
