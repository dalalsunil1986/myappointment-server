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
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script src="/adminpanel/js/address.picker.js"></script>
    <script>

        {{--$(function () {--}}
            {{--var latitude = '{{ $company->latitude ? : '29.357' }}';--}}
            {{--var longitude = '{{ $company->longitude ? : '47.951' }}';--}}

            {{--get_map(latitude, longitude);--}}

            {{--var addresspickerMap = $("#addresspicker_map").addresspicker({--}}
                {{--updateCallback: showCallback,--}}
                {{--elements: {--}}
                    {{--map: "#map",--}}
                    {{--lat: "#latitude",--}}
                    {{--lng: "#longitude"--}}
                {{--},--}}
            {{--});--}}
            {{--var gmarker = addresspickerMap.addresspicker("marker");--}}
            {{--gmarker.setVisible(true);--}}
            {{--addresspickerMap.addresspicker("updatePosition");--}}

            {{--function showCallback(geocodeResult, parsedGeocodeResult) {--}}
                {{--$('#callback_result').text(JSON.stringify(parsedGeocodeResult, null, 4));--}}
            {{--}--}}

            {{--$('#reverseGeocode').change(function () {--}}
                {{--$("#addresspicker_map").addresspicker("option", "reverseGeocode", ($(this).val() === 'true'));--}}
            {{--});--}}

            {{--var map = addresspickerMap;--}}
            {{--google.maps.event.addListener(map, 'idle', function(){--}}
                {{--$('#zoom').val(map.getZoom());--}}
            {{--});--}}
        {{--});--}}


        var latitude = '{{ $company->latitude ? : '29.357' }}';
        var longitude = '{{ $company->longitude ? : '47.951' }}';
        var addresspickerMap = $( "#addresspicker_map" ).addresspicker({
            regionBias: "kw",
            updateCallback: showCallback,
            mapOptions: {
                zoom: 11,
                center: new google.maps.LatLng(latitude, longitude),
                scrollwheel: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            },
            elements: {
                map:      "#map",
                lat:      "#lat",
                lng:      "#lng",
            }
        });

        var gmarker = addresspickerMap.addresspicker( "marker");
        gmarker.setVisible(true);
        addresspickerMap.addresspicker( "updatePosition");

        $('#reverseGeocode').change(function(){
            $("#addresspicker_map").addresspicker("option", "reverseGeocode", ($(this).val() === 'true'));
        });

        function showCallback(geocodeResult, parsedGeocodeResult){
            $('#callback_result').text(JSON.stringify(parsedGeocodeResult, null, 4));
        }
        // Update zoom field
        var map = $("#addresspicker_map").addresspicker("map");
        google.maps.event.addListener(map, 'idle', function(){
            $('#zoom').val(map.getZoom());
        });
    </script>
@endsection

@section('middle')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>
                Edit : {{ $company->name }}
            </h1>
        </div>
    </div>
    <div class="panel-body" style="padding: 0 0 15px 0">
        @include('admin.module.company.edit-form',['company'=>$company,'cities'=>$cities,'timings'=>$timings])
    </div>

@endsection
