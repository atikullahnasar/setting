<div id="headerMenu" role="tabpanel" aria-labelledby="headerMenu-tab" class="space-y-6">
    <h5 class="text-center text-xl font-semibold mb-4">Header Menu</h5>

    <form id="headerMenuForm" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="_key" value="header_menu">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Name -->
            <div>
                <label for="headerMenuName" class="block text-gray-700 font-medium mb-1">Name</label>
                <input type="text" id="headerMenuName" name="name" placeholder="Enter name"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ $settings['header_menu']['name'] ?? '' }}">
            </div>

            <!-- Section Enabled Switch -->
            <div class="flex items-center md:justify-start gap-4">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="hidden" name="enabled" value="off">
                    <input type="checkbox" name="enabled" id="headerMenuEnabled" class="sr-only peer" value="on" {{ ($settings['header_menu']['enabled'] ?? false) ? 'checked' : '' }}>
                    <span class="relative w-11 h-6 bg-gray-300 rounded-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600 peer-checked:after:translate-x-full"></span>
                </label>
                <label class="font-medium text-gray-700" for="headerMenuEnabled">Section Enabled</label>
            </div>

            <!-- Menu Pages Switches -->
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-medium mb-2">Menu Pages</label>
                <div class="flex flex-wrap gap-3">
                    @forelse($customPages as $page)
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="page-{{ $page->id }}" name="pages[]" value="{{ $page->id }}"
                                   class="sr-only peer" {{ in_array($page->id, $settings['header_menu']['pages'] ?? []) ? 'checked' : '' }}>
                            <span class="relative w-11 h-6 bg-gray-300 rounded-full
                                         after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                         after:bg-white after:border after:border-gray-300 after:rounded-full
                                         after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600
                                         peer-checked:after:translate-x-full"></span>
                            <span class="ml-2 text-gray-700">{{ $page->title }}</span>
                        </label>
                    @empty
                        <span class="text-gray-500">No pages available</span>
                    @endforelse
                </div>
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
