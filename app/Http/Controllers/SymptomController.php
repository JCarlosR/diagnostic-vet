<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Symptom;

class SymptomController extends Controller
{
    public function store(Request $request)
    {
    	// dd($request);
    	// dd("rico :3");
        // $this->validate($request, Project::$rules,Project::$messages);
        // Symptom::create($request->all());
        $symptom = new Symptom();
        $symptom-> name=$request->input('name');
		$symptom->save();
        return back();
    }
    public function update(Request $request)
    {
        // dd($request);
        // dd("rico :3");
        // $this->validate($request, Project::$rules,Project::$messages);
        // Symptom::create($request->all());
        $symptom_id=$request->input('id');
        $symptom = Symptom::find($symptom_id);
        $symptom->name=$request->input('name');
        $symptom->save();
        
        return back();
    }
}
