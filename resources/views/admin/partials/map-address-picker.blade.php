<link href="/adminpanel/css/jquery-ui/all.css" rel="stylesheet">
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script src="/adminpanel/js/jquery-ui.min.js"> </script>
<script src="/adminpanel/js/address.picker.js"></script>
<script>
    var latitude = '{{ is_object($record) && isset($record->latitude)  ? $record->latitude : '29.357' }}';
    var longitude = '{{ is_object($record) && isset($record->latitude)  ? $record->longitude : '47.951' }}';
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
            lat:      "#latitude",
            lng:      "#longitude",
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