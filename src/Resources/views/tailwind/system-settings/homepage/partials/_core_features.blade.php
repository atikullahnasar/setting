<div id="coreFeatures" role="tabpanel" aria-labelledby="coreFeatures-tab" class="space-y-6">
    <h5 class="text-center text-xl font-semibold mb-4">Core Features</h5>

    <form id="coreFeaturesForm" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <input type="hidden" name="_key" value="core_features">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Name -->
            <div>
                <label for="coreFeaturesName" class="block text-gray-700 font-medium mb-1">Name</label>
                <input type="text" id="coreFeaturesName" name="name" placeholder="Enter name"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ $settings['core_features']['name'] ?? '' }}">
            </div>

            <!-- Section Enabled Switch -->
            <div class="flex items-center md:justify-end gap-4">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="hidden" name="enabled" value="off">
                    <input type="checkbox" name="enabled" id="coreFeaturesEnabled" class="sr-only peer" value="on"
                           {{ ($settings['core_features']['enabled'] ?? false) ? 'checked' : '' }}>
                    <span class="relative w-11 h-6 bg-gray-300 rounded-full
                                 after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                 after:bg-white after:border after:border-gray-300 after:rounded-full
                                 after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600
                                 peer-checked:after:translate-x-full"></span>
                </label>
                <label class="font-medium text-gray-700" for="coreFeaturesEnabled">Section Enabled</label>
            </div>

            <!-- Main Title -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Main Title</label>
                <input type="text" name="main_title" placeholder="Enter main title"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ $settings['core_features']['main_title'] ?? '' }}">
            </div>

            <!-- Main Info -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Main Info</label>
                <input type="text" name="main_info" placeholder="Enter main info"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ $settings['core_features']['main_info'] ?? '' }}">
            </div>

            <!-- Core Feature Items -->
            <div class="md:col-span-2 space-y-4" id="coreFeatureList">
                @if(isset($settings['core_features']['items']))
                    @foreach($settings['core_features']['items'] as $item)
                        <div class="CoreFeatureItem border p-4 rounded grid grid-cols-1 md:grid-cols-12 gap-3 items-end">
                            <div class="md:col-span-4">
                                <label class="block text-gray-700 font-medium mb-1">Title</label>
                                <input type="text" name="items[][title]" placeholder="Enter title"
                                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       value="{{ $item['title'] ?? '' }}">
                            </div>
                            <div class="md:col-span-4">
                                <label class="block text-gray-700 font-medium mb-1">Sub Title</label>
                                <input type="text" name="items[][sub_title]" placeholder="Enter sub-title"
                                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       value="{{ $item['sub_title'] ?? '' }}">
                            </div>
                            <div class="md:col-span-3">
                                <label class="block text-gray-700 font-medium mb-1">Image</label>
                                <input type="file" name="items[][image]"
                                       class="w-full border border-gray-300 rounded px-3 py-1">
                                @if(isset($item['image']))
                                    <img src="{{ asset('storage/' . $item['image']) }}" alt=""
                                         class="mt-2 w-16 h-16 object-cover rounded">
                                @endif
                            </div>
                            <div class="md:col-span-1 flex justify-end">
                                <button type="button" class="text-red-600 hover:text-red-800 remove-button">
                                    <iconify-icon icon="ic:twotone-close"></iconify-icon>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Add New Core Feature Item -->
            <div class="md:col-span-2">
                <button type="button"
                        class="bg-blue-100 text-blue-600 hover:bg-blue-200 px-4 py-2 rounded addCoreFeature flex items-center gap-2">
                    <iconify-icon icon="simple-line-icons:plus"></iconify-icon> Add
                </button>
            </div>

            <!-- Submit -->
            <div class="md:col-span-2 mt-3">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-medium transition-colors">
                    Save
                </button>
            </div>

        </div>
    </form>
</div>
