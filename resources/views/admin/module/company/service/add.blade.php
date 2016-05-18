<div>
    <h1>Add Service</h1>
    {!! Form::open(['action' => ['Admin\CompanyServiceController@store',$company->id], 'method' => 'post'], ['class'=>'']) !!}
    <div class="form-group" style="padding-top: 20px">
        <select name="service" class="col-md-12 select2 multiselect multiselect-inverse" >
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
        <label for="companyDescription">Service Description</label>
        {!! Form::textarea('description_en',null,['class'=>'form-control','placeholder'=>'Service Description','rows'=>3]) !!}
    </div>

    <div class="form-group">
        <label for="companyAddress">Price (ex: 10 )</label>
        {!! Form::text('price',null,['class'=>'form-control','placeholder'=>'Price for the Service (ex: 100.00 or 100) in KWD ']) !!}
    </div>

    <div class="form-group">
        <label for="companyAddress">Duration</label>
        @include('admin.partials.form-dropdown',['items'=>$durations, 'name'=>'duration_en'])
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success" style="width: 100%">Save</button>
        {!! Form::close() !!}
    </div>

</div>