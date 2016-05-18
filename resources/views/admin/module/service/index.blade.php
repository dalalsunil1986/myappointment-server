@extends('admin.layouts.two-col')

@section('breadcrumb')
    <div class="banner">
        <h2>
            <a href="/admin">Home</a>
            <i class="fa fa-angle-right"></i>
            <span>Services</span>
        </h2>
    </div>
@endsection

@section('left')
    @include('admin.module.service.add')
@endsection

@section('right')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>Services</h1>
        </div>
    </div>
    <div class="panel-body" style="padding: 0;">
        <table class="table table-striped table-bordered table-hover" >
            <thead class="bg-blue">
            <tr>
                <th>Name</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($services as $service)
                <tr class="gradeU">
                    <td >
                        <span class="title">{{ $service->name }}</span>
                    </td>
                    <td class="f18">
                        <a href="#" class="red" data-toggle="modal" data-target="#deleteModalBox"
                           data-link="{{action('Admin\ServiceController@destroy',[$service->id])}}">
                            <i class="fa fa-close "></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @include('admin.partials.delete-modal',['info' => 'Remove Service'])
    </div>

@endsection
