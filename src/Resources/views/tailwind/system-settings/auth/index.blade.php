@php
    $settings = $settings ?? [];
    $auth_page_enabled = $settings['auth_page_enabled'] ?? 'yes';
    $auth_page_image = $settings['auth_page_image'] ?? '';
    $auth_page_points = !empty($settings['auth_page_points'])
        ? (is_array($settings['auth_page_points']) ? $settings['auth_page_points'] : json_decode($settings['auth_page_points']))
        : [];
@endphp

@extends('setting::layouts.beft')

@section('title', 'Auth Page Settings')

@push('styles')
<style>
    :root {
        --primary-600: #16a34a;
    }

    .peer:checked ~ .peer-checked\:bg-primary-600 {
        background-color: var(--primary-600);
    }
</style>
@endpush

@section('content')
<div class="p-6 space-y-6 bg-white shadow rounded">
    <h2 class="text-2xl font-semibold text-gray-800">Auth Page Settings</h2>

    <!-- Toast -->
    <div id="showToast" class="hidden px-4 py-2 rounded text-white"></div>

    <form id="authSettingsForm" class="space-y-6 grid grid-cols-1 md:grid-cols-12 gap-4" enctype="multipart/form-data">

        <!-- Section Enabled -->
        <div class="col-span-12 flex items-center gap-4">
            <label class="inline-flex items-center cursor-pointer">
                <input type="hidden" name="auth_page_enabled" value="no">
                <input type="checkbox" name="auth_page_enabled" id="auth_page_enabled" class="sr-only peer" value="yes" {{ $auth_page_enabled == 'yes' ? 'checked' : '' }}>
                <span class="relative w-11 h-6 bg-gray-300 rounded-full peer-checked:bg-primary-600 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full"></span>
            </label>
            <label class="font-medium text-gray-700" for="auth_page_enabled">Section Enabled</label>
        </div>

        <!-- Image Upload -->
        <div class="col-span-12 md:col-span-6 space-y-2">
            <label class="block font-medium text-gray-700">Auth Page Image</label>
            <input type="file" name="auth_page_image" id="auth_page_image" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <div>
                <img id="preview_image" src="{{ $auth_page_image ? asset('storage/'.$auth_page_image) : '' }}" alt="Auth Image" class="w-32 h-32 object-cover rounded shadow mt-2">
            </div>
        </div>

        <!-- Points -->
        <div class="col-span-12 space-y-4">
            <h3 class="text-lg font-semibold text-gray-700">Points</h3>
            <div id="pointList" class="space-y-3">
                @forelse ($auth_page_points as $point)
                <div class="pointItem grid grid-cols-12 gap-3 items-end">
                    <div class="col-span-5">
                        <label class="block font-medium text-gray-600">Title</label>
                        <input type="text" name="CoreFeatureTitle[]" class="w-full border border-gray-300 rounded p-2 focus:ring-2 focus:ring-blue-500" value="{{$point->title ?? ''}}">
                        <small class="text-red-500 error-title"></small>
                    </div>
                    <div class="col-span-6">
                        <label class="block font-medium text-gray-600">Sub Title</label>
                        <input type="text" name="CoreFeatureSubTitle[]" class="w-full border border-gray-300 rounded p-2 focus:ring-2 focus:ring-blue-500" value="{{$point->subtitle ?? ''}}">
                        <small class="text-red-500 error-subtitle"></small>
                    </div>
                    <div class="col-span-1 flex justify-center">
                        <button type="button" class="remove-pointItem text-red-500 hover:text-red-700">
                            <iconify-icon icon="ic:twotone-close" width="24" height="24"></iconify-icon>
                        </button>
                    </div>
                </div>
                @empty
                <div class="pointItem grid grid-cols-12 gap-3 items-end">
                    <div class="col-span-5">
                        <label class="block font-medium text-gray-600">Title</label>
                        <input type="text" name="CoreFeatureTitle[]" class="w-full border border-gray-300 rounded p-2 focus:ring-2 focus:ring-blue-500" value="Secure Access, Seamless Experience.">
                        <small class="text-red-500 error-title"></small>
                    </div>
                    <div class="col-span-6">
                        <label class="block font-medium text-gray-600">Sub Title</label>
                        <input type="text" name="CoreFeatureSubTitle[]" class="w-full border border-gray-300 rounded p-2 focus:ring-2 focus:ring-blue-500" value="Securely access your account with ease.">
                        <small class="text-red-500 error-subtitle"></small>
                    </div>
                    <div class="col-span-1 flex justify-center">
                        <button type="button" class="remove-pointItem text-red-500 hover:text-red-700">
                            <iconify-icon icon="ic:twotone-close" width="24" height="24"></iconify-icon>
                        </button>
                    </div>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Add Point Button -->
        <div class="col-span-12">
            <button type="button" class="addNewPoint inline-flex items-center gap-2 px-3 py-2 border border-blue-500 text-blue-500 rounded hover:bg-blue-50">
                <iconify-icon icon="simple-line-icons:plus"></iconify-icon> Add Point
            </button>
        </div>

        <!-- Submit -->
        <div class="col-span-12">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-medium transition-colors">Save</button>
        </div>

    </form>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Preview image
    $('#auth_page_image').on('change', function(e){
        const [file] = e.target.files;
        if(file) $('#preview_image').attr('src', URL.createObjectURL(file)).show();
    });

    // Add new point
    $('.addNewPoint').click(function(){
        const pointItem = `
        <div class="pointItem grid grid-cols-12 gap-3 items-end">
            <div class="col-span-5">
                <label class="block font-medium text-gray-600">Title</label>
                <input type="text" name="CoreFeatureTitle[]" class="w-full border border-gray-300 rounded p-2 focus:ring-2 focus:ring-blue-500" placeholder="Enter title">
                <small class="text-red-500 error-title"></small>
            </div>
            <div class="col-span-6">
                <label class="block font-medium text-gray-600">Sub Title</label>
                <input type="text" name="CoreFeatureSubTitle[]" class="w-full border border-gray-300 rounded p-2 focus:ring-2 focus:ring-blue-500" placeholder="Enter sub-title">
                <small class="text-red-500 error-subtitle"></small>
            </div>
            <div class="col-span-1 flex justify-center">
                <button type="button" class="remove-pointItem text-red-500 hover:text-red-700">
                    <iconify-icon icon="ic:twotone-close" width="24" height="24"></iconify-icon>
                </button>
            </div>
        </div>`;
        $('#pointList').append(pointItem);
    });

    // Remove point
    $(document).on('click', '.remove-pointItem', function(){ $(this).closest('.pointItem').remove(); });

    // Submit form
    $('#authSettingsForm').submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "{{url('beft/settings/login')}}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            success: function(response){
                if(response.success){
                    $('#showToast').removeClass('hidden bg-red-500').addClass('bg-green-500').text(response.message).fadeIn();
                    setTimeout(()=> $('#showToast').fadeOut(), 2000);
                } else {
                    $('#showToast').removeClass('hidden bg-green-500').addClass('bg-red-500').text(response.message || 'Error').fadeIn();
                    setTimeout(()=> $('#showToast').fadeOut(), 2000);
                }
            },
            error: function(xhr){
                $(".error-title, .error-subtitle").text("");
                if(xhr.responseJSON && xhr.responseJSON.errors){
                    $.each(xhr.responseJSON.errors, function(field, messages){
                        if(field.includes("CoreFeatureTitle")){
                            let index = field.split(".")[1];
                            $("#pointList .pointItem").eq(index).find(".error-title").text(messages[0]);
                        }
                        if(field.includes("CoreFeatureSubTitle")){
                            let index = field.split(".")[1];
                            $("#pointList .pointItem").eq(index).find(".error-subtitle").text(messages[0]);
                        }
                    });
                }
            }
        });
    });
});
</script>
@endpush
