<?php

namespace App\Src\Timing;

use App\Core\BaseModel;
use App\Src\Appointment\Appointment;

class Timing extends BaseModel
{

    protected $table = 'timings';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

}
