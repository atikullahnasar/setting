<div id="offer" role="tabpanel" aria-labelledby="offer-tab" class="space-y-6">
    <h5 class="text-center text-xl font-semibold mb-4">Offer</h5>

    <form id="offerForm" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <input type="hidden" name="_key" value="offer">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Name -->
            <div>
                <label for="offerName" class="block text-gray-700 font-medium mb-1">Name</label>
                <input type="text" id="offerName" name="name" placeholder="Enter name"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ $settings['offer']['name'] ?? '' }}">
            </div>

            <!-- Section Enabled Switch -->
            <div class="flex items-center md:justify-end gap-4">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="hidden" name="enabled" value="off">
                    <input type="checkbox" name="enabled" id="offerEnabled" class="sr-only peer" value="on"
                           {{ ($settings['offer']['enabled'] ?? false) ? 'checked' : '' }}>
                    <span class="relative w-11 h-6 bg-gray-300 rounded-full
                                 after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                 after:bg-white after:border after:border-gray-300 after:rounded-full
                                 after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600
                                 peer-checked:after:translate-x-full"></span>
                </label>
                <label class="font-medium text-gray-700" for="offerEnabled">Section Enabled</label>
            </div>

            <!-- Main Title -->
            <div>
                <label for="offerMainTitle" class="block text-gray-700 font-medium mb-1">Main Title</label>
                <input type="text" id="offerMainTitle" name="main_title" placeholder="Enter main title"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ $settings['offer']['main_title'] ?? '' }}">
            </div>

            <!-- Main Info -->
            <div>
                <label for="offerMainInfo" class="block text-gray-700 font-medium mb-1">Main Info</label>
                <input type="text" id="offerMainInfo" name="main_info" placeholder="Enter main info"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ $settings['offer']['main_info'] ?? '' }}">
            </div>

            <!-- Offer Items List -->
            <div class="md:col-span-2 space-y-4" id="offerList">
                @if(isset($settings['offer']['items']))
                @foreach($settings['offer']['items'] as $item)
                    <div class="offerItem border p-4 rounded space-y-3">
                        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">

                            <!-- Title -->
                            <div class="md:col-span-2">
                                <label class="block text-gray-700 font-medium mb-1">Title</label>
                                <input type="text" name="items[][title]" placeholder="Enter title"
                                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       value="{{ $item['title'] ?? '' }}">
                            </div>

                            <!-- Image -->
                            <div class="md:col-span-2">
                                <label class="block text-gray-700 font-medium mb-1">Image</label>
                                <input type="file" name="items[][image]" class="block w-full text-sm text-gray-700">
                                @if(isset($item['image']))
                                    @php
                                        $imagePath = is_array($item['image']) && isset($item['image'][0]) ? $item['image'][0] : $item['image'];
                                    @endphp
                                    @if($imagePath)
                                        <img src="{{ asset('storage/' . $imagePath) }}" alt=""
                                             class="w-16 h-16 object-cover mt-2 rounded">
                                    @endif
                                @endif
                            </div>

                            <!-- Item Enabled Switch -->
                            <div class="flex items-center gap-2">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="hidden" name="items[][enabled]" value="off">
                                    <input type="checkbox" class="sr-only peer" name="items[][enabled]" value="on"
                                           {{ ($item['enabled'] ?? false) ? 'checked' : '' }}>
                                    <span class="relative w-11 h-6 bg-gray-300 rounded-full
                                                 after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                                 after:bg-white after:border after:border-gray-300 after:rounded-full
                                                 after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600
                                                 peer-checked:after:translate-x-full"></span>
                                </label>
                                <span class="text-gray-700 font-medium">Enabled</span>
                            </div>

                            <!-- Remove Button -->
                            <div>
                                <button type="button" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded remove-button"
                                        data-target=".offerItem">
                                    <iconify-icon icon="ic:twotone-close" class="text-xl"></iconify-icon>
                                </button>
                            </div>

                        </div>

                        <!-- Info -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Info</label>
                            <input type="text" name="items[][info]" placeholder="Enter info"
                                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   value="{{ $item['info'] ?? '' }}">
                        </div>
                    </div>
                @endforeach
                @endif
            </div>

            <!-- Add New Offer Item Button -->
            <div class="md:col-span-2">
                <button type="button" class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-4 py-2 rounded addOfferItem flex items-center gap-2">
                    <iconify-icon icon="simple-line-icons:plus"></iconify-icon> Add
                </button>
            </div>

            <!-- Submit Button -->
            <div class="md:col-span-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-medium">
                    Save
                </button>
            </div>

        </div>
    </form>
</div>
