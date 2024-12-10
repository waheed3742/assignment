@extends('layouts.app')
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
                    {{-- <div class="nk-tb-list is-separate mb-3">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="pid">
                                    <label class="custom-control-label" for="pid"></label>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-sm"><span>Name</span></div>
                            <div class="nk-tb-col"><span>SKU</span></div>
                            <div class="nk-tb-col"><span>Price</span></div>
                            <div class="nk-tb-col"><span>Stock</span></div>
                            <div class="nk-tb-col tb-col-md"><span>Category</span></div>
                            <div class="nk-tb-col tb-col-md"><em class="tb-asterisk icon ni ni-star-round"></em></div>
                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1 my-n1">
                                    <li class="me-n1">
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#"><em class="icon ni ni-edit"></em><span>Edit Selected</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-trash"></em><span>Remove Selected</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-bar-c"></em><span>Update Stock</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-invest"></em><span>Update Price</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .nk-tb-item -->
                        <div class="nk-tb-item">
                            <div class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="pid1">
                                    <label class="custom-control-label" for="pid1"></label>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-sm">
                                <span class="tb-product">
                                    <img src="./images/product/a.png" alt="" class="thumb">
                                    <span class="title">Pink Fitness Tracker</span>
                                </span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="tb-sub">UY3749</span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="tb-lead">$ 99.49</span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="tb-sub">49</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-sub">Fitbit, Tracker</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <div class="asterisk tb-asterisk">
                                    <a href="#"><em class="asterisk-off icon ni ni-star"></em><em class="asterisk-on icon ni ni-star-fill"></em></a>
                                </div>
                            </div>
                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1 my-n1">
                                    <li class="me-n1">
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#"><em class="icon ni ni-edit"></em><span>Edit Product</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-eye"></em><span>View Product</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-activity-round"></em><span>Product Orders</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-trash"></em><span>Remove Product</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .nk-tb-item -->
                    </div><!-- .nk-tb-list -->
                    <div class="card">
                        <div class="card-inner">
                            <div class="nk-block-between-md g-3">
                                <div class="g">
                                    <ul class="pagination justify-content-center justify-content-md-start">
                                        <li class="page-item"><a class="page-link" href="#"><em class="icon ni ni-chevrons-left"></em></a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><span class="page-link"><em class="icon ni ni-more-h"></em></span></li>
                                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                                        <li class="page-item"><a class="page-link" href="#">7</a></li>
                                        <li class="page-item"><a class="page-link" href="#"><em class="icon ni ni-chevrons-right"></em></a></li>
                                    </ul><!-- .pagination -->
                                </div>
                                <div class="g">
                                    <div class="pagination-goto d-flex justify-content-center justify-content-md-start gx-3">
                                        <div>Page</div>
                                        <div>
                                            <select class="form-select js-select2 " data-search="on" data-dropdown="xs center">
                                                <option value="page-1">1</option>
                                                <option value="page-2">2</option>
                                                <option value="page-4">4</option>
                                                <option value="page-5">5</option>
                                                <option value="page-6">6</option>
                                                <option value="page-7">7</option>
                                                <option value="page-8">8</option>
                                                <option value="page-9">9</option>
                                                <option value="page-10">10</option>
                                                <option value="page-11">11</option>
                                                <option value="page-12">12</option>
                                                <option value="page-13">13</option>
                                                <option value="page-14">14</option>
                                                <option value="page-15">15</option>
                                                <option value="page-16">16</option>
                                                <option value="page-17">17</option>
                                                <option value="page-18">18</option>
                                                <option value="page-19">19</option>
                                                <option value="page-20">20</option>
                                            </select>
                                        </div>
                                        <div>OF 102</div>
                                    </div>
                                </div><!-- .pagination-goto -->
                            </div><!-- .nk-block-between -->
                        </div>
                    </div> --}}
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
            var formData = $(this).serialize();
            var mode = $('#form_mode').val();
            var url;
            var method;
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
                    var errors = xhr.responseJSON.errors;
                    if (errors.name) {
                        $('#nameError').text(errors.name[0]);
                    }
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
                } else {
                    window.hot = new Handsontable(container, {
                        data: data,
                        colHeaders: ['Category Name', 'Actions'],
                        columns: [
                            { data: 'name' },
                            { data: 'actions', renderer: Handsontable.renderers.HtmlRenderer }
                        ],
                        rowHeaders: true,
                        stretchH: 'all',
                        height: 400,
                        width: '100%',
                        licenseKey: 'non-commercial-and-evaluation'
                    });
                }
            }
        });
    }
</script>
@endpush
@endsection