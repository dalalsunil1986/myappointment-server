<?php

namespace App\Src\Company;

use App\Core\BaseModel;

class Holiday extends BaseModel
{
    protected $table = 'holidays';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
