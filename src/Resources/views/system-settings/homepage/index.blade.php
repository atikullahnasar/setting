@extends('setting::layouts.beft')

@push('styles')
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@section('title', 'System Settings')

@section('content')
    @php
        $tabs = [
            'headerMenu' => ['title'=>'Header Menu', 'subtitle'=>'Header Menu Section Settings'],
            'banner' => ['title'=>'Banner', 'subtitle'=>'Banner Section Settings'],
            'overView' => ['title'=>'OverView', 'subtitle'=>'OverView Section Settings'],
            'aboutUs' => ['title'=>'AboutUs', 'subtitle'=>'AboutUs Section Settings'],
            'offer' => ['title'=>'Offer', 'subtitle'=>'Offer Section Settings'],
            'blog' => ['title'=>'Blog', 'subtitle'=>'Blog Section Settings'],
            'coreFeatures' => ['title'=>'Core Features', 'subtitle'=>'Core Features Section Settings'],
            'testimonials' => ['title'=>'Testimonials', 'subtitle'=>'Testimonials Section Settings'],
            'chooseUS' => ['title'=>'Choose US', 'subtitle'=>'Choose US Section Settings'],
            'faqSection' => ['title'=>'FAQ', 'subtitle'=>'FAQ Section Settings'],
            'aboutFooter' => ['title'=>'AboutUS - Footer', 'subtitle'=>'AboutUS - Footer Section Settings'],
        ];
    @endphp

    <div class="container py-4">
        <nav>
            <div class="nav nav-tabs" id="settingsTab" role="tablist">
                @foreach($tabs as $id => $tab)
                    <button class="nav-link tab-btn {{ $loop->first ? 'active' : '' }}"
                                id="{{ $id }}-tab"
                                data-target="#{{ $id }}"
                                type="button">
                        <strong>{{ $tab['title'] }}</strong><br />
                        <small>{{ $tab['subtitle'] }}</small>
                    </button>
                @endforeach

            </div>
            <div class="card-header bg-success" id="showToast"></div>
        </nav>

        <div class="mt-3" id="tab-content" >
            @include('setting::system-settings.homepage.partials._header_menu')
            @include('setting::system-settings.homepage.partials._banner')
            @include('setting::system-settings.homepage.partials._overview')
            @include('setting::system-settings.homepage.partials._about_us')
            @include('setting::system-settings.homepage.partials._offer')
            @include('setting::system-settings.homepage.partials._blog')
            @include('setting::system-settings.homepage.partials._core_features')
            @include('setting::system-settings.homepage.partials._testimonials')
            @include('setting::system-settings.homepage.partials._choose_us')
            @include('setting::system-settings.homepage.partials._faq_section')
            @include('setting::system-settings.homepage.partials._about_footer')
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Tab switching
        $('.tab-btn').click(function() {
            const target = $(this).data('target');
            $('#tab-content > div').hide();
            $(target).show();
            $('.tab-btn').removeClass('active');
            $(this).addClass('active');
        });

        // Show first tab by default
        $('#tab-content > div').hide();
        $('#tab-content > div:first').show();

        // Toast helper
        function showToast(message, type = 'success') {
            const bgClass = type === 'success' ? 'bg-success' : 'bg-danger';
            $('#showToast').removeClass('bg-success bg-danger').addClass(bgClass).text(message).fadeIn();
            setTimeout(() => $('#showToast').fadeOut(), 2000);
        }

        // Initialize Quill editors for About Us
        const aboutUsQuill1 = new Quill('#aboutUsQuill1', {
            modules: { toolbar: '#toolbar-container-aboutUs1' },
            theme: 'snow',
            placeholder: 'Enter information for Box 1...'
        });
        const aboutUsQuill2 = new Quill('#aboutUsQuill2', {
            modules: { toolbar: '#toolbar-container-aboutUs2' },
            theme: 'snow',
            placeholder: 'Enter information for Box 2...'
        });

        // Set initial content
        @if(isset($settings['about_us']['box1_info']))
            aboutUsQuill1.root.innerHTML = `{!! $settings['about_us']['box1_info'] !!}`;
        @endif
        @if(isset($settings['about_us']['box2_info']))
            aboutUsQuill2.root.innerHTML = `{!! $settings['about_us']['box2_info'] !!}`;
        @endif

        // Form submission handling
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const key = this.querySelector('input[name="_key"]').value;

                // About Us Quill data
                if (key === 'about_us') {
                    formData.set('box1_info', aboutUsQuill1.root.innerHTML);
                    formData.set('box2_info', aboutUsQuill2.root.innerHTML);
                }

                // Handle header_menu pages[]
                if (key === 'header_menu') {
                    const checkedPages = Array.from(this.querySelectorAll('input[name="pages[]"]:checked')).map(cb => cb.value);
                    formData.delete('pages[]'); // remove old entries
                    checkedPages.forEach(v => formData.append('pages[]', v));
                }

                // Checkbox normalization
                this.querySelectorAll('input[type="checkbox"]').forEach(cb => {
                    if (cb.name && cb.name !== 'pages[]' && !cb.name.startsWith('items[')) {
                        formData.set(cb.name, cb.checked ? 1 : 0);
                    }
                });

                // Offer items
                if (key === 'offer') {
                    const offerItems = [];
                    this.querySelectorAll('.offerItem').forEach(div => {
                        const title = div.querySelector('input[name="items[][title]"]').value;
                        const info = div.querySelector('input[name="items[][info]"]').value;
                        const enabled = div.querySelector('input[name="items[][enabled]"]').checked ? 1 : 0;
                        const image = div.querySelector('input[name="items[][image]"]').files[0] || null;
                        offerItems.push({ title, info, enabled, image });
                    });

                    // Remove old FormData entries
                    Array.from(formData.keys())
                        .filter(k => k.startsWith('items['))
                        .forEach(k => formData.delete(k));

                    offerItems.forEach((item, i) => {
                        formData.append(`items[${i}][title]`, item.title);
                        formData.append(`items[${i}][info]`, item.info);
                        formData.append(`items[${i}][enabled]`, item.enabled);
                        if (item.image) formData.append(`items[${i}][image]`, item.image);
                    });
                }

                // Core Features items
                if (key === 'core_features') {
                    const coreItems = [];
                    this.querySelectorAll('.CoreFeatureItem').forEach(div => {
                        const title = div.querySelector('input[name="items[][title]"]').value;
                        const sub_title = div.querySelector('input[name="items[][sub_title]"]').value;
                        const image = div.querySelector('input[name="items[][image]"]').files[0] || null;
                        coreItems.push({ title, sub_title, image });
                    });

                    Array.from(formData.keys())
                        .filter(k => k.startsWith('items['))
                        .forEach(k => formData.delete(k));

                    coreItems.forEach((item, i) => {
                        formData.append(`items[${i}][title]`, item.title);
                        formData.append(`items[${i}][sub_title]`, item.sub_title);
                        if (item.image) formData.append(`items[${i}][image]`, item.image);
                    });
                }

                // Submit via fetch
                try {
                    const response = await fetch("{{ url('beft/allsettings') }}", {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });
                    const data = await response.json();
                    if (!response.ok) {
                        showToast(data.message || 'An error occurred', 'error');
                    } else {
                        showToast(data.message, 'success');
                    }
                } catch (err) {
                    console.error(err);
                    showToast('An error occurred while submitting the form', 'error');
                }
            });
        });

        // Add dynamic points
        document.querySelectorAll('.addNewPoint').forEach(btn => {
            btn.addEventListener('click', function() {
                const targetId = this.dataset.target;
                const inputName = this.dataset.name;
                const html = `
                    <div class="input-group mt-2 mb-2 pointItem">
                        <input type="text" name="${inputName}" class="form-control" placeholder="Enter point">
                        <button type="button" class="btn btn-outline-danger remove-button" data-target=".pointItem">
                            <iconify-icon icon="ic:twotone-close"></iconify-icon>
                        </button>
                    </div>`;
                document.getElementById(targetId).insertAdjacentHTML('beforeend', html);
            });
        });

        // Add CoreFeature dynamically
        document.querySelectorAll('.addCoreFeature').forEach(btn => {
            btn.addEventListener('click', function() {
                const html = `
                    <div class="CoreFeatureItem row g-3 align-items-end mt-2 mb-2">
                        <div class="col-md-4 col-12">
                            <label class="form-label">Title</label>
                            <input type="text" name="items[][title]" class="form-control">
                        </div>
                        <div class="col-md-4 col-12">
                            <label class="form-label">Sub Title</label>
                            <input type="text" name="items[][sub_title]" class="form-control">
                        </div>
                        <div class="col-md-3 col-10">
                            <label class="form-label">Image</label>
                            <input type="file" name="items[][image]" class="form-control">
                        </div>
                        <div class="col-md-1 col-2">
                            <button type="button" class="btn btn-danger remove-button" data-target=".CoreFeatureItem">
                                <iconify-icon icon="ic:twotone-close"></iconify-icon>
                            </button>
                        </div>
                    </div>`;
                document.getElementById('coreFeatureList').insertAdjacentHTML('beforeend', html);
            });
        });

        // Add Offer dynamically
        document.querySelectorAll('.addOfferItem').forEach(btn => {
            btn.addEventListener('click', function() {
                const html = `
                    <div class="offerItem border row g-3 p-3 mt-2 mb-2">
                        <div class="col-md-5 col-12">
                            <label class="form-label">Title</label>
                            <input type="text" name="items[][title]" class="form-control">
                        </div>
                        <div class="col-md-5 col-12">
                            <label class="form-label">Image</label>
                            <input type="file" name="items[][image]" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Info</label>
                            <input type="text" name="items[][info]" class="form-control">
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="form-check form-switch mt-3">
                                <input type="checkbox" name="items[][enabled]" class="form-check-input" checked>
                                <label class="form-check-label">Enabled</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-danger remove-button" data-target=".offerItem">
                                <iconify-icon icon="ic:twotone-close"></iconify-icon>
                            </button>
                        </div>
                    </div>`;
                document.getElementById('offerList').insertAdjacentHTML('beforeend', html);
            });
        });

        // Choose Us dynamic rows
        const chooseUsList = document.getElementById('chooseUsList');
        document.querySelector('.addChooseUsItem').addEventListener('click', function () {
            const index = chooseUsList.querySelectorAll('.chooseUsItem').length;
            const html = `
                <div class="chooseUsItem row g-3 align-items-end mb-2 border p-3">
                    <div class="col-md-4 col-12">
                        <label class="form-label">Main Info</label>
                        <input type="text" name="items[${index}][info]" class="form-control">
                    </div>
                    <div class="col-md-4 col-12">
                        <label class="form-label">Main Details</label>
                        <input type="text" name="items[${index}][details]" class="form-control">
                    </div>
                    <div class="col-md-3 col-10">
                        <label class="form-label">Main Image</label>
                        <input type="file" name="items[${index}][image]" class="form-control">
                    </div>
                    <div class="col-md-1 col-2">
                        <button type="button" class="btn btn-danger remove-chooseUsItem">
                            <iconify-icon icon="ic:twotone-close"></iconify-icon>
                        </button>
                    </div>
                </div>`;
            chooseUsList.insertAdjacentHTML('beforeend', html);
        });

        // Remove Choose Us row
        chooseUsList.addEventListener('click', function(e) {
            if (e.target.closest('.remove-chooseUsItem')) {
                e.target.closest('.chooseUsItem').remove();
            }
        });

        // Generic remove button handler
        // document.addEventListener('click', function(e) {
        //     if (e.target.closest('.remove-button')) {
        //         const btn = e.target.closest('.remove-button');
        //         const targetSelector = btn.dataset.target;
        //         const item = btn.closest(targetSelector);
        //         if (item) item.remove();
        //     }
        // });
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-button')) {
                const button = e.target.closest('.remove-button');
                const targetSelector = button.dataset.target;
                const itemToRemove = button.closest(targetSelector);
                if (itemToRemove) {
                    itemToRemove.remove();
                } else {
                    console.log('Could not find item to remove with selector:', targetSelector); // Added for debugging
                }
            }
        });

    });
</script>
@endpush
