<div id="social" role="tabpanel" aria-labelledby="social-tab" class="hidden">
    <form id="socialForm" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="_key" value="footer_social">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
            <!-- Name -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Name</label>
                <input type="text" name="name" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter name" value="{{ $settings['footer_social']['name'] ?? 'Help' }}">
            </div>

            <!-- Footer Social Enabled -->
            <div class="flex items-center md:justify-start">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="hidden" name="enabled" value="off">
                    <input type="checkbox" name="enabled" id="footer_social_enabled" class="sr-only peer" {{ isset($settings['footer_social']['enabled']) && $settings['footer_social']['enabled'] == 'on' ? 'checked' : '' }}>
                    <span class="relative w-9 h-5 bg-gray-400 peer-focus:outline-none rounded-full peer dark:bg-gray-500 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-primary-600"></span>
                </label>
                <label for="footer_social_enabled" class="relative inline-flex items-center cursor-pointer">
                    <span class="ml-3 text-gray-700 font-medium">Enabled</span>
                </label>
            </div>
        </div>

        @php
            $socials = [
                ['name' => 'Facebook', 'key' => 'facebook'],
                ['name' => 'Instagram', 'key' => 'instagram'],
                ['name' => 'Twitter', 'key' => 'twitter'],
                ['name' => 'LinkedIn', 'key' => 'linkedIn'],
                ['name' => 'Threads', 'key' => 'threads'],
            ];
        @endphp

        @foreach ($socials as $social)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
                <!-- URL Input -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">{{ $social['name'] }}</label>
                    <input type="url" name="{{ $social['key'] }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter {{ $social['name'] }} URL" value="{{ $settings['footer_social'][$social['key']] ?? '' }}">
                </div>

                <!-- Enabled Switch -->
                <div class="flex items-center md:justify-start">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="hidden" name="{{ $social['key'] }}_enabled" value="off">
                        <input type="checkbox" name="{{$social['key'] }}_enabled" id="{{ $social['key'] }}_enabled" class="sr-only peer" {{ isset($settings['footer_social'][$social['key'].'_enabled']) && $settings['footer_social'][$social['key'].'_enabled'] == 'on' ? 'checked' : '' }}>
                        <span class="relative w-9 h-5 bg-gray-400 peer-focus:outline-none rounded-full peer dark:bg-gray-500 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-primary-600"></span>
                    </label>
                    <label for="{{ $social['key'] }}_enabled" class="relative inline-flex items-center cursor-pointer">
                        <span class="ml-3 text-gray-700 font-medium">Enabled</span>
                    </label>
                </div>
            </div>
        @endforeach

        <!-- Submit Button -->
        <div>
            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded font-medium transition-colors">
                Save
            </button>
        </div>
    </form>
</div>
