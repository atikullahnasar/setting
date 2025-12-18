@php
    $settings = $settings ?? [];
    $auth_page_enabled = $settings['auth_page_enabled'] ?? 'yes';
    $auth_page_image = $settings['auth_page_image'] ?? '';

    $auth_page_points = [];
    if (!empty($settings['auth_page_points'])) {
        $auth_page_points = is_array($settings['auth_page_points'])
            ? $settings['auth_page_points']
            : json_decode($settings['auth_page_points']);
    }
@endphp
@extends('setting::layouts.beft')

@section('title', 'Auth Page Settings')
@section('content')
    <h3 class="mb-4">Auth Page Settings</h3>

    <div class="card">
        <div class="card-header bg-success" id="showToast"></div>
        <div class="card-body">
            <form id="authSettingsForm" class="grid grid-cols-12 gap-5" enctype="multipart/form-data">
                <!-- Section Enabled -->
                <div class="mb-3 form-check form-switch">
                    <input type="checkbox" class="form-check-input" id="auth_page_enabled" name="auth_page_enabled" value="yes" {{$auth_page_enabled == 'yes'? 'checked' : ''}} >
                    <label class="form-check-label" for="auth_page_enabled">Section Enabled</label>
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" class="form-control" name="auth_page_image" id="auth_page_image">
                    <div class="mt-2">
                        <img id="preview_image" src="{{asset('storage/'. $auth_page_image)}}" alt="Auth Image" style="width:80px;height:80px;">
                    </div>
                </div>

                <!-- Points -->
                <div id="pointList">
                    @if (!empty($settings['auth_page_points']))
                    @foreach ($auth_page_points as $point)
                    <div class="pointItem row g-2 align-items-end mb-2">
                        <div class="col-md-5">
                            <label class="form-label">Title</label>
                            <input type="text" name="CoreFeatureTitle[]" class="form-control CoreFeatureTitle" value="{{$point->title ?? ''}}">
                            <small class="error-title"></small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Sub Title</label>
                            <input type="text" name="CoreFeatureSubTitle[]" class="form-control CoreFeatureSubTitle" value="{{$point->subtitle ?? ''}}">
                            <small class="error-subtitle"></small>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger remove-pointItem">
                                <iconify-icon icon="ic:twotone-close"></iconify-icon>
                            </button>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="pointItem row g-2 align-items-end mb-2">
                        <div class="col-md-5">
                            <label class="form-label">Title</label>
                            <input type="text" name="CoreFeatureTitle[]" class="form-control CoreFeatureTitle" value="Secure Access, Seamless Experience.">
                            <small class="error-title"></small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Sub Title</label>
                            <input type="text" name="CoreFeatureSubTitle[]" class="form-control CoreFeatureSubTitle" value="Securely access your account with ease.">
                            <small class="error-subtitle"></small>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger remove-pointItem">
                                <iconify-icon icon="ic:twotone-close"></iconify-icon>
                            </button>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Add Point -->
                <div class="mb-3">
                    <button type="button" class="btn btn-outline-primary addNewPoint">
                        <iconify-icon icon="simple-line-icons:plus"></iconify-icon> Add Point
                    </button>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Preview image
        $('#auth_page_image').on('change', function(e){
            const [file] = e.target.files;
            if(file){
                $('#preview_image').attr('src', URL.createObjectURL(file)).show();
            }
        });

        // Add new point
        $('.addNewPoint').click(function(){
            const pointItem = `
            <div class="pointItem row g-2 align-items-end mb-2">
                <div class="col-md-5">
                    <label class="form-label">Title</label>
                    <input type="text" name="CoreFeatureTitle[]" class="form-control" placeholder="Enter title">
                    <small class="text-red-500 error-title"></small>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Sub Title</label>
                    <input type="text" name="CoreFeatureSubTitle[]" class="form-control" placeholder="Enter sub-title">
                    <small class="text-red-500 error-subtitle"></small>
                </div>
                <div class="col-md-1">
                    <button type="button" class="remove-pointItem mb-2">
                        <iconify-icon icon="ic:twotone-close" class="text-danger-main text-xl"></iconify-icon>
                    </button>
                </div>
            </div>`;


            $('#pointList').append(pointItem);
        });

        // Remove point
        $(document).on('click', '.remove-pointItem', function(){
            $(this).closest('.pointItem').remove();
        });

        // Handle form submission
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
                        $('#showToast').text(response.message).fadeIn();
                        // Hide after 2 seconds
                        setTimeout(function(){
                            $('#showToast').fadeOut();
                        }, 2000);
                    } else {
                        window.showToast('error', response.message || 'An error occurred.');
                    }
                },
                error: function(xhr){
                    $(".error-title").text("");
                    $(".error-subtitle").text("");
                    if(xhr.responseJSON && xhr.responseJSON.errors){
                        $.each(xhr.responseJSON.errors, function(field, messages){
                            if(field.startsWith("CoreFeatureTitle")){
                                let index = field.split(".")[1];
                                $("#pointList .pointItem").eq(index).find(".error-title").text(messages[0]);
                            }
                            if(field.startsWith("CoreFeatureSubTitle")){
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

