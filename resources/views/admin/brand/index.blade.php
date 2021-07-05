@extends('layouts.admin.app')

@section('title', 'Service')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Brand Table</h3>
                    <div class="heading-elements">
                        <a href="{{ route('admin.brand.create') }}" class="btn btn-success btn-sm mr-4 mt-2 float-right"><i class="icon-plus2"></i>Add Brand</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Brand Name</th>
                                <th>Image</th>
                                <th>Details</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th style="width: 60px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (!empty($brands) && count($brands) > 0)
                                @foreach($brands as $brand)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $brand->brand_name }}</td>
                                        <td>
                                            <img src="{{ $brand->attachment->image_path }}" alt="" style="height: 60px; width: 60px">
                                        </td>
                                        <td>
                                            <details>
                                                <summary>Show Details</summary>
                                                <p>{!! $brand->brand_details !!}</p>
                                            </details>
                                        </td>
                                        <td>{{ $brand->position }}</td>
                                        <td>
                                            @if($brand->status == '1')
                                                <span class="badge badge-success">Active</span>
                                            @else($brand->status == '2')
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.brand.edit', $brand->brand_id) }}" class="btn btn-info btn-sm btn-block">Edit</a>
                                            <a href="#" data-href="{{ route('admin.brand.destroy', $brand->brand_id) }}" class="btn-delete btn btn-danger btn-sm btn-block">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    {{ $brands->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
