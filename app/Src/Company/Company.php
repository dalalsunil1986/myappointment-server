<?php

namespace App\Src\Company;

use App\Core\BaseModel;
use App\Src\Appointment\Appointment;
use App\Src\Category\Category;
use App\Src\Employee\Employee;
use App\Src\Service\Service;
use App\Src\User\User;
use Illuminate\Support\Facades\Auth;

class Company extends BaseModel
{

    protected $table = 'companies';
    protected $guarded = ['id'];
    protected $hidden = ['pivot'];

    public function users()
    {
        return $this->belongsToMany(User::class,'company_users');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,'company_categories');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class,'company_services')->withPivot(['price','duration_en','description_en'])->withTimestamps()->latest();
    }

    public function service()
    {
        return $this->belongsTo(Service::class,'company_services')->withPivot(['price','duration_en','description_en'])->withTimestamps()->latest();
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

    public function favorites()
    {
        return $this->belongsToMany(User::class,'favorites');
    }

}
