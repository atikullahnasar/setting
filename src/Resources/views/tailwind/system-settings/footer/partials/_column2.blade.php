<div id="column2" role="tabpanel" aria-labelledby="column2-tab" class="hidden">
    <form id="column2Form" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="_key" value="footer_column2">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Name -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Name</label>
                <input type="text" name="name"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Enter name"
                       value="{{ $settings['footer_column2']['name'] ?? 'column2' }}">
            </div>

            <!-- Footer Social Enabled -->
            <div class="flex items-center md:justify-start">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="hidden" name="enabled" value="off">
                    <input type="checkbox" name="enabled" id="footer_column2_enabled" class="sr-only peer" {{ isset($settings['footer_column2']['enabled']) && $settings['footer_column2']['enabled'] == 'on' ? 'checked' : '' }}>
                    <span class="relative w-9 h-5 bg-gray-400 peer-focus:outline-none rounded-full peer dark:bg-gray-500 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-primary-600"></span>
                </label>
                <label for="footer_column2_enabled" class="relative inline-flex items-center cursor-pointer">
                    <span class="ml-3 text-gray-700 font-medium">Footer Column 2 Enabled</span>
                </label>
            </div>

            <!-- Pages Checkboxes -->
            <div>
                <label class="block text-gray-700 font-medium mb-2">Pages</label>
                <div class="space-y-1">
                    @foreach($customPages as $page)
                        <div class="flex items-center">
                            <input type="checkbox" name="pages[]" value="{{ $page->id }}" id="page_{{ $page->id }}"
                                   class="peer h-4 w-4 text-blue-500 border-gray-300 rounded"
                                   {{ in_array($page->id, $settings['footer_column2']['pages'] ?? []) ? 'checked' : '' }}>
                            <label for="page_{{ $page->id }}" class="ml-2 text-gray-700">{{ $page->title }}</label>
                        </div>
                    @endforeach
                </div>
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
