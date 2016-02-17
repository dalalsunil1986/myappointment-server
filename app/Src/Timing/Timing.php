<?php

namespace App\Src\Timing;

use Illuminate\Database\Eloquent\Model;

class Timing extends Model
{

    protected $table = 'timings';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function companyServices()
    {
        return $this->belongsTo(CompanyService::class,'company_service_id');
    }

}
