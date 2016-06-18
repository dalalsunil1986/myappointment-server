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
        <link href="/node_modules/select2/dist/css/select2.min.css" rel="stylesheet">
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
            @section('breadcrumb')
                @include('admin.partials.breadcrumb')
            @show
            <div class="content-top" >

                @include('admin.partials.notifications')

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
    <script src="/node_modules/select2/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".select2").select2();
            $("[data-toggle=tooltip]").tooltip();
        });
        $(document).on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            if ( $( "#deleteModal" ).length ) {
                var link = button.data('link') // Extract info from data-* attributes
                $("#deleteModal").attr("action", link);
            }
        });
    </script>

@show
</body>
</html>

