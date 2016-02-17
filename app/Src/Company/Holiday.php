<?php

namespace App\Src\Company;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $table = 'holidays';
    protected $guarded = ['id'];
    public $timestamps = false;

}
