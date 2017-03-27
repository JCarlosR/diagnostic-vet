<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Species;
use App\System;
use App\Disease;
use App\DiseaseSystem;
use App\DiseaseSymptom;
use Intervention\Image\Facades\Image;

class SpeciesController extends Controller
{
    public function index()
    {
    	$species = Species::orderBy('name', 'asc')->get();
    	return view('species.index')->with(compact('species'));
    }

    public function store(Request $request)
    {
        //obenemos la extension del archivo
        $extension = $request->file('photo')->getClientOriginalExtension();  

        //guardamos en la bd
        $especies = new Species();
        $especies->name = $request->input('name');
        $especies->photo = $extension;
        $especies->save();

        //obenemos el id del registro
        $id = $especies->id;

        //generamos el nombre del archivo (id+extension)
        $file_name = $id.'.'.$extension;    

        //ajustamos y guardamos la imagen en la ruta especificada
        Image::make($request->file('photo'))
               ->resize(250,250)
               ->save(public_path() . '/images/species/'. $file_name);

        return back()->with('notification','Usuario registrado exitosamente');
    }

    public function edit($id)
    {
        $species = Species::find($id); // findOrFail

        if (! $species)
            return redirect('/especies');

        return view('species.edit')->with(compact('species'));
    }

    public function update($id, Request $request)
    {
        $especies = Species::find($id);

        if (! $request->file('photo')){
            $especies->name = $request->input('name');
        } else {
            //obenemos la extension del archivo
            $extension = $request->file('photo')->getClientOriginalExtension(); 
            $especies->name = $request->input('name');
            $especies->photo = $extension; 

            //generamos el nombre del archivo (id+extension)
            $file_name = $id.'.'.$extension;    

            //ajustamos y guardamos la imagen en la ruta especificada
            Image::make($request->file('photo'))
                   ->resize(250,250)
                   ->save(public_path() . 'images/species/'. $file_name);
        }
        
        $especies->save();

        return redirect('/especies');
    }

    public function delete($id)
    {
        // $diseases_species_array = Disease::where('species_id',$id)->pluck('id');
        // $diseases_species_array = $diseases_species_array->toArray(); //Array de Id de las enfermedades

        // DiseaseSystem::whereIn('disease_id',$diseases_species_array)->delete(); //relacion con sistemas

        // DiseaseSymptom::whereIn('disease_id',$diseases_species_array)->delete(); //relacion con sintomas

        // Disease::where('species_id',$id)->delete(); // enfermedades de la especie

        // System::where('species_id',$id)->delete();//sitemas asociados 
        
        Species::find($id)->delete();
        
        return back();
    }
   
}
