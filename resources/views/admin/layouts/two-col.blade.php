@extends('admin.layouts.default')

@section('content')
    <div class="col-md-4 main">
        <div class=" content-top-1">
            @yield('left')
        </div>
    </div>
    <div class="col-md-8 main">
        <div class="content-top-1">
            @yield('right')
        </div>
    </div>
@endsection
