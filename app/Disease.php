<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disease extends Model
{
	use SoftDeletes;
    protected $fillable = ['name','description'];

    public function getReviewShortAttribute(){
    	return mb_strimwidth($this->review, 0, 70,'...');
    }
}

