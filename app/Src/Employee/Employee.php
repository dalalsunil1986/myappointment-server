<?php

namespace App\Src\Employee;

use App\Core\BaseModel;
use App\Src\Company\Company;

class Employee extends BaseModel
{

    protected $table = 'employees';
    protected $guarded = ['id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}

