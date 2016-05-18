@extends('admin.layouts.two-col')

@section('breadcrumb')
    <div class="banner">
        <h2>
            <a href="/admin">Home</a>
            <i class="fa fa-angle-right"></i>
            <a href="{{action('Admin\CompanyController@show',$companyService->company->id)}}">{{ $companyService->company->name }}</a>
            <i class="fa fa-angle-right"></i>
            <a href="{{action('Admin\CompanyServiceController@index',[$companyService->company->id])}}">Services</a>
            <i class="fa fa-angle-right"></i>
            <span>{{ $companyService->service->name }}</span>
        </h2>
    </div>
@endsection

@section('left')
    @include('admin.module.company.service.edit',['record'=>$companyService,'durations'=>$durations])
@endsection

@section('right')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>{{ $companyService->company->name }} - {{ $companyService->service->name }} </h1>
        </div>
    </div>
    <div class="panel-body" style="padding: 0;">
        <table class="table table-user-information">
            <tbody>
            <tr>
                <th>Company</th>
                <td><span class="title">{{ $companyService->company->name }}</span></td>
            </tr>
            <tr>
                <th>Service</th>
                <td><span class="title">{{ $companyService->service->name }}</span></td>
            </tr>
            <tr>
                <th>Description</th>
                <td><span class="title">{{ $companyService->description_en }}</span></td>

            </tr>
            <tr>
                <th>Price</th>
                <td><span class="title">{{ $companyService->price }}</span></td>

            </tr>
            <tr>
                <th>Duration</th>
                <td><span class="title">{{ $companyService->duration_en }}</span></td>
            </tr>

            </tbody>
        </table>
    </div>
    <div class="panel-footer ">
        <a href="#" data-link="{{ action('Admin\CompanyServiceController@destroy',[$companyService->company->id,$companyService->service->id]) }}" data-target="#deleteModalBox" data-original-title="Delete Company" data-toggle="modal" type="button" class="btn btn-sm btn-danger"><i class="fa fa-2x fa-remove"></i></a>
    </div>
    @include('admin.partials.delete-modal',['info' => 'Remove Service'])

@endsection
