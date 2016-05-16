@extends('admin.layouts.default')
@section('content')
    <div class="col-md-4 ">
        @yield('left')
    </div>
    <div class="col-md-8 content-top-2">
        @yield('right')
    </div>
@endsection
