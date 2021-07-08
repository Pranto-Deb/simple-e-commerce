@extends('layouts.admin.app')

@section('title', 'Size')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary mt-2">
                <div class="card-header">
                    <h3 class="card-title">Add Size</h3>
                </div>
                <form role="form" class="GlobalFormValidation" action="{{ route('admin.size.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Size Name</label>
                                    <input type="text" name="size_name" class="form-control" id="exampleInputEmail1" placeholder="Enter size name"
                                        value="{{ old('size_name') }}"
                                        data-fv-notempty-message='Size name Is Required'
                                        required>
                                </div>
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
        <div class="col-md-8">
            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Size Table</h3>
                </div>
                @include('layouts.admin.includes.alert_process')
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Size Name</th>
                                <th style="width: 60px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($sizes) && count($sizes) > 0)
                                @foreach($sizes as $size)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $size->size_name }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" data-href="{{ route('admin.size.destroy', $size->size_id) }}" class="btn-delete btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{ $sizes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

