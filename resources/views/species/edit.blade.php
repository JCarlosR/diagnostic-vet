@extends('layouts.app')

@section('contentMenu')
<a href="/especies" class="breadcrumb">Especies</a>
<a href="#" class="breadcrumb">Editar Especie :  {{$species->name}}</a>
@endsection
@section('content')
<br><br>

		<div class="col s8 offset-s2">
			
		      <form method="POST" enctype="multipart/form-data">
        	  {{ csrf_field() }}		   
		        		<h4>Editar Especie</h4>
		        		<div class="input-field col s12">
				          <input  name="name" placeholder="" type="text" class="validate" value="{{$species->name}}" required>
				          <label for="first_name">Nombre</label>
				        </div>
				        <div class="col s3 ">
					      <div class="card samll">
					        <div class="card-image">
					          <img src="{{$species->photo_route}}">	  
					  
					        </div>
					      </div>
					    </div>
				        <div class="input-field col s9">
				           <div class="file-field input-field">
						      <div class="btn">
						        <span>Modificar Imagen</span>
						        <input name="photo" type="file" required>
						      </div>
						      <div class="file-path-wrapper">
						        <input class="file-path validate" type="text">
						      </div>
						    </div>
				        </div> 
		        	 	<div class="col s12 right-align">		        	 		
					    	 <button class="btn waves-effect waves-light" type="submit" name="action">Guardar Cambios
							    <i class="material-icons right">play_for_work</i>
							 </button>
		        	 	</div>
				    </div>       	
       		  </form>
		</div>
	  
@endsection

@section('scripts')
    
@endsection
