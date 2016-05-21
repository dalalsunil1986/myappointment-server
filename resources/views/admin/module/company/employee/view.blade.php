@extends('admin.layouts.two-col')

@section('breadcrumb')
    <div class="banner">
        <h2>
            <a href="/admin">Home</a>
            <i class="fa fa-angle-right"></i>
            <a href="{{action('Admin\CompanyController@index')}}">Companies</a>
            <i class="fa fa-angle-right"></i>
            <a href="{{action('Admin\CompanyEmployeeController@index',$company->id)}}">Employees</a>
            <i class="fa fa-angle-right"></i>
            <span>{{ $employee->name }}</span>
        </h2>
    </div>
@endsection

@section('left')
    @include('admin.module.company.employee.edit',['company'=>$company,'employee'=>$employee])
@endsection

@section('right')
<div class="panel panel-default">
    <div class="panel-heading">
        <h1>{{ $employee->name }} </h1>
    </div>
</div>
<div class="panel-body" style="padding: 0;">
    <table class="table table-user-information">
        <tbody>
        <tr>
            <th>Name</th>
            <td><span class="title">{{ $employee->name }}</span></td>
        </tr>
        <tr>
            <th>Holiday</th>
            <td><span class="title">{{ $employee->holidays }}</span></td>
        </tr>
        </tbody>
    </table>
</div>
<div class="panel-footer ">
    <a href="#" data-link="{{ action('Admin\CompanyEmployeeController@destroy',[$company->id,$employee->id]) }}" data-target="#deleteModalBox" data-original-title="Delete Company" data-toggle="modal" type="button" class="btn btn-sm btn-danger"><i class="fa fa-2x fa-remove"></i></a>
</div>
@include('admin.partials.delete-modal',['info' => 'Remove Service'])

@endsection
