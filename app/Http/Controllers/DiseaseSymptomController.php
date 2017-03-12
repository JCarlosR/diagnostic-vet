<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DiseaseSymptom;

class DiseaseSymptomController extends Controller
{
    public function store(Request $request)
    {
    	//el nivel pertenzenca al proyecto
    	//asegurar que el proy exista
    	//asegurar que el nivel exista
    	//asegurar que el usuario exi
    	
    	$disease_id = $request->input('disease_id');
    	$symptom_id = $request->input('symptom_id'); 	

    	$disease_symptom = new DiseaseSymptom();
    	$disease_symptom->disease_id = $disease_id;
    	$disease_symptom->symptom_id = $symptom_id;

    	$disease_symptom->save();
    	return back();   
    }
     public function delete(Request $request)
    {
        $id = $request->input('id');
        return $id;
        
    }
}
