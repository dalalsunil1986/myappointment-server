<?php

namespace App\Src\Appointment;

use App\Core\BaseModel;

class Appointment extends BaseModel
{

    protected $table = 'appointments';
    protected $guarded = ['id'];

}
