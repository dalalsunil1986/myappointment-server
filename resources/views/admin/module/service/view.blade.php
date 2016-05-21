@extends('admin.layouts.two-col')

@section('breadcrumb')
    <div class="banner">
        <h2>
            <a href="/admin">Home</a>
            <i class="fa fa-angle-right"></i>
            <a href="{{action('Admin\ServiceController@index')}}">Services</a>
            <i class="fa fa-angle-right"></i>
            <span>{{ $service->name }}</span>
        </h2>
    </div>
@endsection

@section('left')

    @include('admin.module.service.edit',['record'=>$service])

@endsection

@section('right')
    <div class="panel-body">
        <table class="table table-user-information">
            <tbody>
            <tr>
                <th>Name</th>
                <td>{{ $service->name }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $service->description }}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="panel-footer ">
        <a href="#" data-link="{{ action('Admin\ServiceController@destroy',$service->id) }}" data-target="#deleteModalBox" data-original-title="Delete Company" data-toggle="modal" type="button" class="btn btn-sm btn-danger"><i class="fa fa-2x fa-remove"></i></a>
    </div>
    @include('admin.partials.delete-modal',['info' => 'Delete Service '])

@endsection
