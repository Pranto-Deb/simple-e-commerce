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
                    <h3 class="card-title">Add Category</h3>
                </div>
                <form role="form" class="GlobalFormValidation" action="{{ !empty($category) ? route('admin.category.update', $category->category_id) : route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(!empty($category))
                        @method('PUT')
                    @endif
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category Name</label>
                                    <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" placeholder="Enter category name"
                                    value="{{ !empty($category)? $category->category_name: old('category_name') }}"
                                    data-fv-notempty-message='Category Name Is Required*' required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="parent_category">Main Category:</label>
                                    <select class="form-control" name="parent_id">
                                        <option {{ empty($category) ? 'selected' : ''}}>Select main category</option>
                                        @foreach($main_categories as $m_category)
                                            <option value="{{ $m_category->category_id }}" {{ (!empty($category)) && $m_category->category_id == $category->parent_id ? 'selected' : ''}}>{{ $m_category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Details</label>
                                    <textarea class="textarea" name="category_details" placeholder="Enter category details"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                        data-fv-notempty-message='Category Details Is Required*' required>
                                        {{ !empty($category)? $category->category_details: old('category_details') }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Position</label>
                                    <input type="number" name="position" class="form-control" id="exampleInputEmail1" placeholder="Enter position"
                                    value="{{ !empty($category)? $category->position: old('position') }}"
                                    data-fv-notempty-message='Category Position Is Required*' required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status" style="width: 100%;">
                                        <option {{  (empty($category) || (!empty($category) && $category->status == 1) ) ? 'selected' : '' }} value="1">Active</option>
                                        <option {{  (!empty($category) && $category->status == 2) ? 'selected' : '' }}  value="2">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="upload-block" for="postImg">
                                    <div class="gallery">
                                        @if(!empty($category) && !empty($category->attachment))
                                            <div class="image-block">
                                                <img src="{{ $category->attachment->image_path }}"
                                                     alt="..." class="img-thumbnail" style="width: 60px; height: 60px">
                                            </div>
                                        @endif
                                    </div>
                                    @if(empty($category) && empty($category->attachment))
                                        <div class="upload-info">
                                            <i class="fas fa-plus"></i>
                                            <span>Select Category Image</span>
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
    {{-- <script>
        $('#is_parent').change(function(){
          var is_checked=$('#is_parent').prop('checked');
          // alert(is_checked);
          if(is_checked){
            $('#parent_cat_div').addClass('d-none');
            $('#parent_cat_div').val('');
          }
          else{
            $('#parent_cat_div').removeClass('d-none');
          }
        })
      </script> --}}
@endsection
