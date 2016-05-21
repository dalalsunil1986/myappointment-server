<div>
    <h1>Edit Service</h1>
    {!! Form::model($service,['action' => ['Admin\ServiceController@update',$service->id], 'method' => 'patch'], ['class'=>'']) !!}
    <div class="form-group" style="padding-top: 20px">
        <label for="name">Service Name</label>
        {!! Form::text('name_en',null,['class'=>'form-control','placeholder'=>'Service Name']) !!}
    </div>
    <div class="form-group">
        <label for="companyAddress">Service Description</label>
        {!! Form::textarea('description_en',null,['class'=>'form-control','placeholder'=>'Service Description','rows'=>3]) !!}
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success" style="width: 100%">Save</button>
        {!! Form::close() !!}
    </div>
</div>