<?php

namespace App\Src\Company;

use App\Core\BaseModel;
use App\Src\Appointment\Appointment;
use App\Src\Category\Category;
use App\Src\Employee\Employee;
use App\Src\Service\Service;
use App\Src\User\User;
use Illuminate\Support\Facades\Auth;

class CompanyService extends BaseModel
{
    protected $table = 'company_services';
    protected $guarded = ['id'];

}
