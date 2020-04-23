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


    public function edit(System $system, Disease $disease)
    {       
        $species = $system->species;

        $systems = System::where('species_id', $system->species_id)->get();

        // Mark as checked those already associated systems
        $systems = $this->checkAssociatedSystems($systems, $disease->id);

        // Assigned symptoms
        $chips = $this->getAssignedSymptoms($disease->id);

        // Redirect after update
        session()->put('redirect_update_disease', '/enfermedades/'.$system->id);

        $symptoms = Symptom::all();

        return view('disease.edit')->with(compact(
            'system','species','disease', 'systems',

            // All symptoms and the assigned ones
            'symptoms', 'chips'
        ));
    }
    
    public function editAll(Species $species, Disease $disease)
    {
        $systems = $species->systems;

        // Mark as checked those already associated systems
        $systems = $this->checkAssociatedSystems($systems, $disease->id);
        
        // Assigned symptoms
        $chips = $this->getAssignedSymptoms($disease->id);

        // Redirect after update
        session()->put('redirect_update_disease', '/enfermedadesAll/'.$species->id);

        $symptoms = Symptom::all();

        return view('disease.editAll')->with(compact(
            'system','species','disease', 'systems', 

            // All symptoms and the assigned ones
            'symptoms', 'chips'
        ));
    }
    
    private function getAssignedSymptoms($diseaseId)
    {
        $symptomIds = DiseaseSymptom::where('disease_id', $diseaseId)
            ->pluck('symptom_id');
        
        return Symptom::whereIn('id', $symptomIds)->get();
    }
    
    private function checkAssociatedSystems($systems, $diseaseId)
    {
        // Affected systems
        $diseaseSystems = DiseaseSystem::where('disease_id', $diseaseId)
            ->pluck('system_id')->toArray();
        
        foreach ($systems as $system) {
            $system->checked = in_array($system->id, $diseaseSystems);
        }
        
        return $systems;
    }

    public function update($id, Request $request)
    {
        $disease = Disease::find($id);
        $disease->name = $request->input('name');
        $disease->review = $request->input('review');
        $disease->exams = $request->input('exams');
        $disease->treatment = $request->input('treatment');
        
        $saved = $disease->save();

        // Delete existing relationships to start over again
        DiseaseSystem::where('disease_id', $id)->delete();
        DiseaseSymptom::where('disease_id', $id)->delete();
        
        if ($saved) {

            // Associate systems
            $systemIds = (array) $request->input('systems');

            foreach ($systemIds as $system_id) {   
                $diseaseSystem = new DiseaseSystem();
                $diseaseSystem->disease_id = $id;
                $diseaseSystem->system_id = $system_id;
                $diseaseSystem->save();
            }   

            // Associate symptoms
            $symptoms = explode(",", $request->input('symptoms'));
            
            foreach ($symptoms as $symptomName) {
                $symptomName = preg_replace('/(\s)+/', ' ', trim($symptomName));
                
                if ($symptomName === '')
                    continue;

                $diseaseSymptom = new DiseaseSymptom();
                $diseaseSymptom->disease_id = $id;
                $symptom = Symptom::firstOrCreate([
                    'name' => $symptomName
                ]);
                $diseaseSymptom->symptom_id = $symptom->id;
                $diseaseSymptom->save();
            }
        }
        
        return redirect(session('redirect_update_disease'));
    }

    public function delete($id)
    {
        Disease::find($id)->delete();
        return back();
    }
}
