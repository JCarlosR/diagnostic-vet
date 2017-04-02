<?php

namespace App\Http\Controllers\Api;

use App\Species;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpeciesController extends Controller
{
    public function all()
    {
        return Species::all();
    }
}
