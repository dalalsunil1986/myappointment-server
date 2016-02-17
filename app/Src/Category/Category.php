<?php

namespace App\Src\Category;

use App\Core\BaseModel;
use App\Src\Company\Company;

class Category extends BaseModel
{

    protected $table = 'categories';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function companies()
    {
        return $this->belongsToMany(Company::class,'company_categories');
    }
}
