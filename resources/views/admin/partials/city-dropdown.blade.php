<?php
$cities = [
        'salmiya',
        'hawally',
        'jahra',
        'qortuba'
];
?>
<select name="city_en" id="city_en" class="form-control" data-container="body">
    <option value="">Select City</option>
    @foreach($cities as $city)
        <option value="{{$city}}"
                @if(isset($selected) && $selected == $city)
                selected="selected"
                @elseif( Form::getValueAttribute('city_en') == $city)
                selected="selected"
                @endif
        >{{ ucfirst($city) }}</option>
    @endforeach
</select>