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
    public function indexAll($id_species)
    {          

        $species_system = Species::find($id_species);//Especie

        $systems_species = System::where('species_id',$id_species)->get();//Sistemas de la especie
            
        $systems_species_array = System::where('species_id',$id_species)->pluck('id');;//Id de los sistemas de la especie
        $systems_species_array = $systems_species_array->toArray();

        $diseases_system_array = DiseaseSystem::whereIn('system_id',$systems_species_array)->pluck('disease_id');//Enfermdades de la especie       
        $diseases_system_array = $diseases_system_array->toArray();
        $diseases_system = Disease::whereIn('id',$diseases_system_array)->orderBy('name', 'asc')->get();

        $diseases_assigned = DiseaseSystem::pluck('disease_id');//id de enfermedades com sistemas asignados
        $diseases_assigned = $diseases_assigned->toArray();

        $diseases_unassigned = Disease::whereNotIn('id',$diseases_assigned)->orderBy('name', 'asc')->get();// Enfermedades sin asociar
        

        $symptoms = Symptom::all();//todos los sintomas
        
        return view('disease.indexAll')->with(compact(
            'species_system','systems_species','diseases_system', 'symptoms','diseases_unassigned'
        ));
    }
    public function index($id) // system_id
    {
        $system = System::findOrFail($id); //arreglo del sistema correspondiente al id
       
        $species_system = Species::where('id',$system->species_id)->first();
        
        $systems_species = System::where('species_id',$system->species_id)->get();

        $diseases_system_array = DiseaseSystem::where('system_id',$id)->pluck('disease_id');//
        $diseases_system_array = $diseases_system_array->toArray();

        $diseases_system = Disease::whereIn('id',$diseases_system_array)->orderBy('name', 'asc')->get();// enferm.del system
        // dd($diseases_system);

        $diseases_assigned = DiseaseSystem::pluck('disease_id');//id de enfermedades com sistemas asignados
        $diseases_assigned = $diseases_assigned->toArray();

        $diseases_unassigned = Disease::whereNotIn('id',$diseases_assigned)->orderBy('name', 'asc')->get();// Enfermedades sin asociar
        // dd(empty($system));
        $symptoms = Symptom::all();
        
        return view('disease.index')->with(compact(
            'system','species_system','systems_species','diseases_system', 'symptoms','diseases_unassigned'
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
            foreach ($symptoms as $symptom_name) {
                $symptom_name = trim($symptom_name);
                if ($symptom_name == '')
                    continue;

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
        $system = System::findOrFail($id);
       
        $species_system = Species::where('id',$system->species_id)->first();

        // $diseases = Disease::where('species_id',$system->species_id)->get();

        // obteniendo enfermedad
        $diseases = Disease::find($id_disease);

        // Sistemas afectados
        $diseaseSystems = DiseaseSystem::where('disease_id', $id_disease)->pluck('system_id');
        $diseaseSystems = $diseaseSystems->toArray();
        // Sistemas asociados con la especie
        $systems = System::where('species_id', $system->species_id)->get();
        // dd($system);
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
        // $system = System::findOrFail($id);
       
        $species_system = Species::where('id',$species_id)->first();

        // $diseases = Disease::where('species_id',$system->species_id)->get();

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
        // dd($diseaseSymptoms);
        if (sizeof($diseaseSymptoms) > 0)
            $chips = Symptom::whereIn('id', $diseaseSymptoms)->get();
        else $chips = [];
        // dd($chips);

        //variable de sesion
        session()->put('redirect_update_disease', '/enfermedadesAll/'.$species_id);

        return view('disease.editAll')->with(compact(
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
        
        // return back();
        return redirect(session('redirect_update_disease'));
        
    
    }

    public function delete($id)
    {
        Disease::find($id)->delete();
        return back();
    }
}
