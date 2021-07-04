@extends('layouts.admin.app')

@section('title', 'Tag')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary mt-2">
                <div class="card-header">
                    <h3 class="card-title">Add Tag</h3>
                </div>
                <form role="form" class="GlobalFormValidation" action="{{ route('admin.tag.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tag Name</label>
                                    <input type="text" name="tag_name" class="form-control" id="exampleInputEmail1" placeholder="Enter tag name"
                                        value=""
                                        data-fv-notempty-message='Tag name Is Required'
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
                    <h3 class="card-title">Tag Table</h3>
                </div>
                @include('layouts.admin.includes.alert_process')
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Tag Name</th>
                                <th style="width: 60px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($tags) && count($tags) > 0)
                                @foreach($tags as $tag)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $tag->tag_name }}</td>
                                    <td>
                                        <a href="#" data-href="{{ route('admin.tag.destroy', $tag->tag_id) }}" class="btn-delete btn btn-danger btn-sm btn-block">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{ $tags->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

