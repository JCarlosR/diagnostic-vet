<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Symptom;
use App\System;
use App\Species;
use App\Disease;

use App\DiseaseSystem;
use App\DiseaseSymptom;

class DiseaseController extends Controller
{
    public function index($id)//id del sistema
    {
        $sistema = System::where('id',$id)->first();//arreglo del sistema correspondiente al id

       
        $species_system = Species::where('id',$sistema->species_id)->first();
        
        $systems_species = System::where('species_id',$sistema->species_id)->get();

        $diseases_system = DiseaseSystem::where('system_id',$id)->get();
        // dd($diseases_system);
        
        $system = System::find($id);

        $symptoms = Symptom::all();
        
        return view('disease.index')->with(compact(
            'system','species_system','systems_species','diseases_system', 'symptoms'
        ));
    	
    	
    }
    
    public function store(Request $request)
    {
        // dd($request->all());
        // dd($symptopms);

        // Guardamos en la bd una nueva enfermedad
        $disease = new Disease();
        $disease->name = $request->input('name');
        $disease->review = $request->input('review');
        $disease->exams = $request->input('exams');
        $disease->treatment = $request->input('treatment');
        $disease->species_id = $request->input('species_id');
        $saved = $disease->save();

        // Si se guardó la enfermedad
        if ($saved) {
            // Registramos los sistemas asociados
            $system_ids = $request->input('systems');
            foreach ($system_ids as $system_id) {   
                $diseaseSystem = new DiseaseSystem();
                $diseaseSystem->disease_id = $disease->id;
                $diseaseSystem->system_id = $system_id;
                $diseaseSystem->save();
            }    

            // Y los síntomas asociados
            $symptopms = explode(",", $request->input('symptoms'));
            foreach ($symptopms as $symptom_name) {
                $diseaseSymptom = new DiseaseSymptom();
                $diseaseSymptom->disease_id = $disease->id;
                $symptom = Symptom::firstOrCreate([
                    'name' => $symptom_name
                ]);
                $diseaseSymptom->symptom_id = $symptom->id;
                $diseaseSymptom->save();
            }
        }
        
        return back();
    }


    public function edit($id, $id_disease)
    {
        
        $sistema = System::where('id',$id)->first();//arreglo del sistema correspondiente al id
       
        $species_system = Species::where('id',$sistema->species_id)->first();
        
        $diseases = Disease::where('species_id',$sistema->species_id)->get();
        
        $system = System::find($id);

        // obteniendo enfermedad
        $diseases = Disease::find($id_disease);

        // Sistemas afectados
        $diseaseSystems = DiseaseSystem::where('disease_id', $id_disease)->pluck('system_id');
        $diseaseSystems = $diseaseSystems->toArray();
        // Sistemas asociados con la especie
        $systems = System::where('species_id', $system->species_id)->get();
        // Marcamos los sistemas que ya están seleccionados
        foreach ($systems as $system) {
            if (in_array($system->id, $diseaseSystems))
                $system->checked = true;
            else
                $system->checked = false;
        }
        

        // Todos los sintomas
        $symptoms = Symptom::all();

        // Síntomas escogidos
        $diseaseSymptoms = DiseaseSymptom::where('disease_id', $id_disease)->pluck('symptom_id');
        // dd($diseaseSymptoms);
        if (sizeof($diseaseSymptoms) > 0)
            $chips = Symptom::whereIn('id', $diseaseSymptoms)->get();
        else $chips = [];
        // dd($chips);

        return view('disease.edit')->with(compact(
            'system','species_system','diseases', 'systems', 

            // Sintomas: todos y los escogidos
            'symptoms', 'chips'
        ));
    }


    public function update($id, Request $request)
    {
        
        // dd($id);
        // Guardamos en la bd una nueva enfermedad
        $disease = Disease::find($id);
        $disease->name = $request->input('name');
        $disease->review = $request->input('review');
        $disease->exams = $request->input('exams');
        $disease->treatment = $request->input('treatment');
        
        $saved = $disease->save();

        //eliminamos los sistemas asociados
        DiseaseSystem::where('disease_id',$id)->delete();
        DiseaseSymptom::where('disease_id',$id)->delete();
        
        // Si se guardó la enfermedad
        if ($saved) {

            // Registramos los sistemas asociados
            $system_ids = $request->input('systems');

            if ($system_ids > 0) {
                foreach ($system_ids as $system_id) {   
                $diseaseSystem = new DiseaseSystem();
                $diseaseSystem->disease_id = $id;
                $diseaseSystem->system_id = $system_id;
                $diseaseSystem->save();
                }   
            }
            
            //AQUI HAY PROBLEMA :V 

            // Y los síntomas asociados
            $symptoms = explode(",", $request->input('symptoms'));
            
            foreach ($symptoms as $symptom_name) {
                $diseaseSymptom = new DiseaseSymptom();
                $diseaseSymptom->disease_id = $id;
                $symptom = Symptom::firstOrCreate([
                    'name' => $symptom_name
                ]);
                $diseaseSymptom->symptom_id = $symptom->id;
                $diseaseSymptom->save();
            }
            // dd("guardo los SINTOMAS asociados");
        }
        
        return back();
        
    
    }
}
