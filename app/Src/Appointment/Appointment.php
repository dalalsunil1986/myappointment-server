<?php

namespace App\Src\Appointment;

use App\Core\BaseModel;
use App\Src\Company\Company;
use App\Src\Company\CompanyService;
use App\Src\Employee\Employee;
use App\Src\Service\Service;
use App\Src\Timing\Timing;
use App\Src\User\User;
use Illuminate\Support\Facades\DB;

class Appointment extends BaseModel
{

    protected $table = 'appointments';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * @return mixed
     * get the meta (price, duration) from the pivot table for the given company and service
     */
    public function pivot()
    {
        return $this->belongsTo(CompanyService::class,'company_id','company_id')
            ->where('service_id',$this->service_id);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function timing()
    {
        return $this->belongsTo(Timing::class);
    }

    // status :[confirmed, pending, cancelled]
    public function scopeOfStatus($query, $status)
    {
        return $query->where('status', $status);
    }

}
