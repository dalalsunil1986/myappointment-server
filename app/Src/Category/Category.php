<?php

namespace App\Src\Category;

use App\Core\BaseModel;

class Category extends BaseModel
{

    protected $table = 'categories';
    protected $guarded = ['id'];
    public $timestamps = false;

}
