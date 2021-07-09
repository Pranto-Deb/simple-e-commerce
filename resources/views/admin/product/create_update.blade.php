@extends('layouts.admin.app')

@section('title', 'Product')

@section('PageCss')
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary mt-2">
                <div class="card-header">
                    <h3 class="card-title">Add Product</h3>
                </div>
                <form role="form" class="GlobalFormValidation" action="{{ !empty($product) ? route('admin.product.update', $product->product_id) : route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(!empty($product))
                        @method('PUT')
                    @endif
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="productName">Product Name</label>
                                    <input type="text" name="product_name" class="form-control"
                                            id="productName" placeholder="Enter product name"
                                            value="{{ !empty($product) ? $product->product_name : old('product_name') }}"
                                            data-fv-notempty-message='Product Name Is Required*' required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="productPrice">Price</label>
                                    <input type="number" name="product_price"
                                           class="form-control" id="productPrice"
                                           placeholder="Enter product Price"
                                           value="{{ !empty($product)? $product->product_price: old('product_price') }}"
                                           data-fv-notempty-message='Product Price Is Required*' required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="content-label">Category</label>
                                    <select class="form-control" name="cat_id" id="category" style="width: 100%;" required data-fv-notempty-message='Product Category Is Required*'>
                                        <option {{ empty($product) ? 'selected' : ''}}>Select a category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->category_id }}" {{ !empty($product) && $category->category_id == $product->cat_id ? 'selected' : ''}}>
                                                {{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="content-label">Sub Category</label>
                                    <select class="form-control" name="sub_cat_id" id="subcategory" style="width: 100%;">

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="content-label">Brand</label>
                                    <select class="form-control" id="brand" name="br_id" style="width: 100%;" required>
                                        <option {{ empty($product) ? 'selected': '' }}>Select a band</option>
                                        @foreach($brands as $brandId => $brandName)
                                            <option value="{{ $brandId }}" {{ !empty($product) && $brandId == $product->br_id ? 'selected' : ''}}>
                                                {{ $brandName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="features">Features</label>
                                    <textarea class="textarea" name="product_features"
                                              id="features" placeholder="Enter product features"
                                        style="width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                        data-fv-notempty-message='Product Features Is Required*' required>
                                        {{ !empty($product)? $product->product_features: old('product_features') }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_details">Details</label>
                                    <textarea class="textarea" name="product_details"
                                            id="product_details" placeholder="Enter product details"
                                            style="width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                            data-fv-notempty-message='Product Details Is Required*' required>
                                        {{ !empty($product)? $product->product_details: old('product_details') }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_meta">Meta</label>
                                    <textarea class="form-control" name="product_meta" id="product_meta" placeholder="Enter product meta"
                                        style="width: 100%; height: 100px; font-size: 1rem; font-weight: 400; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                        data-fv-notempty-message='Product Meta Is Required*' required
                                        >{{ !empty($product)? $product->product_meta: old('product_meta') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="content-label" for="tag">Tags</label>
                                    <select class="select2 form-control" name="tag_ids[]" id="tag" multiple="multiple" data-placeholder="Select tags" style="width: 100%;">
                                        @foreach($tags as $tagId => $tag)
                                            <option value="{{ $tagId }}" {{ !empty($tagIds) && in_array($tagId, $tagIds) ? 'selected': '' }}>{{ $tag }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="size" class="content-label">Sizes</label>
                                    <select class="select2 form-control" name="size_ids[]" id="size" multiple="multiple" data-placeholder="Select sizes" style="width: 100%;">
                                        @foreach($sizes as $sizeId => $size)
                                            <option value="{{ $sizeId }}" {{ !empty($sizeIds) && in_array($sizeId, $sizeIds) ? 'selected' : '' }}>{{ $size }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" name="product_quantity"
                                           class="form-control" id="quantity"
                                           placeholder="Enter product quantity"
                                           value="{{ !empty($product) ? $product->product_quantity: old('product_quantity') }}"
                                           data-fv-notempty-message='Product Quantity Is Required*' required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="position">Position</label>
                                    <input type="number" name="position"
                                           class="form-control" id="position"
                                           placeholder="Enter position"
                                           value="{{ !empty($product)? $product->position: old('position') }}"
                                           data-fv-notempty-message='Product Position Is Required*' required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="content-label" for="status" >Status</label>
                                    <select class="form-control" name="status"  id="status" style="width: 100%;">
                                        <option {{ (empty($product) || (!empty($product) && $product->status == 1) ) ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ (!empty($product) && $product->status == 2) ? 'selected' : '' }} value="2">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            @if(!empty($product))
                            <div class="col-md-12">
                                <div class=" row">
                                    @foreach($product->attachments  as $attachment)
                                        <div class="col-4">
                                            <div class="image-block">
                                                <img src="{{ $attachment->image_path }}"
                                                     alt="..." class="img-thumbnail">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            <div class="col-md-12">
                                <label class="upload-block" for="postImg">
                                    <div class=" row gallery">

                                    </div>
                                    <div class="upload-info">
                                        <i class="fas fa-plus"></i>
                                        <span>Select Images</span>
                                    </div>
                                    <input type="file" name="images[]" multiple style="display: none;" id="postImg" class="multi-image-input">
                                </label>
                            </div>
                            <div class="col-md-12 mt-3">
                                @include('layouts.admin.includes.alert_message')
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('PageJs')

    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();
            $('.textarea').summernote()
        });
    </script>
    <script>
        $(document).ready(function () {

            $('#category').on('change',function(e) {

             var cat_id = e.target.value;

             $.ajax({

                   url:"{{ route('subcat') }}",
                   type:"POST",
                   data: {
                       cat_id: cat_id
                    },

                   success:function (data) {

                    $('#subcategory').empty();

                    $.each(data.subcategories,function(index,subcategory){

                        $('#subcategory').append('<option value="'+index+'">'+subcategory+'</option>');
                    })

                   }
               })
            });

        });
    </script>

@endsection

