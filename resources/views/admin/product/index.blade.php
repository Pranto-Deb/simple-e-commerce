@extends('layouts.admin.app')

@section('title', 'Product')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Product Table</h3>
                    <div class="heading-elements">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-success btn-sm mr-4 mt-2 float-right"><i class="icon-plus2"></i>Add Product</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Sizes</th>
                                <th>Status</th>
                                <th style="width: 60px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($products) && count($products) > 0)
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{ $product->attachment->image_path }}" alt="" style="height: 60px; width: 60px"></td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->product_price }}</td>
                                        <td>
                                            @if(!empty($product->sizes))
                                                @foreach($product->sizes as $size)
                                                <span class="badge badge-info">{{ $size->size_name }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->status == '1')
                                                <span class="badge badge-success">Active</span>
                                            @else($product->status == '2')
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                        <a href="{{ route('admin.product.show', $product->product_id) }}" class="btn btn-success btn-sm btn-block">View</a>
                                        <a href="{{ route('admin.product.edit', $product->product_id) }}" class="btn btn-info btn-sm btn-block">Edit</a>
                                        <a href="#" data-href="{{ route('admin.product.destroy', $product->product_id ) }}" class="btn-delete btn btn-danger btn-sm btn-block">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
