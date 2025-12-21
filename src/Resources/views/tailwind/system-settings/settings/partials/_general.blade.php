<div id="General" role="tabpanel" class="space-y-6">
    <form id="general-settings-form" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <input type="hidden" name="_key" value="general_settings">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Application Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Application Name</label>
                <input type="text" name="application_name"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       placeholder="Enter application name"
                       value="{{ $settings['general_settings']['application_name'] ?? '' }}">
            </div>

            <!-- Copyright -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Copyright</label>
                <input type="text" name="copyright"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       placeholder="Enter copyright"
                       value="{{ $settings['general_settings']['copyright'] ?? '' }}">
            </div>

            <!-- Logo Upload Component -->
            @php
                $uploads = [
                    ['label'=>'Logo','input'=>'upload-file','name'=>'logo','preview'=>'uploaded-img__preview','key'=>'logo'],
                    ['label'=>'Favicon','input'=>'upload-file_fav','name'=>'favicon','preview'=>'uploaded-img_fav__preview','key'=>'favicon'],
                    ['label'=>'Light Logo','input'=>'upload-file_Light','name'=>'logo_light','preview'=>'uploaded-img_Light__preview','key'=>'logo_light'],
                    ['label'=>'Landing Page Logo','input'=>'upload-file_Page','name'=>'landing_page_logo','preview'=>'uploaded-img_Page__preview','key'=>'landing_page_logo'],
                ];
            @endphp

            @foreach($uploads as $upload)
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ $upload['label'] }}</label>
                <div class="flex items-center gap-4">

                    <!-- Preview -->
                    <div class="relative w-28 h-28 border border-dashed border-gray-300 rounded overflow-hidden">
                        <img id="{{ $upload['preview'] }}"
                             src="{{ isset($settings['general_settings'][$upload['key']]) ? asset('storage/'.$settings['general_settings'][$upload['key']]) : asset('assets/images/logo.png') }}"
                             class="w-full h-full object-cover">
                    </div>

                    <!-- Upload Button -->
                    <label class="w-28 h-28 flex flex-col items-center justify-center border border-gray-300 rounded cursor-pointer hover:bg-gray-50 transition text-sm text-gray-600">
                        <svg class="w-6 h-6 mb-1 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 16.5V18a2.25 2.25 0 002.25 2.25h13.5A2.25 2.25 0 0021 18v-1.5M12 3v12m0 0l-3.75-3.75M12 15l3.75-3.75"/>
                        </svg>
                        Upload
                        <input type="file" id="{{ $upload['input'] }}" name="{{ $upload['name'] }}" hidden>
                    </label>

                </div>
            </div>
            @endforeach

            <!-- Switches -->
            @php
                $switches = [
                    ['label'=>'Owner Email Verification','name'=>'owner_email_verification','id'=>'Owner_Email_Verification'],
                    ['label'=>'Registration Page','name'=>'registration_page','id'=>'Registration_Page'],
                    ['label'=>'Landing Page','name'=>'landing_page','id'=>'Landing_Page'],
                    ['label'=>'Pricing Feature','name'=>'pricing_feature','id'=>'pricingFeature'],
                ];
            @endphp

            @foreach($switches as $switch)
            <div class="flex items-center gap-4">
                <label for="{{ $switch['id'] }}" class="text-sm font-medium text-gray-700">{{ $switch['label'] }}</label>


                <label class="inline-flex items-center cursor-pointer">
                    <input type="hidden" name="{{ $switch['name'] }}" value="off">
                    <input type="checkbox" id="{{ $switch['id'] }}" name="{{ $switch['name'] }}" class="sr-only peer" value="on"  {{ ($settings['general_settings'][$switch['name']] ?? '') === 'on' ? 'checked' : '' }}>
                    <span class="relative w-11 h-6 bg-gray-300 rounded-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600 peer-checked:after:translate-x-full"></span>
                </label>
            </div>
            @endforeach

            <!-- Submit -->
            <div class="md:col-span-2 pt-4">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-medium transition">
                    Save
                </button>
            </div>

        </div>
    </form>
</div>
