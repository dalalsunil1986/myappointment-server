<?php

namespace App\Src\Company;

use App\Core\BaseModel;
use App\Src\Service\Service;

class CompanyService extends BaseModel
{
    protected $table = 'company_services';
    protected $guarded = ['id'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
