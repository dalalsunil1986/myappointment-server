<?php

namespace App\Src\Service;

use App\Src\Company\Company;
use App\Src\Photo\PhotoTrait;
use App\Src\Photo\ThumbnailTrait;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $table = 'services';
    protected $guarded = ['id'];
    public $timestamps = false;

}
