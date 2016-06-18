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

@section('js')
    @parent
    @include('admin.partials.map-address-picker',['record'=>$company])
@endsection

@section('middle')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1> Edit : {{ $company->name }} </h1>
        </div>
    </div>
    <div class="panel-body" style="padding: 0 0 15px 0">
        @include('admin.module.company.edit-form',['company'=>$company,'cities'=>$cities,'timings'=>$timings])
    </div>
@endsection
