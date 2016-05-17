<select name="{{ $name }}" id="{{ $name }}" class="form-control" data-container="body" {{ isset($multiple) ? 'multiple' : '' }}>
    <option value="">Select {{ucfirst($name)}}</option>
    @foreach($items as $item)
        <option value="{{$item}}"
                @if(isset($selected) && $selected == $item)
                selected="selected"
                @elseif( Form::getValueAttribute($name) == $item)
                selected="selected"
                @endif
        >{{ ucfirst($item) }}</option>
    @endforeach
</select>