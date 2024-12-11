@extends('admin.layouts.app')
@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Products</h3>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#addProductModal" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#addProductModal" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Product</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div id="productTable"></div>
                </div><!-- .nk-block -->
                <!-- Modal for Add Product -->
                <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="addProductForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="productName" class="form-label">Product Name</label>
                                        <input type="text" class="form-control" id="productName" name="name" placeholder="Enter Product Name" required>
                                        <span id="productNameError" class="text-danger"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="productPrice" class="form-label">Product Price</label>
                                        <input type="number" class="form-control" id="productPrice" name="price" placeholder="Enter Product Price" required>
                                        <span id="productPriceError" class="text-danger"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="productDescription" class="form-label">Product Description</label>
                                        <textarea class="form-control" id="productDescription" name="description" placeholder="Enter Product Description" rows="3"></textarea>
                                        <span id="productDescriptionError" class="text-danger"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="categories" class="form-label">Assign Categories</label>
                                        <select class="form-select js-select2 select2-hidden-accessible" id="categories" name="categories[]" multiple required>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <span id="categoriesError" class="text-danger"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="productImages" class="form-label">Product Images</label>
                                        <input type="file" class="form-control" id="productImages" name="images[]" multiple>
                                        <span id="productImagesError" class="text-danger"></span>
                                        <div id="imagePreviewContainer" class="mt-3 row"></div>
                                    </div>
                                    <input type="hidden" name="product_id" id="product_id">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Product</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal for Add Products ends here-->
                {{-- Modal for edit the product  --}}
                <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editProductForm" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="editProductId" name="product_id">
                                    
                                    <div class="mb-3">
                                        <label for="editProductName" class="form-label">Product Name</label>
                                        <input type="text" class="form-control" id="editProductName" name="name">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="editProductPrice" class="form-label">Product Price</label>
                                        <input type="number" class="form-control" id="editProductPrice" name="price">
                                    </div>

                                    <div class="mb-3">
                                        <label for="editProductDescription" class="form-label">Product Description</label>
                                        <textarea class="form-control" id="editProductDescription" name="description"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="editCategories" class="form-label">Categories</label>
                                        <select class="form-select js-select2 select2-hidden-accessible" id="editCategories" name="categories[]" multiple>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="editProductImages" class="form-label">Product Images</label>
                                        <input type="file" class="form-control" id="editProductImages" name="images[]" multiple>
                                    </div>

                                    <div id="imagePreviews" class="row mb-3"></div>

                                    <button type="submit" class="btn btn-primary">Update Product</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- edit modal ends here --}}
            </div>
        </div>
    </div>
</div>
@push('custom_scripts')
<script>
    $(document).ready(function () {
        loadProducts();

        function handleProductFormSubmit(formId, isEdit = false) {
            $(formId).on('submit', function (e) {
                e.preventDefault();

                const submitButton = $(this).find('button[type="submit"]');
                submitButton.prop('disabled', true).text(isEdit ? 'Updating...' : 'Saving...');

                $('.text-danger').text('');

                const formData = new FormData(this);
                const url = isEdit
                    ? `{{ route('admin.products.update', ':id') }}`.replace(':id', $('#editProductId').val())
                    : '{{ route("admin.products.store") }}';
                const method = 'POST';

                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.success) {
                            alert(response.message);
                            $(formId)[0].reset();
                            $(isEdit ? '#editProductModal' : '#addProductModal').modal('hide');
                            loadProducts();
                        }
                    },
                    error: function (xhr) {
                        const errors = xhr.responseJSON?.errors || {};

                        for (const field in errors) {
                            $(`#${field}Error`).text(errors[field][0]);
                        }

                        if (xhr.responseJSON?.message) {
                            alert(xhr.responseJSON.message);
                        }
                    },
                    complete: function () {
                        submitButton.prop('disabled', false).text(isEdit ? 'Update Product' : 'Save Product');
                    }
                });
            });
        }

        $(document).ready(function () {
            handleProductFormSubmit('#addProductForm');        
            handleProductFormSubmit('#editProductForm', true);
        });

        $(document).on('click', '.delete-btn', function() {
            const productId = $(this).data('id');
            
            if (confirm('Are you sure you want to delete this product?')) {
                $.ajax({
                    url: `{{ route('admin.products.destroy', ':id') }}`.replace(':id', productId),
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            loadProducts();
                        } else {
                            alert('Failed to delete the product');
                        }
                    },
                    error: function(error) {
                        alert('Error deleting product');
                    }
                });
            }
        });

        $(document).on('click', '.edit-btn', function() {
            const productId = $(this).data('id');

            $.ajax({
                url: `{{ route('admin.products.edit', ':id') }}`.replace(':id', productId),
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        const product = response.product;
                        const categories = response.categories;
                        
                        $('#editProductId').val(product.id);
                        $('#editProductName').val(product.name);
                        $('#editProductPrice').val(product.price);
                        $('#editProductDescription').val(product.description);

                        var selectedCategories = product.categories.map(function(category) {
                            return category.id;
                        });

                        $('#editCategories').val(selectedCategories).trigger('change');
                        
                        let imagePreviews = '';
                        product.images.forEach(image => {
                            imagePreviews += ` <div class="col-md-6 mb-3">
                                <img src="/storage/${image.image_path}" width="100%" class="img-thumbnail">
                            </div>`;
                        });
                        $('#imagePreviews').html(imagePreviews);

                        $('#editProductModal').modal('show');
                    }
                },
                error: function() {
                    alert('Failed to fetch product data');
                }
            });
        });

        $('#productImages').on('change', function (event) {
            const files = event.target.files;
            const previewContainer = $('#imagePreviewContainer');

            previewContainer.html('');

            if (files.length > 0) {
                $.each(files, function (index, file) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        const imgHtml = `
                            <div class="col-md-3 mb-3">
                                <img src="${e.target.result}" class="img-thumbnail" style="width: 100%; height: 100px; object-fit: cover;">
                            </div>
                        `;
                        previewContainer.append(imgHtml);
                    };

                    reader.readAsDataURL(file);
                });
            }
        });
    });

    function loadProducts() {
        $.ajax({
            url: '{{ route('admin.products.index') }}',
            type: 'GET',
            success: function (response) {
                const data = response.map(product  => ({
                    name: product.name,
                    price: product.price,
                    description: product.description,
                    categories: product.categories.map(category => category.name).join(', '),
                    images: product.images.map(image => {
                        const imageUrl = "{{ asset('storage') }}/" + image.image_path;
                        return `<img src="${imageUrl}" alt="${image.name}" width="50" height="50">`;
                    }).join(' '),
                    actions: `<button class="edit-btn" data-id="${product .id}">Edit</button>
                              <button class="delete-btn" data-id="${product .id}">Delete</button>`
                }));

                const container = $('#productTable')[0];
                if (window.hot) {
                    window.hot.loadData(data);

                    return;
                } 
                    window.hot = new Handsontable(container, {
                        data: data,
                        colHeaders: ['Product Name','Price','Description','Categories', 'Product Images', 'Actions'],
                        columns: [
                            { data: 'name' },
                            { data: 'price' },
                            { data: 'description' },
                            { data: 'categories' },
                            { data: 'images', renderer: Handsontable.renderers.HtmlRenderer , readOnly: true },
                            { data: 'actions', renderer: Handsontable.renderers.HtmlRenderer , readOnly: true }
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