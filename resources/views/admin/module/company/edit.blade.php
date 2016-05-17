@extends('admin.layouts.one-col')

@section('breadcrumb')
    <div class="banner">
        <h2>
            <a href="/admin">Home</a>
            <i class="fa fa-angle-right"></i>
            <a href="{{action('Admin\CompanyController@index')}}">Companies</a>
            <i class="fa fa-angle-right"></i>
            <a href="{{action('Admin\CompanyController@show',$company->id)}}">{{ $company->name }}</a>
            <i class="fa fa-angle-right"></i>
            <span>Edit</span>
        </h2>
    </div>
@endsection

@section('middle')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>
                Edit : {{ $company->name }}
            </h1>
        </div>
    </div>
    <div class="panel-body">
        <div class="grid-form1">
            {{--<h3 id="forms-example" class="">Edit : {{ $company->name }}</h3>--}}
            {!! Form::model($company,['action' => ['Admin\CompanyController@update',$company->id], 'method' => 'patch'], ['class'=>'']) !!}

            <div class="form-group">
                    <label for="companyName">Company Name</label>
                    {!! Form::text('name_en',null,['class'=>'form-control','placeholder'=>'Company Name']) !!}
                </div>
                <div class="form-group">
                    <label for="companyDescription">Company Description</label>
                    {!! Form::textarea('description_en',null,['class'=>'form-control','placeholder'=>'Company Description','rows'=>3]) !!}
                </div>
                <div class="form-group">
                    <label for="companyDescription">City</label>
                    @include('admin.partials.city-dropdown',['selected'=>$company->city_en])
                </div>

                <button type="submit" class="btn btn-success">Save</button>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="panel-footer ">
        <a href="#" data-link="{{ action('Admin\CompanyController@edit',$company->id) }}" data-target="#deleteModalBox" data-original-title="Delete Company" data-toggle="modal" type="button" class="btn btn-xs btn-danger"><i class="fa fa-3x fa-remove"></i></a>
    </div>
    @include('admin.partials.delete-modal',['info' => 'This will delete company and related records (employees,services) etc .'])

@endsection
