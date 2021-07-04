@extends('layouts.admin.app')

@section('title', 'Service')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Service Table</h3>
                    <div class="heading-elements">
                        <a href="{{ route('admin.service.create') }}" class="btn btn-success btn-sm mr-4 mt-2 float-right"><i class="icon-plus2"></i>Add Service</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Service title</th>
                                <th>Icon</th>
                                <th>Details</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th style="width: 60px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (!empty($services) && count($services) > 0)
                                @foreach($services as $service)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $service->service_title }}</td>
                                        <td>
                                            <img src="{{ $service->icon_url }}" alt="" style="height: 60px; width: 60px">
                                        </td>
                                        <td>
                                            <details>
                                                <summary>Show Details</summary>
                                                <p>{!! $service->service_details !!}</p>
                                            </details>
                                        </td>
                                        <td>{{ $service->position }}</td>
                                        <td>
                                            @if($service->status == '1')
                                                <span class="badge badge-success">Active</span>
                                            @else($service->status == '2')
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.service.edit', $service->service_id) }}" class="btn btn-info btn-sm btn-block">Edit</a>
                                            <a href="#" data-href="{{ route('admin.service.destroy', $service->service_id) }}" class="btn-delete btn btn-danger btn-sm btn-block">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    {{ $services->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
