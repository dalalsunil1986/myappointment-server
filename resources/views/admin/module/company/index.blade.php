@extends('admin.layouts.two-col')

@section('breadcrumb')
    <div class="banner">
        <h2>
            <a href="/admin">Home</a>
            <i class="fa fa-angle-right"></i>
            <span>Companies</span>
        </h2>
    </div>
@endsection

@section('js')
    @parent
    @include('admin.partials.map-address-picker',['record'=>null])
@endsection

@section('left')
    @include('admin.module.company.add')
@endsection

@section('right')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>Companies</h1>
        </div>
    </div>
    <div class="panel-body" style="padding: 0;">
        <table class="table table-striped table-bordered table-hover" >
            <thead class="bg-blue">
            <tr>
                <th>Name</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($companies as $company)
                <tr class="gradeU">
                    <td>
                        <a href="{{ action('Admin\CompanyController@show',$company->id)}}">{{ $company->name }} </a>
                    </td>
                    <td class="f18">
                        <a href="{{ action('Admin\CompanyController@show',$company->id)  }}"
                           role="button" >
                            <i class="fa fa-list-alt"></i>
                        </a>
                    </td>
                    <td class="f18">
                        <a href="{{ action('Admin\CompanyController@edit',$company->id)  }}"
                           role="button">
                            <i class="fa fa-pencil-square-o "></i>
                        </a>
                    </td>
                    <td class="f18">
                        <a href="#" class="red" data-toggle="modal" data-target="#deleteModalBox"
                           data-link="{{action('Admin\CompanyController@destroy',$company->id)}}">
                            <i class="fa fa-close "></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @include('admin.partials.delete-modal',['info' => 'This will delete company and related records (employees,services) etc .'])
    </div>

@endsection
