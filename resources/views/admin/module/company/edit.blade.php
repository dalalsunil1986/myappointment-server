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
    <div class="panel-body" style="padding: 0 0 15px 0">
        <div class="grid-form1">
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
                <label for="city">City</label>
                @include('admin.partials.form-dropdown',['selected'=>$company->city_en,'items'=>$cities, 'name'=>'city_en'])
            </div>
            <div class="form-group">
                <label for="companyAddress">Company Address</label>
                {!! Form::textarea('address_en',null,['class'=>'form-control','placeholder'=>'Company Address','rows'=>3]) !!}
            </div>
            <div class="form-group">
                <label for="companyAddress">Opens at</label>
                @include('admin.partials.form-dropdown',['selected'=>$company->opens_at,'items'=>$timings,'name'=>'opens_at'])
            </div>

            <div class="form-group">
                <label for="companyAddress">Closes at</label>
                @include('admin.partials.form-dropdown',['selected'=>$company->closes_at,'items'=>$timings,'name'=>'closes_at'])
            </div>

            <div class="form-group">
                <label for="companyAddress">Weekly holiday</label>
                {!! Form::text('holidays',null,['class'=>'form-control','placeholder'=>'Weekly Holiday (ex: Friday afternoon']) !!}
            </div>

            <button type="submit" class="btn btn-success">Save</button>

            {!! Form::close() !!}
        </div>
    </div>

@endsection
