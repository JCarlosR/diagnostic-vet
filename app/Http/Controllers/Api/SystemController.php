<?php

namespace App\Http\Controllers\Api;

use App\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SystemController extends Controller
{

    public function bySpecies(Request $request) {
        
        $systems = System::where('species_id', $request->input('species_id'))
            ->orderBy('name', 'asc')->get();

        return $systems;
    }

}
