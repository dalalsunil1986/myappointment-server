<div>
    <h1>Add Employee</h1>
    {!! Form::open(['action' => ['Admin\CompanyEmployeeController@store',$company->id], 'method' => 'post'], ['class'=>'']) !!}

    <div class="form-group" style="padding-top: 20px">
        <label for="name">Employee Name</label>
        {!! Form::text('name_en',null,['class'=>'form-control','placeholder'=>'Employee Name']) !!}
    </div>

    <div class="form-group">
        <label for="companyAddress">Weekly holiday</label>
        {!! Form::text('holidays',null,['class'=>'form-control','placeholder'=>'Weekly Holiday (ex: Friday )']) !!}
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success" style="width: 100%">Save</button>
        {!! Form::close() !!}
    </div>
</div>
