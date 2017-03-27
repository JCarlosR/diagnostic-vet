<?php

namespace App\Http\Controllers\Api;

use App\Disease;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiseaseController extends Controller
{
    function all() {
        $diseases = Disease::all();
        return $diseases;
    }
}
