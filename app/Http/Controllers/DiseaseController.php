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
    public function indexAll(Species $species)
    {   
        // Sistemas de la especie
        $systems = System::where('species_id', $species->id)->get();

        // Ids de los sistemas
        $systemIds = $systems->pluck('id')
            ->toArray();

        // Enfermedades de la especie
        $diseaseIds = DiseaseSystem::whereIn('system_id', $systemIds)
            ->pluck('disease_id')
            ->toArray();
        
        $diseases = Disease::whereIn('id', $diseaseIds)
            ->orderBy('name', 'asc')->get();

        $unassignedDiseases = $this->getUnassignedDiseases();

        $symptoms = Symptom::all();
        
        return view('disease.indexAll', compact(
            'species','systems', 'diseases', 'symptoms', 'unassignedDiseases'
        ));
    }
    
    public function index(System $system)
    {       
        $species = $system->species;

        // Sistemas de la especie
        $systems = System::where('species_id', $system->species_id)->get();

        // Enfermedades del sistema
        //  dd($system->diseases);
        $diseaseIds = DiseaseSystem::where('system_id', $system->id)
            ->pluck('disease_id')->toArray();

        $diseases = Disease::whereIn('id', $diseaseIds)
            ->orderBy('name', 'asc')->get();

        $unassignedDiseases = $this->getUnassignedDiseases();
        
        $symptoms = Symptom::all();
        
        return view('disease.index')->with(compact(
            'system','species', 'systems', 'diseases', 'symptoms', 'unassignedDiseases'
        ));    	
    }
    
    private function getUnassignedDiseases()
    {
        // Ids de enfermedades asignadas a sistemas
        $assignedIds = DiseaseSystem::pluck('disease_id')
            ->toArray();

        // Enfermedades sin asociar
        return Disease::whereNotIn('id', $assignedIds)
            ->orderBy('name', 'asc')->get();
    }
    
    public function store(Request $request)
    {
        // Store a new disease
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

            if ($system_ids > 0) {
                foreach ($system_ids as $system_id) {   
                    $diseaseSystem = new DiseaseSystem();
                    $diseaseSystem->disease_id = $disease->id;
                    $diseaseSystem->system_id = $system_id;
                    $diseaseSystem->save();
                }    
            }
            
            // Y los síntomas asociados
            $symptoms = explode(",", $request->input('symptoms'));
            foreach ($symptoms as $symptomName) {
                $symptomName = preg_replace('/(\s)+/', ' ', trim($symptomName));
                
                if ($symptomName == '')
                    continue;

                $diseaseSymptom = new DiseaseSymptom();
                $diseaseSymptom->disease_id = $disease->id;
                $symptom = Symptom::firstOrCreate([
                    'name' => $symptomName
                ]);
                $diseaseSymptom->symptom_id = $symptom->id;
                $diseaseSymptom->save();
            }
        }
        
        return back();
    }


    public function edit($id, $id_disease)
    {
        $system = System::findOrFail($id);
       
        $species_system = Species::where('id',$system->species_id)->first();

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

        // Variable de sesión
        session()->put('redirect_update_disease', '/enfermedades/'.$id);

        return view('disease.edit')->with(compact(
            'system','species_system','diseases', 'systems', 

            // Sintomas: todos y los escogidos
            'symptoms', 'chips'
        ));
    }
    
    public function editAll($species_id, $id_disease)
    {

        $species_system = Species::find($species_id);

        // obteniendo enfermedad
        $diseases = Disease::find($id_disease);

        // Sistemas afectados
        $diseaseSystems = DiseaseSystem::where('disease_id', $id_disease)->pluck('system_id');
        $diseaseSystems = $diseaseSystems->toArray();

        // Sistemas asociados con la especie
        $systems = System::where('species_id', $species_id)->get();

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
        if (sizeof($diseaseSymptoms) > 0)
            $chips = Symptom::whereIn('id', $diseaseSymptoms)->get();
        else $chips = [];

        // Variable de session
        session()->put('redirect_update_disease', '/enfermedadesAll/'.$species_id);

        return view('disease.editAll')->with(compact(
            'system','species_system','diseases', 'systems', 

            // Sintomas: todos y los escogidos
            'symptoms', 'chips'
        ));
    }

    public function update($id, Request $request)
    {
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


            // Y los síntomas asociados
            $symptoms = explode(",", $request->input('symptoms'));
            
            foreach ($symptoms as $symptom_name) {
                $symptom_name = preg_replace('/(\s)+/', ' ', trim($symptom_name));                 
                if ($symptom_name == '')
                    continue;

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
        
        return redirect(session('redirect_update_disease'));
    }

    public function delete($id)
    {
        Disease::find($id)->delete();
        return back();
    }
}
