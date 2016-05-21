@extends('admin.layouts.one-col')

@section('breadcrumb')
    <div class="banner">
        <h2>
            <a href="/admin">Home</a>
            <i class="fa fa-angle-right"></i>
            <span>Users</span>
        </h2>
    </div>
@endsection

@section('middle')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>Users</h1>
        </div>
    </div>
    <div class="panel-body" style="padding: 0;">
        <table class="table table-striped table-bordered table-hover" >
            <thead class="bg-blue">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Registered Date</th>
                <th>Manages Company ? </th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="gradeU">
                    <td>
                        <a href="{{ action('Admin\UserController@show',$user->id)}}">{{ $user->name_en }} </a>
                    </td>
                    <td class="f18">{{ $user->email }}</td>
                    <td class="f18">{{ $user->created_at->format('d-m-Y') }}</td>
                    <td class="f18">{{ $user->hasCompany }}</td>
                    <td class="f18">
                        <a href="#" class="red" data-toggle="modal" data-target="#deleteModalBox"
                           data-link="{{action('Admin\UserController@destroy',$user->id)}}">
                            <i class="fa fa-close "></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @include('admin.partials.delete-modal',['info' => 'Delete User'])
    </div>

@endsection
