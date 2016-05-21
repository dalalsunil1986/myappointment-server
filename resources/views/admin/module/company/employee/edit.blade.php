<div>
    <h1>Edit Employee</h1>
    {!! Form::model($employee,['action' => ['Admin\CompanyEmployeeController@update',$company->id,$employee->id], 'method' => 'patch'], ['class'=>'']) !!}

    <div class="form-group">
        <label for="name">Name</label>
        {!! Form::text('name_en',null,['class'=>'form-control','placeholder'=>'Employee Name']) !!}
    </div>

    <div class="form-group">
        <label for="name">Holidays</label>
        {!! Form::text('holidays',null,['class'=>'form-control','placeholder'=>'Holidays']) !!}
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success" style="width: 100%">Save</button>
        {!! Form::close() !!}
    </div>

</div>