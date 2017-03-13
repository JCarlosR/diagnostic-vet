<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    protected $fillable = ['name','description'];

    public function getReviewShortAttribute(){
    	return mb_strimwidth($this->review, 0, 70,'...');
    }
}

