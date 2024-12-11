@extends('admin.layouts.app')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Category</h3>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#addCategoryModal" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#addCategoryModal" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Category</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div id="categoryTable"></div>
                </div><!-- .nk-block -->
                <!-- Modal for Add Category -->
                    <div class="modal fade" id="addCategoryModal" tabindex="-1"                             aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="addCategoryForm">
                                        @csrf
                                        <div id="generalError" class="text-danger mb-3" style="display: none;"></div>
                                        <div class="mb-3">
                                            <label for="categoryName" class="form-label">Category Name</label>
                                            <input type="text" class="form-control" id="categoryName" name="name" placeholder="Enter Category Name">
                                            <input type="hidden" name="category_id" id="category_id">
                                            <input type="hidden" name="form_mode" id="form_mode" value="add">
                                            <span id="nameError" class="text-danger"></span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Category</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- Modal for Add Category ends here-->
            </div>
        </div>
    </div>
</div>
@push('custom_scripts')
<script>
    $(document).ready(function () {
        loadCategories();

        $('#addCategoryForm').on('submit', function (e) {
            e.preventDefault();

            var submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true).html('Saving...');

            $('.text-danger').text('');
            $('#generalError').remove();

            var formData = $(this).serialize();
            var mode = $('#form_mode').val();
            var url, method;

            if (mode == 'add') {
                url = "{{ route('admin.categories.store') }}";
                method = 'POST';
            } else if (mode == 'edit') {
                var categoryId = $('#category_id').val();
                url = `{{ route('admin.categories.update', ':id') }}`.replace(':id', categoryId);
                method = 'PUT';
            }

            $.ajax({
                url: url,
                type: method,
                data: formData,
                success: function (response) {
                    if (response.success) {
                        alert(response.message);
                        loadCategories(); 
                        clearModal();
                        $('#addCategoryModal').modal('hide'); 
                    }
                },
                error: function (xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;

                        for (const field in errors) {
                            $('#' + field + 'Error').text(errors[field][0]);
                        }
                    }

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        $('#addCategoryForm').prepend(
                            `<div id="generalError" class="alert alert-danger">${xhr.responseJSON.message}</div>`
                        );
                    }
                },
                complete: function () {
                    submitButton.prop('disabled', false).html('Save Category');
                }
            });
        });

        $(document).on('click', '.delete-btn', function () {
            var categoryId = $(this).data('id');
            if (confirm('Are you sure you want to delete this category?')) {
                $.ajax({
                    url: `{{ route('admin.categories.destroy', ':id') }}`.replace(':id', categoryId),
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        alert(response.message);
                        loadCategories();
                    },
                    error: function () {
                        alert('Error deleting category.');
                    }
                });
            }
        });
        $(document).on('click', '.edit-btn', function () {
            var categoryId = $(this).data('id');
            if (categoryId) {
                $.ajax({
                    url: `{{ route('admin.categories.edit', ':id') }}`.replace(':id', categoryId),
                    type: 'GET',
                    success: function (response) {
                        if (response.status === true) {
                            $('#addCategoryModalLabel').text('Edit Category');
                            $('#categoryName').val(response.category.name);
                            $('#category_id').val(response.category.id);
                            $('#form_mode').val('edit');
                            $('#addCategoryModal').modal('show'); 
                        } else {
                            alert(response.message)
                        }
                    },
                    error: function () {
                        alert('Error fetching category.');
                    }
                });
            }
        });
        function clearModal() {
            $('#addCategoryForm')[0].reset();
            $('#categoryName').val('');
            $('#nameError').text('');
            $('#category_id').val('');
            $('#form_mode').val('add');
            $('#submitButton').text('Add Category');
        }
        $('#addCategoryModal').on('hidden.bs.modal', function () {
            clearModal();
        });
    });

    function loadCategories() {
        $.ajax({
            url: '{{ route('admin.categories.index') }}',
            type: 'GET',
            success: function (response) {
                const data = response.map(category => ({
                    name: category.name,
                    actions: `<button class="edit-btn" data-id="${category.id}">Edit</button>
                              <button class="delete-btn" data-id="${category.id}">Delete</button>`
                }));

                const container = $('#categoryTable')[0];
                if (window.hot) {
                    window.hot.loadData(data);
                    return;
                }
                    window.hot = new Handsontable(container, {
                        data: data,
                        colHeaders: ['Category Name', 'Actions'],
                        columns: [
                            { data: 'name' },
                            { data: 'actions', renderer: Handsontable.renderers.HtmlRenderer, readOnly: true }
                        ],
                        rowHeaders: true,
                        stretchH: 'all',
                        height: 400,
                        width: '100%',
                        licenseKey: 'non-commercial-and-evaluation'
                    });
            }
        });
    }
</script>
@endpush
@endsection