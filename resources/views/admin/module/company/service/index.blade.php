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
            <span>Services</span>
        </h2>
    </div>
@endsection

@section('left')
    <div>
        <h1>Add Services</h1>
        {!! Form::open(['action' => ['Admin\CompanyServiceController@updateService',$company->id], 'method' => 'post'], ['class'=>'']) !!}
        <div class="form-group" style="padding-top: 20px">
            <select name="services[]" class="col-md-12 select2 multiselect multiselect-inverse" multiple>
                @foreach($services as $service)
                    <option value="{{ $service->id }}"
                            @if(in_array($service->id, $company->services->modelKeys()))
                            selected="selected"
                            @endif
                    >{{ $service->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success" style="width: 100%">Save</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('right')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>{{ $company->name }} Services</h1>
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
            @foreach($company->services as $service)
                <tr class="gradeU">
                    <td >
                        <span class="title">{{ $service->name }}</span>
                    </td>
                    <td class="f18">
                        <a href="#" class="red" data-toggle="modal" data-target="#deleteModalBox"
                           data-link="{{action('Admin\CompanyServiceController@destroy',[$company->id,$service->id])}}">
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
