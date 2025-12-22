@extends('setting::layouts.beft')

@push('styles')
<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<style>
    /* Custom toggle colors */
    .peer:checked ~ .peer-checked\:bg-green-600 {
        background-color: #16a34a; /* Tailwind green-600 */
    }
</style>
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

<div class="container mx-auto py-6">

    <!-- Tabs -->
    <div class="flex flex-wrap border-b mb-4">
        @foreach($tabs as $id => $tab)
            <button class="tab-btn px-4 py-2 text-left focus:outline-none {{ $loop->first ? 'border-b-2 border-blue-600 font-semibold' : 'text-gray-500' }}"
                    data-target="#{{ $id }}">
                <span class="block">{{ $tab['title'] }}</span>
                <small class="text-gray-400 text-xs">{{ $tab['subtitle'] }}</small>
            </button>
        @endforeach
    </div>

    <!-- Toast -->
    <div id="showToast" class="hidden mb-4 px-4 py-2 rounded text-white"></div>

    <!-- Tab Content -->
    <div id="tab-content" class="space-y-6">
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
    const tabs = document.querySelectorAll('.tab-btn');
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const target = tab.dataset.target;
            document.querySelectorAll('#tab-content > div').forEach(div => div.classList.add('hidden'));
            document.querySelector(target).classList.remove('hidden');

            tabs.forEach(t => t.classList.remove('border-b-2', 'border-blue-600', 'font-semibold', 'text-gray-900'));
            tab.classList.add('border-b-2', 'border-blue-600', 'font-semibold', 'text-gray-900');
        });
    });

    // Show first tab by default
    document.querySelectorAll('#tab-content > div').forEach((div, i) => {
        if(i === 0) div.classList.remove('hidden'); else div.classList.add('hidden');
    });


    // Initialize Quill editors for About Us
    const aboutUsQuill1 = new Quill('#aboutUsQuill1', { modules: { toolbar: '#toolbar-container-aboutUs1' }, theme: 'snow', placeholder: 'Enter information for Box 1...' });
    const aboutUsQuill2 = new Quill('#aboutUsQuill2', { modules: { toolbar: '#toolbar-container-aboutUs2' }, theme: 'snow', placeholder: 'Enter information for Box 2...' });

    @if(isset($settings['about_us']['box1_info']))
        aboutUsQuill1.root.innerHTML = `{!! $settings['about_us']['box1_info'] !!}`;
    @endif
    @if(isset($settings['about_us']['box2_info']))
        aboutUsQuill2.root.innerHTML = `{!! $settings['about_us']['box2_info'] !!}`;
    @endif

    // Form submission handler (all forms)
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', async function(e){
            e.preventDefault();
            const formData = new FormData(this);
            const key = this.querySelector('input[name="_key"]').value;

            // About Us Quill
            if(key === 'about_us') {
                formData.set('box1_info', aboutUsQuill1.root.innerHTML);
                formData.set('box2_info', aboutUsQuill2.root.innerHTML);
            }

            // Header menu pages[]
            if(key === 'header_menu') {
                const checkedPages = Array.from(this.querySelectorAll('input[name="pages[]"]:checked')).map(cb => cb.value);
                formData.delete('pages[]');
                checkedPages.forEach(v => formData.append('pages[]', v));
            }

            // Checkbox normalization
            this.querySelectorAll('input[type="checkbox"]').forEach(cb => {
                if(cb.name && cb.name !== 'pages[]' && !cb.name.startsWith('items[')) {
                    formData.set(cb.name, cb.checked ? 1 : 0);
                }
            });

            // Offer items
            if(key === 'offer') {
                const offerItems = [];
                this.querySelectorAll('.offerItem').forEach(div => {
                    const title = div.querySelector('input[name="items[][title]"]').value;
                    const info = div.querySelector('input[name="items[][info]"]').value;
                    const enabled = div.querySelector('input[name="items[][enabled]"]').checked ? 1 : 0;
                    const image = div.querySelector('input[name="items[][image]"]').files[0] || null;
                    offerItems.push({title, info, enabled, image});
                });
                Array.from(formData.keys()).filter(k => k.startsWith('items[')).forEach(k => formData.delete(k));
                offerItems.forEach((item, i)=>{
                    formData.append(`items[${i}][title]`, item.title);
                    formData.append(`items[${i}][info]`, item.info);
                    formData.append(`items[${i}][enabled]`, item.enabled);
                    if(item.image) formData.append(`items[${i}][image]`, item.image);
                });
            }

            // Core features
            if(key === 'core_features') {
                const coreItems = [];
                this.querySelectorAll('.CoreFeatureItem').forEach(div=>{
                    const title = div.querySelector('input[name="items[][title]"]').value;
                    const sub_title = div.querySelector('input[name="items[][sub_title]"]').value;
                    const image = div.querySelector('input[name="items[][image]"]').files[0] || null;
                    coreItems.push({title, sub_title, image});
                });
                Array.from(formData.keys()).filter(k => k.startsWith('items[')).forEach(k=>formData.delete(k));
                coreItems.forEach((item, i)=>{
                    formData.append(`items[${i}][title]`, item.title);
                    formData.append(`items[${i}][sub_title]`, item.sub_title);
                    if(item.image) formData.append(`items[${i}][image]`, item.image);
                });
            }

            // Submit via fetch
            try{
                const response = await fetch("{{ url('beft/allsettings') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                const data = await response.json();
                 if(data.success){
                    $('#showToast').removeClass('hidden bg-red-500').addClass('bg-green-500').text(data.message).fadeIn();
                    setTimeout(()=> $('#showToast').fadeOut(), 2000);
                } else {
                    $('#showToast').removeClass('hidden bg-green-500').addClass('bg-red-500').text(data.message || 'Error').fadeIn();
                    setTimeout(()=> $('#showToast').fadeOut(), 2000);
                }
            } catch(err){
                $('#showToast').removeClass('hidden bg-green-500').addClass('bg-red-500').text('An error occurred while submitting the form.' || 'Error').fadeIn();
                    setTimeout(()=> $('#showToast').fadeOut(), 2000);
            }
        });
    });

    // Add dynamic points
    document.querySelectorAll('.addNewPoint').forEach(btn=>{
        btn.addEventListener('click', function(){
            const targetId = this.dataset.target;
            const inputName = this.dataset.name;
            const html = `<div class="flex gap-2 mt-2 pointItem">
                <input type="text" name="${inputName}" class="border p-2 rounded w-full" placeholder="Enter point">
                <button type="button" class="text-red-600 hover:text-red-800 remove-button" data-target=".pointItem">
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
                <div class="CoreFeatureItem grid grid-cols-1 md:grid-cols-12 gap-4 items-end mt-4 p-4 border rounded bg-white shadow">
                    <div class="md:col-span-4">
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="items[][title]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2">
                    </div>

                    <div class="md:col-span-4">
                        <label class="block text-sm font-medium text-gray-700">Sub Title</label>
                        <input type="text" name="items[][sub_title]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2">
                    </div>

                    <div class="md:col-span-3">
                        <label class="block text-sm font-medium text-gray-700">Image</label>
                        <input type="file" name="items[][image]" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    <div class="md:col-span-1 flex justify-end">
                        <button type="button" class="text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded-md remove-button">
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
                <div class="offerItem border rounded p-4 mt-4 bg-white shadow">

                    <div class="mt-2 flex justify-end">
                        <button type="button" class="text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded-md remove-button" data-target=".CoreFeatureItem">
                            <iconify-icon icon="ic:twotone-close"></iconify-icon>
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="items[][title]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Image</label>
                            <input type="file" name="items[][image]" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                        <div class="md:col-span-1 flex items-end">
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" name="items[][enabled]" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" checked>
                                <label class="text-sm text-gray-700">Enabled</label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Info</label>
                        <input type="text" name="items[][info]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2">
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
            <div class="chooseUsItem grid grid-cols-1 md:grid-cols-12 gap-4 p-4 mt-4 bg-white shadow items-end border rounded ">
                <div class="md:col-span-4">
                    <label class="block text-sm font-medium text-gray-700">Main Info</label>
                    <input type="text" name="items[${index}][info]"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2">
                </div>

                <div class="md:col-span-4">
                    <label class="block text-sm font-medium text-gray-700">Main Details</label>
                    <input type="text" name="items[${index}][details]"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2">
                </div>

                <div class="md:col-span-3">
                    <label class="block text-sm font-medium text-gray-700">Main Image</label>
                    <input type="file" name="items[${index}][image]"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>

                <div class="md:col-span-1 flex justify-end">
                    <button type="button" class="text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded-md remove-chooseUsItem">
                        <iconify-icon icon="ic:twotone-close"></iconify-icon>
                    </button>
                </div>
            </div>`;
        chooseUsList.insertAdjacentHTML('beforeend', html);
    });

    // Remove Choose Us row (event delegation)
    chooseUsList.addEventListener('click', function(e) {
        const btn = e.target.closest('.remove-chooseUsItem');
        if(btn){
            btn.closest('.chooseUsItem').remove();
        }
    });


    // Event delegation for removing items
    document.addEventListener('click', function(e){
        const btn = e.target.closest('.remove-button');
        if(!btn) return;

        // Check which type of item we are removing
        if(btn.closest('.CoreFeatureItem')){
            btn.closest('.CoreFeatureItem').remove();
        }
        else if(btn.closest('.offerItem')){
            btn.closest('.offerItem').remove();
        }
        else if(btn.closest('.pointItem')){
            btn.closest('.pointItem').remove();
        }
    });


});
</script>
@endpush
