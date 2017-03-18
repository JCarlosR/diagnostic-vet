<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\System;
use App\Species;
use Intervention\Image\Facades\Image;

class SystemController extends Controller
{
    public function index($id)
    {	
    	$species = Species::find($id);
    	$systems = System::where('species_id',$id)->orderBy('name', 'asc')->get();
        return view('systems.index')->with(compact('systems','species'));
    }
    public function store(Request $request)
    {
    	//obenemos la extension del archivo
        $extension = $request->file('photo')->getClientOriginalExtension();  

        //guardamos en la bd
        $sistemas = new System();
        $sistemas->name = $request->input('name');
        $sistemas->species_id = $request->input('species_id');
        $sistemas->photo = $extension;
        $sistemas->save();

        //obenemos el id del registro
        $systems = System::all();
        $id=$systems->last()->id;

        //generamos el nombre del archivo (id+extension)
        $file_name = $id.'.'.$extension;    

        //ajustamos y guardamos la imagen en la ruta especificada
        Image::make($request->file('photo'))
               ->resize(250,250)
               ->save('images/systems/'. $file_name);

        return back()->with('notification','Usuario registrado exitosamente');
    }
    public function edit($id)
    {
    	$species = System::where('id',$id)->first();

    	$species_system = Species::where('id',$species->species_id)->first();

        $system = System::find($id);
        return view('systems.edit')->with(compact('system','species_system'));
    }
    public function update($id, Request $request)
    {
        $systems = System::find($id);

        //obtener el id de la especie
        // $species_id = $systems->species_id;


        if(! $request->file('photo')){
            
            $systems->name = $request->input('name');
        }else{
            // dd("si esta instanciado");
            //obenemos la extension del archivo
            $extension = $request->file('photo')->getClientOriginalExtension(); 
            $systems->name = $request->input('name');
            $systems->photo = $extension; 

            //generamos el nombre del archivo (id+extension)
            $file_name = $id.'.'.$extension;    

            //ajustamos y guardamos la imagen en la ruta especificada
            Image::make($request->file('photo'))
                   ->resize(250,250)
                   ->save('images/systems/'. $file_name);
        }
        
        $systems->save();
         

        return $this->index($systems->species_id);
    }
    public function delete($id)
    {
        System::find($id)->delete();
        return back();
    }
}
