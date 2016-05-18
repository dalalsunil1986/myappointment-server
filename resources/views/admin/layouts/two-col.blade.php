@extends('admin.layouts.default')

@section('content')
    <div class="col-md-5 main">
        <div class=" content-top-1">
            @yield('left')
        </div>
    </div>
    <div class="col-md-7 main">
        <div class="content-top-1">
            @yield('right')
        </div>
    </div>
@endsection
