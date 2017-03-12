<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Disease;
use App\Symptom;
use App\DiseaseSymptom;

class DiseaseController extends Controller
{
    public function index()
    {
    	$diseases = Disease::get();
    	return view('disease.index')->with(compact('diseases'));
    }
    
    public function store(Request $request)
    {
        // $this->validate($request, Project::$rules,Project::$messages);
        Disease::create($request->all());
        return back();
    }
     public function edit($id)
    {
    	$diseases=Disease::find($id);  

    	$assigned_symptoms=DiseaseSymptom::where('disease_id',$id)->get();//asignados

    	$assigned_symptoms_array=DiseaseSymptom::where('disease_id',$id)->pluck('symptom_id');
    	
    	$number_assigned=count($assigned_symptoms_array);
		    	
    	if ($number_assigned == 0) {      		  		
    		$unassigned_symptoms=Symptom::all();//No asignados  		
    	}else{
    		$unassigned_symptoms=Symptom::whereNotIn('id',$assigned_symptoms_array)->get();//No asignados	
    		// dd($unassigned_symptoms);
    	}	
    	
    	return view('disease.edit')->with(compact('diseases','unassigned_symptoms','assigned_symptoms'));
    }
    public function update($id, Request $request)
    {
        // $this->validate($request, Project::$rules,Project::$messages);
        Disease::find($id)->update($request->all());
        return back()->with('notification','La edicion de ha dado correctamente');
    
    }
}
