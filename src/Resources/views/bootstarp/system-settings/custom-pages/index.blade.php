
@extends('setting::layouts.beft')
@push('styles')
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@section('title', 'Custom Page Settings')


@section('content')
    <div class="d-flex justify-content-between">
        <h3 class="mb-3">Custom Pages Management</h3>
        <button class="btn btn-primary mb-3" id="showAddEditPage">
            <span class="iconify" data-icon="ic:baseline-plus"></span> Add New Page
        </button>
    </div>

    <table id="custom-pages-table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Enabled</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>

<!-- Add/Edit Modal -->
<div class="modal fade" id="addEditPage" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="custom-page-form">
                @csrf
                <input type="hidden" name="id" id="custom_page_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Create New Page</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter title">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="enabled" id="enabled" class="form-check-input" checked>
                        <label class="form-check-label" for="enabled">Enabled Page</label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <div id="editor"></div>
                        <input type="hidden" name="content" id="content">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Page</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Page Preview Modal -->
<div class="modal fade" id="pagePreview" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="previewContent"></div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this page?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes, delete</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- Scripts -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script>
    $(document).ready(function() {

        // Initialize Quill
        const quill = new Quill('#editor', { theme: 'snow', placeholder: 'Write page content...' });
        const contentHiddenInput = document.getElementById('content');
        quill.on('text-change', () => contentHiddenInput.value = quill.root.innerHTML);

        const addEditModal = new bootstrap.Modal(document.getElementById('addEditPage'));
        const pagePreviewModal = new bootstrap.Modal(document.getElementById('pagePreview'));
        const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));

        // DataTable
        const table = $('#custom-pages-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('beft/custom-pages') }}",
            columns: [
                { data: 'title', name: 'title' },
                { data: 'enabled', name: 'enabled',
                render: d => d ? '<span class="badge bg-success">Enabled</span>' : '<span class="badge bg-danger">Disabled</span>'
                },
                { data: 'id', orderable: false, searchable: false,
                render: function(data) {
                    return `
                        <button class="btn btn-info btn-sm preview-btn" data-id="${data}">Preview</button>
                        <button class="btn btn-success btn-sm edit-btn" data-id="${data}">Edit</button>
                        <button class="btn btn-warning btn-sm toggle-status-btn" data-id="${data}">Toggle</button>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="${data}">Delete</button>
                    `;
                }
                }
            ]
        });

        // Show Add Page Modal
        $('#showAddEditPage').click(() => {
            $('#custom-page-form')[0].reset();
            quill.setContents([]);
            $('#custom_page_id').val('');
            $('#modalTitle').text('Create New Page');
            addEditModal.show();
        });

        // Form Submit (Add/Edit)
        $('#custom-page-form').submit(function(e) {
            e.preventDefault();

            const id = $('#custom_page_id').val();
            const url = id ? `/beft/custom-pages/${id}` : "/beft/custom-pages";
            const methodType = id ? 'PUT' : 'POST';

            let formData = new FormData(this);

            // Always include content + enabled
            formData.set('content', quill.root.innerHTML);
            formData.set('enabled', $('#enabled').is(':checked') ? 1 : 0);

            // Spoof PUT for Laravel
            if(id){ formData.append('_method', 'PUT');}

            $.ajax({
                url: url,
                method: "POST", // ALWAYS POST
                data: formData,
                processData: false,
                contentType: false,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: () => {
                    table.ajax.reload();
                    addEditModal.hide();
                }
            });
        });

        // Edit
        $('#custom-pages-table').on('click', '.edit-btn', function() {
            const id = $(this).data('id');
            fetch(`/beft/custom-pages/${id}/edit`)
                .then(res => res.json())
                .then(data => {
                    $('#custom_page_id').val(data.id);
                    $('#title').val(data.title);
                    $('#enabled').prop('checked', data.enabled == 1);
                    quill.root.innerHTML = data.content;
                    $('#modalTitle').text('Edit Page');
                    addEditModal.show();
                });
        });

        // Preview
        $('#custom-pages-table').on('click', '.preview-btn', function() {
            const id = $(this).data('id');
            fetch(`/beft/custom-pages/${id}/edit`)
                .then(res => res.json())
                .then(data => {
                    $('#previewTitle').text(data.title);
                    $('#previewContent').html(data.content);
                    pagePreviewModal.show();
                });
        });

        // Delete
        let deleteId = null;
        $('#custom-pages-table').on('click', '.delete-btn', function() {
            deleteId = $(this).data('id');
            confirmationModal.show();
        });
        $('#confirmDeleteBtn').click(() => {
            fetch(`/beft/custom-pages/${deleteId}`, {
                method: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            })
            .then(res => res.json())
            .then(data => {
                confirmationModal.hide();
                table.ajax.reload();
            });
        });

        // Toggle Status
        $('#custom-pages-table').on('click', '.toggle-status-btn', function() {
            const id = $(this).data('id');
            fetch(`/beft/custom-pages/${id}/toggle-status`, {
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            })
            .then(res => res.json())
            .then(data => {
                table.ajax.reload();
            });
        });

    });

</script>

@endpush
