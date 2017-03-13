<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    public function getPhotoRouteAttribute()
    {        
        return '/images/systems/'.$this->id.'.'.$this->photo;
    }
}
