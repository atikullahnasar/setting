@extends('setting::layouts.beft')

@push('styles')
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('title', 'Site Settings')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">

    <!-- Tabs -->
    <div class="border-b border-gray-200 mb-4">
        <nav class="flex flex-wrap gap-2" role="tablist">
            <button class="tab-btn px-4 py-2 text-sm font-medium rounded-t bg-blue-600 text-white"
                    data-target="#General" type="button">
                General
            </button>
            <button class="tab-btn px-4 py-2 text-sm font-medium rounded-t bg-gray-100 hover:bg-gray-200"
                    data-target="#Company" type="button">
                Company
            </button>
            <button class="tab-btn px-4 py-2 text-sm font-medium rounded-t bg-gray-100 hover:bg-gray-200"
                    data-target="#Email" type="button">
                Email
            </button>
            <button class="tab-btn px-4 py-2 text-sm font-medium rounded-t bg-gray-100 hover:bg-gray-200"
                    data-target="#Payment" type="button">
                Payment
            </button>
            <button class="tab-btn px-4 py-2 text-sm font-medium rounded-t bg-gray-100 hover:bg-gray-200"
                    data-target="#SiteSEO" type="button">
                Site SEO
            </button>
            <button class="tab-btn px-4 py-2 text-sm font-medium rounded-t bg-gray-100 hover:bg-gray-200"
                    data-target="#GoogleRecaptcha" type="button">
                Google Recaptcha
            </button>
        </nav>
    </div>

    <!-- Toast -->
    <div id="showToast" class="hidden mb-4 px-4 py-2 rounded text-white text-sm font-medium"> </div>

    <!-- Tab Contents -->
    <div id="tab-content" class="space-y-6">
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {

        $('#company_timezone').select2({
            placeholder: "Select timezone",
            allowClear: true,
            width: '100%'
        });

        // Tabs
        $('.tab-btn').on('click', function () {
            let target = $(this).data('target');

            $('#tab-content > div').hide();
            $(target).show();

            $('.tab-btn')
                .removeClass('bg-blue-600 text-white')
                .addClass('bg-gray-100 text-gray-700');

            $(this)
                .removeClass('bg-gray-100 text-gray-700')
                .addClass('bg-blue-600 text-white');
        });

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
            let toast = $('#showToast');

            toast
                .removeClass('hidden bg-green-600 bg-red-600')
                .addClass(type === 'success' ? 'bg-green-600' : 'bg-red-600')
                .text(message)
                .fadeIn();

            setTimeout(() => toast.fadeOut(), 2000);
        }

        forms.forEach(function (formId) {
            $(document).on('submit', formId, function (e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ url('beft/allsettings') }}",
                    type: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: res => showToast(res.message),
                    error: xhr => {
                        showToast('Something went wrong', 'error');
                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function (key, value) {
                                $("#error-" + key).text(value[0]);
                            });
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

        imageFields.forEach(field => {
            $(field.input).on('change', function () {
                if (this.files?.[0]) {
                    const reader = new FileReader();
                    reader.onload = e => $(field.preview).attr('src', e.target.result);
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });

    });
</script>
@endpush
