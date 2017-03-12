<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    protected $fillable = ['name','description'];

    public function getPhotoRouteAttribute()
    {        
        return '/images/species/'.$this->id.'.'.$this->photo;
    }
}

