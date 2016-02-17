<?php

namespace App\Src\Appointment;

use App\Core\BaseModel;
use App\Src\Company\Company;
use App\Src\Employee\Employee;
use App\Src\Service\Service;
use App\Src\Timing\Timing;
use App\Src\User\User;

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
