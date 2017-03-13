<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiseaseSystem extends Model
{
    protected $table='disease_system';

    public function disease() {
        return $this->belongsTo('App\Disease');
    }

    public function system() {
        return $this->belongsTo('App\System');
    }
}
