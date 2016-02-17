<?php

namespace App\Src\Company;

use App\Core\BaseModel;
use App\Src\Appointment\Appointment;
use App\Src\Category\Category;
use App\Src\Employee\Employee;
use App\Src\Service\Service;
use App\Src\User\User;

class Company extends BaseModel
{

    protected $table = 'companies';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsToMany(User::class,'user_companies');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,'company_categories');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class,'company_services');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function holidays()
    {
        return $this->hasMany(Holiday::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

}
