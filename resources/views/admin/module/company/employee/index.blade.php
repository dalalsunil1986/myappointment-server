@extends('admin.layouts.two-col')

@section('breadcrumb')
    <div class="banner">
        <h2>
            <a href="/admin">Home</a>
            <i class="fa fa-angle-right"></i>
            <a href="{{action('Admin\CompanyController@index')}}">Companies</a>
            <i class="fa fa-angle-right"></i>
            <a href="{{action('Admin\CompanyController@show',$company->id)}}">{{ $company->name }}</a>
            <i class="fa fa-angle-right"></i>
            <span>Employees</span>
        </h2>
    </div>
@endsection

@section('left')
    @include('admin.module.company.employee.create',['company'=>$company])
    <hr>
    @include('admin.module.company.sidebar',['active'=>'employees','record'=>$company])
@endsection

@section('right')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>{{ $company->name }} Employees</h1>
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
            @foreach($company->employees as $employee)
                <tr class="gradeU">
                    <td >
                        <span class="title"><a href="{{ action('Admin\CompanyEmployeeController@show',[$company->id,$employee->id]) }}">{{ $employee->name }}</a></span>
                    </td>
                    <td class="f18">
                        <a href="#" class="red" data-toggle="modal" data-target="#deleteModalBox"
                           data-link="{{action('Admin\CompanyEmployeeController@destroy',[$company->id,$employee->id])}}">
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
