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
            <span>Appointments</span>
        </h2>
    </div>
@endsection

{{--@section('left')--}}
{{--@include('admin.module.company.sidebar',['active'=>'appointments','record'=>$company])--}}
{{--@endsection--}}

@section('middle')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>{{ $company->name }} Appointments</h1>
        </div>
    </div>
    <div class="panel-body" style="padding: 0;">

        <div class="dropdown" style="margin-bottom: 20px;" >
            <a href="#" title="" class="btn btn-default" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-cog icon_8"></i>
                <i class="fa fa-chevron-down icon_8"></i>
                <div class="ripple-wrapper"></div></a>
            <ul class="dropdown-menu float-right">
                <li>
                    <a href="{{ action('Admin\CompanyAppointmentController@index',[$company->id,'type'=>'all']) }}" >
                        <i class="fa fa-pencil-square-o icon_9"></i>
                        All
                    </a>
                </li>
                <li>
                    <a href="{{ action('Admin\CompanyAppointmentController@index',[$company->id,'type'=>'past']) }}" >
                        <i class="fa fa-calendar icon_9"></i>
                        Past
                    </a>
                </li>
                <li>
                    <a href="{{ action('Admin\CompanyAppointmentController@index',[$company->id,'type'=>'upcoming']) }}" >
                        <i class="fa fa-download icon_9"></i>
                        Upcoming
                    </a>
                </li>

            </ul>
        </div>

        <table class="table table-striped table-bordered table-hover table-responsive" >
            <thead class="bg-blue">
            <tr>
                <th>Name</th>
                <th>Service</th>
                <th>Employee</th>
                <th>Date</th>
                <th>Time</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($appointments as $appointment)
                <tr class="gradeU">
                    <td ><span class="title">{{ $appointment->user->name_en }}</span></td>
                    <td ><span class="title">{{ $appointment->service->name }}</span></td>
                    <td ><span class="title">{{ $appointment->employee->name }}</span></td>
                    <td ><span class="title">{{ $appointment->date }}</span></td>
                    <td ><span class="title">{{ $appointment->timing->time_en }}</span></td>
                    <td class="f18">
                        <a href="#" class="red" data-toggle="modal" data-target="#deleteModalBox"
                           data-link="{{action('Admin\CompanyAppointmentController@destroy',[$company->id,$appointment->id])}}">
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
