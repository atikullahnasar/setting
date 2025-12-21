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

    // Toast helper
    function showToast(message, type = 'success') {
        const toast = document.getElementById('showToast');
        toast.textContent = message;
        toast.classList.remove('hidden', 'bg-green-600', 'bg-red-600');
        toast.classList.add(type === 'success' ? 'bg-green-600' : 'bg-red-600');
        setTimeout(() => toast.classList.add('hidden'), 2000);
    }

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
                if(!response.ok) showToast(data.message || 'An error occurred','error');
                else showToast(data.message,'success');
            } catch(err){
                console.error(err);
                showToast('An error occurred while submitting the form','error');
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

    // Dynamic Core Feature, Offer, ChooseUs handlers remain the same
    document.addEventListener('click', function(e){
        if(e.target.closest('.remove-button')){
            const btn = e.target.closest('.remove-button');
            const item = btn.closest(btn.dataset.target);
            if(item) item.remove();
        }
        if(e.target.closest('.remove-chooseUsItem')){
            e.target.closest('.chooseUsItem').remove();
        }
    });

});
</script>
@endpush
