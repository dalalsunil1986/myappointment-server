<div>
    <h1>Edit Service</h1>
    {!! Form::model($record,['action' => ['Admin\CompanyServiceController@update',$record->company->id,$record->id], 'method' => 'patch'], ['class'=>'']) !!}

    <div class="form-group" style="padding-top:20px">
        <label for="companyDescription">Service Description</label>
        {!! Form::textarea('description_en',null,['class'=>'form-control','placeholder'=>'Service Description','rows'=>3]) !!}
    </div>

    <div class="form-group">
        <label for="companyAddress">Price (ex: 10 )</label>
        {!! Form::text('price',null,['class'=>'form-control','placeholder'=>'Price for the Service (ex: 100.00 or 100) in KWD ']) !!}
    </div>

    <div class="form-group">
        <label for="companyAddress">Duration</label>
        @include('admin.partials.form-dropdown',['selected'=>$record->duration_en,'items'=>$durations, 'name'=>'duration_en'])
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success" style="width: 100%">Save</button>
        {!! Form::close() !!}
    </div>

</div>