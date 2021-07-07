@extends('layouts.admin.app')

@section('title', 'Service')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Category Table</h3>
                    <div class="heading-elements">
                        <a href="{{ route('admin.category.create') }}" class="btn btn-success btn-sm mr-4 mt-2 float-right"><i class="icon-plus2"></i>Add Category</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Category Name</th>
                                    <th>Image</th>
                                    <th>Details</th>
                                    <th>Position</th>
                                    <th>Status</th>
                                    <th style="width: 60px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if (!empty($categories) && count($categories) > 0)
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td>
                                            <img src="{{ $category->attachment->image_path }}" alt="" style="height: 60px; width: 60px">
                                        </td>
                                        <td>
                                            <details>
                                                <summary>Show Details</summary>
                                                <p>{!! $category->category_details !!}</p>
                                            </details>
                                        </td>
                                        <td>{{ $category->position }}</td>
                                        <td>
                                            @if($category->status == '1')
                                                <span class="badge badge-success">Active</span>
                                            @else($category->status == '2')
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.category.edit', $category->category_id) }}" class="btn btn-info btn-sm btn-block">Edit</a>
                                            <a href="#" data-href="{{ route('admin.category.destroy', $category->category_id) }}" class="btn-delete btn btn-danger btn-sm btn-block">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
