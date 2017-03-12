<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Species;
use Intervention\Image\Facades\Image;

class SpeciesController extends Controller
{
    public function index()
    {
    	$species = Species::get();
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
        $species = Species::all();
        $id=$species->last()->id;

        //generamos el nombre del archivo (id+extension)
        $file_name = $id.'.'.$extension;    

        //ajustamos y guardamos la imagen en la ruta especificada
        Image::make($request->file('photo'))
               ->resize(144,144)
               ->save('images/species/'. $file_name);

        return back()->with('notification','Usuario registrado exitosamente');
    }
    public function edit($id)
    {
        $species = Species::find($id);
        return view('species.edit')->with(compact('species'));
    }
    public function update(Request $request)
    {
        // dd($request);
        // dd("rico :3");
        // $this->validate($request, Project::$rules,Project::$messages);
        // Symptom::create($request->all());
        $species_id=$request->input('id');
        $species = Species::find($species_id);
        $species->name=$request->input('name');
        $species->description=$request->input('description');
        $species->save();
        
        return back();
    }
   
}
