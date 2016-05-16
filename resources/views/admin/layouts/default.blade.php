<!DOCTYPE HTML>
<html>
<head>
    <title>My Appointment Admin panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />

    @section('css')
        <link href="/adminpanel/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
        <link href="/adminpanel/css/font-awesome.css" rel="stylesheet">
        <link href="/adminpanel/css/style.css" rel='stylesheet' type='text/css' />
        <link href="/adminpanel/css/custom.css" rel="stylesheet">
    @show

</head>
<body>

<div id="wrapper">
    <!----->
    @include('admin.partials.left-sidebar')
    <div id="page-wrapper" class="gray-bg dashbard-1">

        <div class="content-main">
            @include('admin.partials.breadcrumb')

            <div class="content-top" >

                @section('content')

                @show

                <div class="clearfix"> </div>

            </div>

            @include('admin.partials.footer')

        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<!---->
@section('js')
    <script src="/adminpanel/js/jquery.min.js"> </script>
    <script src="/adminpanel/js/bootstrap.min.js"> </script>
    <script src="/adminpanel/js/jquery.metisMenu.js"></script>
    <script src="/adminpanel/js/jquery.slimscroll.min.js"></script>
    <script src="/adminpanel/js/custom.js"></script>
    <script src="/adminpanel/js/jquery.nicescroll.js"></script>
    <script src="/adminpanel/js/scripts.js"></script>
@show
</body>
</html>

