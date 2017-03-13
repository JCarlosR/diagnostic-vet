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
        $id = $especies->id;

        //generamos el nombre del archivo (id+extension)
        $file_name = $id.'.'.$extension;    

        //ajustamos y guardamos la imagen en la ruta especificada
        Image::make($request->file('photo'))
               // ->resize(144,144)
               ->save('images/species/'. $file_name);

        return back()->with('notification','Usuario registrado exitosamente');
    }
    public function edit($id)
    {
        $species = Species::find($id);
        return view('species.edit')->with(compact('species'));
    }
    public function update($id, Request $request)
    {
        $especies = Species::find($id);

        if(! $request->file('photo')){
            // dd("no esta instanciado");
            $especies->name = $request->input('name');
        }else{
            // dd("si esta instanciado");
            //obenemos la extension del archivo
            $extension = $request->file('photo')->getClientOriginalExtension(); 
            $especies->name = $request->input('name');
            $especies->photo = $extension; 

            //generamos el nombre del archivo (id+extension)
            $file_name = $id.'.'.$extension;    

            //ajustamos y guardamos la imagen en la ruta especificada
            Image::make($request->file('photo'))
                   // ->resize(144,144)
                   ->save('images/species/'. $file_name);
        }
        
        $especies->save();
         
        // return view('species.index')->with(compact('species'));
        return $this->index();
    }
   
}
