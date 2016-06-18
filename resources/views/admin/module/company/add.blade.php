<div>
    <h1>Add Company</h1>
    <div class="form-group">
        <label for="companyName">Company Name</label>
        {!! Form::text('name_en',null,['class'=>'form-control','placeholder'=>'Company Name']) !!}
    </div>
    <div class="form-group">
        <label for="companyDescription">Company Description</label>
        {!! Form::textarea('description_en',null,['class'=>'form-control','placeholder'=>'Company Description','rows'=>3]) !!}
    </div>
    <div class="form-group">
        <label for="city">City</label>
        @include('admin.partials.form-dropdown',['items'=>$cities, 'name'=>'city_en'])
    </div>

    <div class="form-group">
        <label for="companyAddress">Company Address</label>
        <div class="map-wrapper">
            <div id="map" style="height: 400px;"></div>
            <div class="small">You can drag and drop the marker to the correct location</div>
            {!! Form::textarea('address_en',null,['id'=>'addresspicker_map','class'=>'form-control','placeholder'=>'Type the Street Address or drag and drop the map marker to the correct location','rows'=>2]) !!}
            {{ Form::hidden('latitude',null, array('id' => 'latitude')) }}
            {{ Form::hidden('longitude',null, array('id' => 'longitude')) }}
        </div>
    </div>

    <div class="form-group">
        <label for="companyAddress">Opens at</label>
        @include('admin.partials.form-dropdown',['items'=>$timings,'name'=>'opens_at'])
    </div>

    <div class="form-group">
        <label for="companyAddress">Closes at</label>
        @include('admin.partials.form-dropdown',['items'=>$timings,'name'=>'closes_at'])
    </div>

    <div class="form-group">
        <label for="companyAddress">Weekly holiday</label>
        {!! Form::text('holidays',null,['class'=>'form-control','placeholder'=>'Weekly Holiday (ex: Friday afternoon']) !!}
    </div>

    <div class="form-group">
        <label for="image">Company Logo</label>
        <input name="image" type="file" id="image">
    </div>

    <hr>
    <h2>Social Accounts </h2>
    <div class="input-group" style="padding-top:20px">
        <span class="input-group-addon">
            <i class="fa fa-instagram social-icon"></i>
        </span>
        {!! Form::text('instagram',null,['class'=>'form-control','placeholder'=>'Instagram Username (ex:huffington)']) !!}
    </div>
    <div class="input-group">
        <span class="input-group-addon">
            <i class="fa fa-facebook social-icon"></i>
        </span>
        {!! Form::text('facebook',null,['class'=>'form-control','placeholder'=>'Facebook Profile ID (ex:huffington)']) !!}

    </div>
    <div class="input-group">
        <span class="input-group-addon">
            <i class="fa fa-twitter social-icon"></i>
        </span>
        {!! Form::text('twitter',null,['class'=>'form-control','placeholder'=>'Twitter Username (ex:huffington)']) !!}
    </div>

    <div class="input-group">
        <span class="input-group-addon">
            <i class="fa fa-snapchat social-icon"></i>
        </span>
        {!! Form::text('snapchat',null,['class'=>'form-control','placeholder'=>'Snapchat Username (ex:huffington)']) !!}
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success" style="width: 100%">Save</button>
    </div>
</div>