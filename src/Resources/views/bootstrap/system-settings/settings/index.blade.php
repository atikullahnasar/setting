
@extends('setting::layouts.beft')
@push('styles')
    <!-- External CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('title', 'Site Settings')


@section('content')

<div class="container py-4">
    <!-- Tabs nav -->
    <nav>
        <div class="nav nav-tabs" id="settingsTab" role="tablist">
            <button class="nav-link active tab-btn" data-target="#General" type="button">General</button>
            <button class="nav-link tab-btn" data-target="#Company" type="button">Company</button>
            <button class="nav-link tab-btn" data-target="#Email" type="button">Email</button>
            <button class="nav-link tab-btn" data-target="#Payment" type="button">Payment</button>
            <button class="nav-link tab-btn" data-target="#SiteSEO" type="button">Site SEO</button>
            <button class="nav-link tab-btn" data-target="#GoogleRecaptcha" type="button">Google Recaptcha</button>
        </div>
        <div class="card-header bg-success" id="showToast"></div>
    </nav>

    <!-- Tabs content -->
    <div id="tab-content" class="mt-3">
            @include('setting::system-settings.settings.partials._general')
            @include('setting::system-settings.settings.partials._company')
            @include('setting::system-settings.settings.partials._email')
            @include('setting::system-settings.settings.partials._payment')
            @include('setting::system-settings.settings.partials._site-seo')
            @include('setting::system-settings.settings.partials._google-recaptcha')
    </div>
</div>

@endsection

@push('scripts')
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('#company_timezone').select2({
            placeholder: "Select timezone",
            allowClear: true,
            width: '100%'
        });

        // Tab switching
        $('.tab-btn').click(function() {
            let target = $(this).data('target');
            $('#tab-content > div').hide();
            $(target).show();
            $('.tab-btn').removeClass('active');
            $(this).addClass('active');
        });

        // Show default tab
        $('#tab-content > div').hide();
        $('#General').show();

        const forms = [
            '#general-settings-form',
            '#email-settings-form',
            '#company-settings-form',
            '#payment-settings-form',
            '#site-seo-settings-form',
            '#google-recaptcha-settings-form'
        ];

        function showToast(message, type = 'success') {
            const bgColor = type === 'success' ? 'bg-success' : 'bg-danger';
            $('#showToast').removeClass('bg-success bg-danger').addClass(bgColor).text(message).fadeIn();
            setTimeout(() => $('#showToast').fadeOut(), 2000);
        }

        forms.forEach(function(formId) {
            $(document).on('submit', formId, function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var form = this;
                $.ajax({
                    url: "{{url('beft/allsettings')}}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        showToast(response.message, 'success');
                    },
                    error: function(xhr) {
                        showToast('Something went wrong', 'error');
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $("#error-" + key).text(value[0]);
                            });
                        }else {
                            alert('error', 'An error occurred: ' + (xhr.responseJSON.message || xhr.statusText));
                        }
                    }
                });
            });
        });

        const imageFields = [
            { input: "#upload-file", preview: "#uploaded-img__preview" },
            { input: "#upload-file_fav", preview: "#uploaded-img_fav__preview" },
            { input: "#upload-file_Light", preview: "#uploaded-img_Light__preview" },
            { input: "#upload-file_Page", preview: "#uploaded-img_Page__preview" },
            { input: "#upload-meta-image", preview: "#uploaded-meta-image-preview" }
        ];

        imageFields.forEach(function(field) {
            $(field.input).on('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $(field.preview).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });

    });
</script>
@endpush
