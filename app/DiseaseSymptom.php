<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiseaseSymptom extends Model
{
	protected $table='disease_symptom';
    public function symptom(){
        return $this->belongsTo('App\Symptom');
    }
}
