@extends('layouts.admin.app')

@section('title', 'Service')

@section('PageCss')
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary mt-2">
                <div class="card-header">
                    <h3 class="card-title">Add Brand</h3>
                </div>
                <form role="form" class="GlobalFormValidation" action="{{ !empty($brand) ? route('admin.brand.update', $brand->brand_id) : route('admin.brand.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(!empty($brand))
                        @method('PUT')
                    @endif
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Brand Name</label>
                                    <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" placeholder="Enter brand name"
                                    value="{{ !empty($brand)? $brand->brand_name: old('brand_name') }}"
                                    data-fv-notempty-message='Brand Name Is Required*' required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Details</label>
                                    <textarea class="textarea" name="brand_details" placeholder="Enter brand details"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                        data-fv-notempty-message='Brand Details Is Required*' required>
                                        {{ !empty($brand)? $brand->brand_details: old('brand_details') }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Position</label>
                                    <input type="number" name="position" class="form-control" id="exampleInputEmail1" placeholder="Enter brand position"
                                    value="{{ !empty($brand)? $brand->position: old('position') }}"
                                    data-fv-notempty-message='Brand Position Is Required*' required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status" style="width: 100%;">
                                        <option {{  (empty($brand) || (!empty($brand) && $brand->status == 1) ) ? 'selected' : '' }} value="1">Active</option>
                                        <option {{  (!empty($brand) && $brand->status == 2) ? 'selected' : '' }}  value="2">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="upload-block" for="postImg">
                                    <div class="gallery">
                                        @if(!empty($brand) && !empty($brand->attachment))
                                            <div class="image-block">
                                                <img src="{{ $brand->attachment->image_path }}"
                                                     alt="..." class="img-thumbnail" style="width: 60px; height: 60px">
                                            </div>
                                        @endif
                                    </div>
                                    @if(empty($brand) && empty($brand->attachment))
                                        <div class="upload-info">
                                            <i class="fas fa-plus"></i>
                                            <span>Select Brand Image</span>
                                        </div>
                                    @endif
                                    <input type="file" name="image_path" style="display: none;" id="postImg" class="single-image-input">
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            @include('layouts.admin.includes.alert_message')
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
    <script>
        $(function () {
            $('.textarea').summernote()
        });
    </script>
@endsection
