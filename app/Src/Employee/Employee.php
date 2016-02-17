<?php

namespace App\Src\Employee;

use App\Core\BaseModel;

class Employee extends BaseModel
{

    protected $table = 'employees';
    protected $guarded = ['id'];

}

