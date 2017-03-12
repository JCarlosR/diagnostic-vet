<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Species;

class SystemController extends Controller
{
    public function index($id)
    {
    	$species = Species::find($id);
        return view('systems.index')->with(compact('species'));
    }
    public function store(Request $request)
    {
    	
    }
}
