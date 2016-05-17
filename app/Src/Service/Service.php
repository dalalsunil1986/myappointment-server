<?php

namespace App\Src\Service;

use App\Core\BaseModel;
use App\Src\Appointment\Appointment;
use App\Src\Company\Company;

class Service extends BaseModel
{

    protected $table = 'services';
    protected $guarded = ['id'];

    public function companies()
    {
        return $this->belongsToMany(Company::class,'company_services');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

}
