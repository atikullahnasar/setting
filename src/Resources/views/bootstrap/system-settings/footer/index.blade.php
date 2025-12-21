@extends('setting::layouts.beft')

@push('styles')
    <!-- Add extra CSS here if needed -->
@endpush

@section('title', 'Footer Settings')

@section('content')
<div class="container py-4">
    <nav>
        @php
            $tabs = [
                'column1' => ['title'=>'Column 1', 'subtitle'=>'Footer Column 1 Settings'],
                'column2' => ['title'=>'Column 2', 'subtitle'=>'Footer Column 2 Settings'],
                'column3' => ['title'=>'Column 3', 'subtitle'=>'Footer Column 3 Settings'],
                'column4' => ['title'=>'Column 4', 'subtitle'=>'Footer Column 4 Settings'],
                'social'  => ['title'=>'Social Activity', 'subtitle'=>'Social Footer Settings']
            ];
        @endphp
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

    <div id="tab-content" class="mt-3">
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
        $('.tab-btn').click(function() {
            let target = $(this).data('target');
            $('#tab-content > div').hide();
            $(target).show();
            $('.tab-btn').removeClass('active');
            $(this).addClass('active');
        });

        // Show default tab
        $('#tab-content > div').hide();
        $('#column1').show();

        function showToast(message, type = 'success') {
            const bgColor = type === 'success' ? 'bg-success' : 'bg-danger';
            $('#showToast').removeClass('bg-success bg-danger').addClass(bgColor).text(message).fadeIn();
            setTimeout(() => $('#showToast').fadeOut(), 2000);
        }
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const key = this.querySelector('input[name="_key"]').value;

                // Handle pages[] inputs for forms that are not footer_column1
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

                    if (!response.ok) {
                        showToast(data.message || 'An error occurred.','error');
                    } else {
                        showToast( data.message, 'success');
                    }
                } catch (error) {
                    showToast('An error occurred while submitting the form.', 'error');
                }
            });
        });
    });
</script>
@endpush
