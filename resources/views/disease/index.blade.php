@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-content">
        <span class="card-title">ENFERMEDADES</span>
        <form method="POST">
        {{ csrf_field() }}
        	<div class="row">
        		<div class="input-field col s12">
		          <input id="name" name="name" type="text" class="validate">
		          <label for="name">Nombre</label>
		        </div>
		        <div class="input-field col s12">
		          <input id="description" name="description" type="text" class="validate">
		          <label for="description">Descripcion</label>
		        </div>
		        <button class="btn waves-effect waves-light" type="submit" name="action">Registrar
				    <i class="material-icons right">play_for_work</i>
				 </button>
        	</div>        	
        </form>
        <table class="bordered">
        	<thead>
	          <tr>
	              <th >Nombre</th>
	              <th >Descripcion</th>
	              <th >Opciones</th>
	          </tr>
	        </thead>
	        <tbody>
	        @foreach($diseases as $disease)
		    	<tr>
		           <td>{{$disease->name}}</td>
		           <td>{{$disease->description}}</td>
		           <td>
		           	<a href="/enfermedad/{{$disease->id}}" title="Editar">
		           		<i class="small material-icons">mode_edit</i>
		           	</a>
		           	<a href="" title="Eliminar">
		           		<i class="small material-icons">delete</i>
		           	</a>
		           </td>
		        </tr>
		    @endforeach
	        </tbody>
        </table>


        
    </div>
    
</div> 

@endsection
