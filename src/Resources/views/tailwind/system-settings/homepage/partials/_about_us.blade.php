<div id="aboutUs" role="tabpanel" aria-labelledby="aboutUs-tab" class="space-y-6">
    <h5 class="text-center text-xl font-semibold mb-4">AboutUs</h5>

    <form id="aboutUsForm" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <input type="hidden" name="_key" value="about_us">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Name -->
            <div>
                <label for="aboutUsName" class="block text-gray-700 font-medium mb-1">Name</label>
                <input type="text" id="aboutUsName" name="name" placeholder="Enter name" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $settings['about_us']['name'] ?? '' }}">
            </div>

            <!-- Section Enabled Switch -->
            <div class="flex items-center md:justify-end gap-4">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="hidden" name="enabled" value="off">
                    <input type="checkbox" name="enabled" id="aboutUsEnabled" class="sr-only peer" value="on" {{ ($settings['about_us']['enabled'] ?? false) ? 'checked' : '' }}>
                    <span class="relative w-11 h-6 bg-gray-300 rounded-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600 peer-checked:after:translate-x-full"></span>
                </label>
                <label class="font-medium text-gray-700" for="aboutUsEnabled">Section Enabled</label>
            </div>

            <!-- Box 1 Title -->
            <div>
                <label for="box1Title" class="block text-gray-700 font-medium mb-1">1 Box Title</label>
                <input type="text" id="box1Title" name="box1_title" placeholder="Enter box-1 title" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $settings['about_us']['box1_title'] ?? '' }}">
            </div>

            <!-- Box 1 Image -->
            <div>
                <label for="box1Image" class="block text-gray-700 font-medium mb-1">Box Image</label>
                <input type="file" id="box1Image" name="box1_image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                @if(isset($settings['about_us']['box1_image']))
                    <img src="{{ asset('storage/' . $settings['about_us']['box1_image']) }}" alt=""
                         class="mt-2 rounded-md w-16 h-16 object-cover">
                @endif
            </div>

            <!-- Box 1 Learn More -->
            <div class="md:col-span-2">
                <label for="box1LearnMore" class="block text-gray-700 font-medium mb-1">1 Box Learn More</label>
                <input type="url" id="box1LearnMore" name="box1_learn_more" placeholder="Write the URL for learn more"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ $settings['about_us']['box1_learn_more'] ?? '' }}">
            </div>

            <!-- Box 1 Info (Quill Editor) -->
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-medium mb-1">1 Box Info</label>
                <div id="toolbar-container-aboutUs1 ">
                    <span class="ql-formats">
                        <select class="ql-font"></select>
                        <select class="ql-size"></select>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-bold"></button>
                        <button class="ql-italic"></button>
                        <button class="ql-underline"></button>
                        <button class="ql-strike"></button>
                    </span>
                    <span class="ql-formats">
                        <select class="ql-color"></select>
                        <select class="ql-background"></select>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-script" value="sub"></button>
                        <button class="ql-script" value="super"></button>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-header" value="1"></button>
                        <button class="ql-header" value="2"></button>
                        <button class="ql-blockquote"></button>
                        <button class="ql-code-block"></button>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-list" value="ordered"></button>
                        <button class="ql-list" value="bullet"></button>
                        <button class="ql-indent" value="-1"></button>
                        <button class="ql-indent" value="+1"></button>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-direction" value="rtl"></button>
                        <select class="ql-align"></select>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-link"></button>
                        <button class="ql-image"></button>
                        <button class="ql-video"></button>
                        <button class="ql-formula"></button>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-clean"></button>
                    </span>
                </div>
                <div id="aboutUsQuill1" class="border border-gray-300 rounded" style="height: 200px;"></div>
            </div>

            <!-- Box 1 Points -->
            <div class="md:col-span-2" id="pointList1">
                @if(isset($settings['about_us']['box1_points']))
                    @foreach($settings['about_us']['box1_points'] as $point)
                        <div class="flex gap-2 mt-2 pointItem">
                            <input type="text" name="box1_points[]" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Enter point" value="{{ $point }}">
                            <button type="button" class="text-red-600 hover:text-red-800 remove-button" data-target=".pointItem">
                                <iconify-icon icon="ic:twotone-close"></iconify-icon>
                            </button>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="md:col-span-2">
                <button type="button" class="text-blue-600 hover:text-blue-800 text-sm font-medium addNewPoint" data-target="pointList1" data-name="box1_points[]">
                    <iconify-icon icon="simple-line-icons:plus" class="inline-block mr-1"></iconify-icon> Add Point
                </button>
            </div>

            <!-- Box 2 Title -->
            <div>
                <label for="box2Title" class="block text-gray-700 font-medium mb-1">2 Box Title</label>
                <input type="text" id="box2Title" name="box2_title" placeholder="Enter box-2 title"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ $settings['about_us']['box2_title'] ?? '' }}">
            </div>

            <!-- Box 2 Image -->
            <div>
                <label for="box2Image" class="block text-gray-700 font-medium mb-1">Box Image</label>
                <input type="file" id="box2Image" name="box2_image" class="w-full border border-gray-300 rounded px-3 py-2">
                @if(isset($settings['about_us']['box2_image']))
                    <img src="{{ asset('storage/' . $settings['about_us']['box2_image']) }}" alt=""
                         class="mt-2 rounded-md w-16 h-16 object-cover">
                @endif
            </div>

            <!-- Box 2 Learn More -->
            <div class="md:col-span-2">
                <label for="box2LearnMore" class="block text-gray-700 font-medium mb-1">2 Box Learn More</label>
                <input type="url" id="box2LearnMore" name="box2_learn_more" placeholder="Write the URL for learn more"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ $settings['about_us']['box2_learn_more'] ?? '' }}">
            </div>

            <!-- Box 2 Info (Quill Editor) -->
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-medium mb-1">2 Box Info</label>
                <div id="toolbar-container-aboutUs2">
                    <span class="ql-formats">
                        <select class="ql-font"></select>
                        <select class="ql-size"></select>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-bold"></button>
                        <button class="ql-italic"></button>
                        <button class="ql-underline"></button>
                        <button class="ql-strike"></button>
                    </span>
                    <span class="ql-formats">
                        <select class="ql-color"></select>
                        <select class="ql-background"></select>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-script" value="sub"></button>
                        <button class="ql-script" value="super"></button>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-header" value="1"></button>
                        <button class="ql-header" value="2"></button>
                        <button class="ql-blockquote"></button>
                        <button class="ql-code-block"></button>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-list" value="ordered"></button>
                        <button class="ql-list" value="bullet"></button>
                        <button class="ql-indent" value="-1"></button>
                        <button class="ql-indent" value="+1"></button>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-direction" value="rtl"></button>
                        <select class="ql-align"></select>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-link"></button>
                        <button class="ql-image"></button>
                        <button class="ql-video"></button>
                        <button class="ql-formula"></button>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-clean"></button>
                    </span>
                </div>
                <div id="aboutUsQuill2" class="border border-gray-300 rounded" style="height: 200px;"></div>
            </div>

            <!-- Box 2 Points -->
            <div class="md:col-span-2" id="pointList2">
                @if(isset($settings['about_us']['box2_points']))
                    @foreach($settings['about_us']['box2_points'] as $point)
                        <div class="flex gap-2 mt-2 pointItem">
                            <input type="text" name="box2_points[]" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Enter point" value="{{ $point }}">
                            <button type="button" class="text-red-600 hover:text-red-800 remove-button" data-target=".pointItem">
                                <iconify-icon icon="ic:twotone-close"></iconify-icon>
                            </button>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="md:col-span-2">
                <button type="button" class="text-blue-600 hover:text-blue-800 text-sm font-medium addNewPoint" data-target="pointList2" data-name="box2_points[]">
                    <iconify-icon icon="simple-line-icons:plus" class="inline-block mr-1"></iconify-icon> Add Point
                </button>
            </div>

            <!-- Submit Button -->
            <div class="md:col-span-2 mt-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-medium transition-colors">
                    Save
                </button>
            </div>

        </div>
    </form>
</div>
