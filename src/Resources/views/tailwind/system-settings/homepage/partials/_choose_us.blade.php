<div id="chooseUS" role="tabpanel" aria-labelledby="chooseUS-tab" class="space-y-6">
    <h5 class="text-center text-xl font-semibold mb-4">Choose Us</h5>

    <form id="chooseUsForm" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <input type="hidden" name="_key" value="choose_us">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Name -->
            <div>
                <label for="chooseUsName" class="block text-gray-700 font-medium mb-1">Name</label>
                <input type="text" id="chooseUsName" name="name" placeholder="Enter name"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ $settings['choose_us']['name'] ?? '' }}">
            </div>

            <!-- Section Enabled Switch -->
            <div class="flex items-center md:justify-end gap-4">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="hidden" name="enabled" value="off">
                    <input type="checkbox" name="enabled" id="chooseUsEnabled" class="sr-only peer" value="on"
                           {{ ($settings['choose_us']['enabled'] ?? false) ? 'checked' : '' }}>
                    <span class="relative w-11 h-6 bg-gray-300 rounded-full
                                 after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                 after:bg-white after:border after:border-gray-300 after:rounded-full
                                 after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600
                                 peer-checked:after:translate-x-full"></span>
                </label>
                <label class="font-medium text-gray-700" for="chooseUsEnabled">Section Enabled</label>
            </div>

            <!-- Main Title -->
            <div class="md:col-span-2">
                <label for="chooseUsMainTitle" class="block text-gray-700 font-medium mb-1">Main Title</label>
                <input type="text" id="chooseUsMainTitle" name="main_title" placeholder="Enter main title"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ $settings['choose_us']['main_title'] ?? '' }}">
            </div>

            <!-- Items List -->
            <div class="md:col-span-2 space-y-4" id="chooseUsList">
                @if(isset($settings['choose_us']['items']))
                    @foreach($settings['choose_us']['items'] as $index => $item)
                        <div class="chooseUsItem grid grid-cols-1 md:grid-cols-12 gap-4 p-4 mt-4 bg-white shadow items-end border rounded">
                            <div class="md:col-span-4">
                                <label class="block text-gray-700 font-medium mb-1">Main Info</label>
                                <input type="text" name="items[{{ $index }}][info]"
                                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       value="{{ $item['info'] ?? '' }}">
                            </div>
                            <div class="md:col-span-4">
                                <label class="block text-gray-700 font-medium mb-1">Main Details</label>
                                <input type="text" name="items[{{ $index }}][details]"
                                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       value="{{ $item['details'] ?? '' }}">
                            </div>
                            <div class="md:col-span-3">
                                <label class="block text-gray-700 font-medium mb-1">Main Image</label>
                                <input type="file" name="items[{{ $index }}][image]" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                @if(isset($item['image']))
                                    <img src="{{ asset('storage/' . $item['image']) }}" alt="" class="mt-2 w-16 h-16 object-cover rounded">
                                @endif
                            </div>

                            <div class="md:col-span-1 flex justify-end">
                                <button type="button" class="text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded-md remove-chooseUsItem">
                                    <iconify-icon icon="ic:twotone-close"></iconify-icon>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Add Item Button -->
            <div class="md:col-span-2">
                <button type="button" class="bg-blue-100 text-blue-600 hover:bg-blue-200 px-4 py-2 rounded addChooseUsItem flex items-center gap-2">
                    <iconify-icon icon="simple-line-icons:plus"></iconify-icon> Add
                </button>
            </div>

            <!-- Banner Image -->
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-medium mb-1">Banner Image</label>
                <input type="file" name="banner_image"
                       class="w-full border border-gray-300 rounded px-3 py-1">
                @if(isset($settings['choose_us']['banner_image']))
                    <img src="{{ asset('storage/' . $settings['choose_us']['banner_image']) }}" alt=""
                         class="mt-2 w-16 h-16 object-cover rounded">
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
