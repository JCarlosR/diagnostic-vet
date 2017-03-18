<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class System extends Model
{
	use SoftDeletes;
    public function getPhotoRouteAttribute()
    {        
        return '/images/systems/'.$this->id.'.'.$this->photo;
    }
}
