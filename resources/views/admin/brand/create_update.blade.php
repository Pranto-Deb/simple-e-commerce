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
                    <h3 class="card-title">Add Service</h3>
                </div>
                <form role="form" class="GlobalFormValidation" action="{{ !empty($service) ? route('admin.service.update', $service->service_id) : route('admin.service.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(!empty($service))
                        @method('PUT')
                    @endif
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Service Title</label>
                                    <input type="text" name="service_title" class="form-control" id="exampleInputEmail1" placeholder="Enter service title"
                                    value="{{ !empty($service)? $service->service_title: old('service_title') }}"
                                    data-fv-notempty-message='Service Title Is Required*' required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Details</label>
                                    <textarea class="textarea" name="service_details" placeholder="Enter service details"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                        data-fv-notempty-message='Service Details Is Required*' required>
                                        {{ !empty($service)? $service->service_details: old('service_details') }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Position</label>
                                    <input type="number" name="position" class="form-control" id="exampleInputEmail1" placeholder="Enter position"
                                    value="{{ !empty($service)? $service->position: old('position') }}"
                                    data-fv-notempty-message='Service Position Is Required*' required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status" style="width: 100%;">
                                        <option {{  (empty($service) || (!empty($service) && $service->status == 1) ) ? 'selected' : '' }} value="1">Active</option>
                                        <option {{  (!empty($service) && $service->status == 2) ? 'selected' : '' }}  value="2">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="upload-block" for="postImg">
                                    <div class="gallery">
                                        @if(!empty($service) && !empty($service->icon_url))
                                            <div class="image-block">
                                                <img src="{{ $service->icon_url }}"
                                                     alt="..." class="img-thumbnail" style="width: 60px; height: 60px">
                                            </div>
                                        @endif
                                    </div>
                                    @if(empty($service) && empty($service->icon_url))
                                    <div class="upload-info">
                                        <i class="fas fa-plus"></i>
                                        <span>Select Icon</span>
                                    </div>
                                    @endif
                                    <input type="file" name="service_icon" style="display: none;" id="postImg" class="single-image-input">
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
