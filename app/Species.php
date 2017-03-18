<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Species extends Model
{
	use SoftDeletes;

    protected $fillable = ['name','description'];

    public function getPhotoRouteAttribute()
    {        
        return '/images/species/'.$this->id.'.'.$this->photo;
    }

}

