<?php

namespace App\Http\Controllers\Api;

use App\Disease;
use App\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiseaseController extends Controller
{
    public function all() {
        $diseases = Disease::all();
        return $diseases;
    }

    public function bySystem($id) {
        $diseases = System::find($id)->diseases;
        return $diseases;
    }

    public function bySpecies($id) {
        $diseases = Disease::where('species_id', $id)->get();
        return $diseases;
    }
}
