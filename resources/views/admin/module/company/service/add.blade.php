<div>
    <h1>Add Services</h1>
    {!! Form::open(['action' => ['Admin\CompanyServiceController@store',$company->id], 'method' => 'post'], ['class'=>'']) !!}
    <div class="form-group" style="padding-top: 20px">
        <select name="services[]" class="col-md-12 select2 multiselect multiselect-inverse" multiple>
            @foreach($services as $service)
                <option value="{{ $service->id }}"
                        @if(in_array($service->id, $company->services->modelKeys()))
                        selected="selected"
                        @endif
                >{{ $service->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success" style="width: 100%">Save</button>
        {!! Form::close() !!}
    </div>
</div>