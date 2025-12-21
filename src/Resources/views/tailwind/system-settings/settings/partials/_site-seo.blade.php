<div id="SiteSEO" role="tabpanel" class="space-y-6">
    <form id="site-seo-settings-form" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <input type="hidden" name="_key" value="site_seo_settings">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Meta Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
                <input type="text" name="meta_title"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       placeholder="Enter meta title"
                       value="{{ $settings['site_seo_settings']['meta_title'] ?? '' }}">
            </div>

            <!-- Meta Keyword -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Meta Keyword</label>
                <input type="text" name="meta_keyword"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       placeholder="Enter meta keyword"
                       value="{{ $settings['site_seo_settings']['meta_keyword'] ?? '' }}">
            </div>

            <!-- Meta Description -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                <input type="text" name="meta_description" class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Enter meta description" value="{{ $settings['site_seo_settings']['meta_description'] ?? '' }}">
            </div>

            <!-- Meta Image Upload -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Meta Image</label>
                <div class="flex items-center gap-4">
                    <!-- Preview -->
                    <div class="relative w-28 h-28 border border-dashed border-gray-300 rounded overflow-hidden">
                        <img id="uploaded-meta-image-preview" src="{{ isset($settings['site_seo_settings']['meta_image']) ? asset('storage/'.$settings['site_seo_settings']['meta_image']) : asset('assets/images/logo.png') }}" class="w-full h-full object-cover">
                    </div>

                    <!-- Upload Button -->
                    <label class="w-28 h-28 flex flex-col items-center justify-center border border-gray-300 rounded cursor-pointer hover:bg-gray-50 transition text-sm text-gray-600">
                        <svg class="w-6 h-6 mb-1 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5V18a2.25 2.25 0 002.25 2.25h13.5A2.25 2.25 0 0021 18v-1.5M12 3v12m0 0l-3.75-3.75M12 15l3.75-3.75"/>
                        </svg>
                        Upload
                        <input type="file" id="upload-meta-image" name="meta_image" hidden>
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="md:col-span-2 pt-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-medium transition">
                    Save
                </button>
            </div>

        </div>
    </form>
</div>
