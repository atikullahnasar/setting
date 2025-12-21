@extends('setting::layouts.beft')

@push('styles')
<style>
    :root {
        --primary-600: #16a34a;
    }

    .peer:checked ~ .peer-checked\:bg-primary-600 {
        background-color: var(--primary-600);
    }
</style>
    <!-- Add extra CSS if needed -->
@endpush

@section('title', 'Footer Settings')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">

    <div class="mb-4">
        @php
            $tabs = [
                'column1' => ['title'=>'Column 1', 'subtitle'=>'Footer Column 1 Settings'],
                'column2' => ['title'=>'Column 2', 'subtitle'=>'Footer Column 2 Settings'],
                'column3' => ['title'=>'Column 3', 'subtitle'=>'Footer Column 3 Settings'],
                'column4' => ['title'=>'Column 4', 'subtitle'=>'Footer Column 4 Settings'],
                'social'  => ['title'=>'Social Activity', 'subtitle'=>'Social Footer Settings']
            ];
        @endphp

        <div class="flex flex-wrap gap-2 border-b border-gray-300">
            @foreach($tabs as $id => $tab)
                <button
                    class="tab-btn px-4 py-2 text-left border-b-2 border-transparent hover:border-blue-500 transition-colors {{ $loop->first ? 'border-blue-500 font-semibold' : '' }}"
                    data-target="#{{ $id }}">
                    <div>{{ $tab['title'] }}</div>
                    <small class="text-gray-500 text-sm">{{ $tab['subtitle'] }}</small>
                </button>
            @endforeach
        </div>

        <!-- Toast -->
        <div id="showToast" class="hidden mt-2 text-white px-3 py-2 rounded"></div>
    </div>

    <div id="tab-content">
        @include('setting::system-settings.footer.partials._column1', ['settings' => $settings])
        @include('setting::system-settings.footer.partials._column2', ['settings' => $settings])
        @include('setting::system-settings.footer.partials._column3', ['settings' => $settings])
        @include('setting::system-settings.footer.partials._column4', ['settings' => $settings])
        @include('setting::system-settings.footer.partials._social', ['settings' => $settings])
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('#tab-content > div');

    // Tab switching
    tabButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const target = btn.dataset.target;
            tabContents.forEach(tc => tc.classList.add('hidden'));
            document.querySelector(target).classList.remove('hidden');

            tabButtons.forEach(b => b.classList.remove('border-blue-500', 'font-semibold'));
            btn.classList.add('border-blue-500', 'font-semibold');
        });
    });

    // Show default tab
    tabContents.forEach(tc => tc.classList.add('hidden'));
    document.querySelector('#column1').classList.remove('hidden');

    // Form submissions
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const key = this.querySelector('input[name="_key"]').value;

            if (key !== 'footer_column1') {
                formData.delete('pages[]');
                this.querySelectorAll('input[name="pages[]"]:checked').forEach(cb => {
                    formData.append('pages[]', cb.value);
                });
            }

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
                if(data.success){
                    $('#showToast').removeClass('hidden bg-red-500').addClass('bg-green-500').text(data.message).fadeIn();
                    setTimeout(()=> $('#showToast').fadeOut(), 2000);
                } else {
                    $('#showToast').removeClass('hidden bg-green-500').addClass('bg-red-500').text(data.message || 'Error').fadeIn();
                    setTimeout(()=> $('#showToast').fadeOut(), 2000);
                }
            } catch (error) {
                 $('#showToast').removeClass('hidden bg-green-500').addClass('bg-red-500').text('An error occurred while submitting the form.' || 'Error').fadeIn();
                    setTimeout(()=> $('#showToast').fadeOut(), 2000);
            }
        });
    });
});
</script>
@endpush
