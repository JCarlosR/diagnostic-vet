<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class System extends Model
{
	use SoftDeletes;
	
	public function species()
    {
        return $this->belongsTo(Species::class);
    }

    public function diseases()
    {
        return $this->belongsToMany(Disease::class)->orderBy('name', 'asc');
    }

	public function getPhotoRouteAttribute()
    {        
        return '/images/systems/'.$this->id.'.'.$this->photo;
    }
}
