<div id="overView" role="tabpanel" aria-labelledby="overView-tab" class="space-y-6">
    <h5 class="text-center text-xl font-semibold">OverView</h5>

    <form id="overviewForm" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <input type="hidden" name="_key" value="overview">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Name -->
            <div>
                <label for="overviewName" class="block text-gray-700 font-medium mb-1">Name</label>
                <input type="text" id="overviewName" name="name" placeholder="Enter name" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $settings['overview']['name'] ?? '' }}">
            </div>

            <!-- Section Enabled Switch -->
            <div class="flex items-center md:justify-center gap-4">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="hidden" name="enabled" value="off">
                    <input type="checkbox" id="overviewEnabled" name="enabled"
                           class="sr-only peer" value="on"
                           {{ ($settings['overview']['enabled'] ?? false) ? 'checked' : '' }}>
                    <span class="relative w-11 h-6 bg-gray-300 rounded-full
                                 after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                 after:bg-white after:border after:border-gray-300 after:rounded-full
                                 after:h-5 after:w-5 after:transition-all
                                 peer-checked:bg-green-600
                                 peer-checked:after:translate-x-full"></span>
                </label>
                <label for="overviewEnabled" class="font-medium text-gray-700">
                    Section Enabled
                </label>
            </div>

        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Boxes (1 to 4) -->
            @for ($i = 1; $i <= 4; $i++)
                <!-- Box Title -->
                <div>
                    <label for="box{{ $i }}Title" class="block text-gray-700 font-medium mb-1">
                        {{ $i }} Box Title
                    </label>
                    <input type="text" id="box{{ $i }}Title"
                           name="box{{ $i }}_title"
                           placeholder="Enter box title"
                           class="w-full border border-gray-300 rounded px-3 py-2
                                  focus:outline-none focus:ring-2 focus:ring-blue-500"
                           value="{{ $settings['overview']['box' . $i . '_title'] ?? '' }}">
                </div>

                <!-- Box Number -->
                <div>
                    <label for="box{{ $i }}Number" class="block text-gray-700 font-medium mb-1">
                        {{ $i }} Box Number
                    </label>
                    <input type="number" min="1" id="box{{ $i }}Number"
                           name="box{{ $i }}_number"
                           placeholder="Enter number"
                           class="w-full border border-gray-300 rounded px-3 py-2
                                  focus:outline-none focus:ring-2 focus:ring-blue-500"
                           value="{{ $settings['overview']['box' . $i . '_number'] ?? '' }}">
                </div>

                <!-- Box Image -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">
                        {{ $i }} Box Image
                    </label>
                    <input type="file"
                           name="box{{ $i }}_image"
                           class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">

                    @if(isset($settings['overview']['box' . $i . '_image']))
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $settings['overview']['box' . $i . '_image']) }}"
                                 alt=""
                                 class="w-10 h-10 rounded-full object-cover">
                        </div>
                    @endif
                </div>
            @endfor

            <!-- Submit Button -->
            <div class="md:col-span-2">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white
                               px-6 py-2 rounded font-medium transition-colors">
                    Save
                </button>
            </div>

        </div>
    </form>
</div>
