@extends('setting::layouts.beft')
@push('styles')
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@section('title', 'Custom Page Settings')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h3 class="text-2xl font-semibold">Custom Pages Management</h3>
    <button id="showAddEditPage" class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        <span class="iconify" data-icon="ic:baseline-plus"></span> Add New Page
    </button>
</div>

<table id="custom-pages-table" class="min-w-full border border-gray-200 rounded">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2 text-left border-b">Title</th>
            <th class="px-4 py-2 text-left border-b">Enabled</th>
            <th class="px-4 py-2 text-left border-b">Action</th>
        </tr>
    </thead>
</table>

<!-- Add/Edit Modal -->
<div class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" id="addEditPage">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl">
        <form id="custom-page-form" class="p-6">
            @csrf
            <input type="hidden" name="id" id="custom_page_id">
            <div class="flex justify-between items-center mb-4">
                <h5 class="text-xl font-semibold" id="modalTitle">Create New Page</h5>
                <button type="button" class="text-gray-500 hover:text-gray-700" onclick="document.getElementById('addEditPage').classList.add('hidden')">&times;</button>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block mb-1 font-medium">Title</label>
                    <input type="text" name="title" id="title" class="border rounded p-2 w-full" placeholder="Enter title">
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="enabled" id="enabled" class="h-5 w-5" checked>
                    <label class="font-medium" for="enabled">Enabled Page</label>
                </div>
                <div>
                    <label class="block mb-1 font-medium">Content</label>
                    <div id="editor" class="border rounded h-64"></div>
                    <input type="hidden" name="content" id="content">
                </div>
            </div>
            <div class="mt-4 flex justify-end gap-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save Page</button>
                <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400" onclick="document.getElementById('addEditPage').classList.add('hidden')">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Page Preview Modal -->
<div class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" id="pagePreview">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl p-6">
        <div class="flex justify-between items-center mb-4">
            <h5 class="text-xl font-semibold" id="previewTitle"></h5>
            <button type="button" class="text-gray-500 hover:text-gray-700" onclick="document.getElementById('pagePreview').classList.add('hidden')">&times;</button>
        </div>
        <div id="previewContent" class="prose max-w-full"></div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" id="confirmationModal">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h5 class="text-lg font-semibold mb-4">Confirm Delete</h5>
        <p class="mb-6">Are you sure you want to delete this page?</p>
        <div class="flex justify-end gap-2">
            <button type="button" id="confirmDeleteBtn" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Yes, delete</button>
            <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400" onclick="document.getElementById('confirmationModal').classList.add('hidden')">Cancel</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
$(document).ready(function() {
    // Initialize Quill
    const quill = new Quill('#editor', { theme: 'snow', placeholder: 'Write page content...' });
    const contentHiddenInput = document.getElementById('content');
    quill.on('text-change', () => contentHiddenInput.value = quill.root.innerHTML);

    const addEditModal = document.getElementById('addEditPage');
    const pagePreviewModal = document.getElementById('pagePreview');
    const confirmationModal = document.getElementById('confirmationModal');

    const table = $('#custom-pages-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('beft/custom-pages') }}",
        columns: [
            { data: 'title', name: 'title' },
            { data: 'enabled', name: 'enabled',
              render: d => d ? '<span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">Enabled</span>' : '<span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-sm">Disabled</span>'
            },
            { data: 'id', orderable: false, searchable: false,
              render: function(data) {
                return `
                    <button class="px-2 py-1 bg-gray-200 text-gray-700 rounded text-sm preview-btn" data-id="${data}">Preview</button>
                    <button class="px-2 py-1 bg-blue-500 text-white rounded text-sm edit-btn" data-id="${data}">Edit</button>
                    <button class="px-2 py-1 bg-yellow-400 text-white rounded text-sm toggle-status-btn" data-id="${data}">Toggle</button>
                    <button class="px-2 py-1 bg-red-600 text-white rounded text-sm delete-btn" data-id="${data}">Delete</button>
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
        addEditModal.classList.remove('hidden');
    });

    // Form Submit
    $('#custom-page-form').submit(function(e) {
        e.preventDefault();
        const id = $('#custom_page_id').val();
        const url = id ? `/beft/custom-pages/${id}` : "/beft/custom-pages";
        const formData = new FormData(this);
        formData.set('content', quill.root.innerHTML);
        formData.set('enabled', $('#enabled').is(':checked') ? 1 : 0);
        if(id) formData.append('_method', 'PUT');

        $.ajax({
            url: url,
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: () => { table.ajax.reload(); addEditModal.classList.add('hidden'); }
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
                addEditModal.classList.remove('hidden');
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
                pagePreviewModal.classList.remove('hidden');
            });
    });

    // Delete
    let deleteId = null;
    $('#custom-pages-table').on('click', '.delete-btn', function() {
        deleteId = $(this).data('id');
        confirmationModal.classList.remove('hidden');
    });
    $('#confirmDeleteBtn').click(() => {
        fetch(`/beft/custom-pages/${deleteId}`, {
            method: 'DELETE',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        }).then(res => res.json()).then(data => {
            confirmationModal.classList.add('hidden');
            table.ajax.reload();
        });
    });

    // Toggle Status
    $('#custom-pages-table').on('click', '.toggle-status-btn', function() {
        const id = $(this).data('id');
        fetch(`/beft/custom-pages/${id}/toggle-status`, {
            method: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        }).then(res => res.json()).then(data => {
            table.ajax.reload();
        });
    });

});
</script>
@endpush
