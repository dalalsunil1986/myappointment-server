<?php

namespace App\Src\User;

use App\Src\Appointment\Appointment;
use App\Src\Company\Company;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $guarded = ['id'];
    protected $hidden = ['password', 'remember_token','pivot'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class,'company_users');
    }

    public function favorites()
    {
        return $this->belongsToMany(Company::class,'favorites');
    }

}
