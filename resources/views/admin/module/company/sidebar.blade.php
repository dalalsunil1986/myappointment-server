<div class="list-group list-group-alternate">
    <a class="list-group-item {{ $active == 'info' ? 'active' : '' }}"  href="{{ action('Admin\CompanyController@show',$record->id) }}" ><i class="fa fa-inbox"></i>&nbsp;Info</a>
    <a class="list-group-item {{ $active == 'services' ? 'active' : '' }}" href="{{ action('Admin\CompanyServiceController@index',['companyID'=>$record->id])  }}" ><i class="fa fa-exchange"></i>&nbsp;Services</a>
    <a class="list-group-item {{ $active == 'employees' ? 'active' : '' }}" href="{{ action('Admin\CompanyEmployeeController@index',['companyID'=>$record->id])  }}" ><i class="fa fa-users"></i>&nbsp;Employees</a>
    <a class="list-group-item {{ $active == 'appointments' ? 'active' : '' }}" href="{{ action('Admin\CompanyAppointmentController@index',['companyID'=>$record->id])  }}" ><i class="fa fa-clock-o"></i>&nbsp;Appointments</a>
</div>