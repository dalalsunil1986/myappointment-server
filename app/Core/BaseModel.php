<?php
namespace App\Core;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    use LocaleTrait;

    protected $localeStrings = ['name','description','address','city'];

    public function getDates()
    {
        return ['created_at', 'deleted_at', 'updated_at', 'date'];
    }

    public function setSlugAttribute($value)
    {
        return $this->attributes['slug'] = slug($value);
    }

}