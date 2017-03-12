@extends('layouts.app')

@section('contentMenu')
<a href="#" class="breadcrumb">Especies</a>
@endsection

@section('content')
<br><br>
	@foreach($species as $specie)
	<div class="col s2">
		<div class="row">
		    <div class="col s12 ">
		      <div class="card">
		        <div class="card-image">
		          <img src="{{$specie->photo_route}}">
		          <span class="card-title">{{$specie->name}}</span>
		          <a href="/sistemas/{{$specie->id}}" style="right:10px;" class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">visibility</i></a>
		          <a href="/especie/{{$specie->id}}" style="right:60px;"class="btn-floating halfway-fab waves-effect waves-light blue"><i class="material-icons">edit</i></a>
		        </div>
		      </div>
		    </div>
	  </div>
	</div>

	@endforeach

	<div class="fixed-action-btn ">
	    <a data-speciesId="{{$specie->id}}" href="#modal1" class="btn-floating btn-large red">
	      <i class="large material-icons">add</i>
	    </a>
	</div>

<!-- <div class="card">
    <div class="card-content">
        <span class="card-title">ESPECIES</span>
        <form method="POST">
        {{ csrf_field() }}
        	<div class="row">
        		<div class="input-field col s12">
		          <input id="name" name="name" type="text" class="validate" required>
		          <label for="name">Nombre</label>
		        </div>
		        <div class="input-field col s12">
		          <input id="description" type="text" name="description" class="validate" required>
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
	        @foreach($species as $specie)
		    	<tr>
		           <td>{{$specie->name}}</td>
		           <td>{{$specie->description}}</td>
		           <td>
		           	<a href="#modal3"  data-speciesId="{{$specie->id}}" data-speciesName="{{$specie->name}}"  data-speciesDescription="{{$specie->description}}"title="Editar">
						<i class="small material-icons">edit</i>
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
    <div id="modal3" class="modal modal-fixed-footer">
		      <form action="/especie/editar" method="POST">
        	  {{ csrf_field() }}
		        	<div class="modal-content">
		        		<h4>Editar Especie</h4>
		        		<input name="id" id="id_modal" type="hidden" value="">
		        		<div class="input-field col s12">
				          <input  name="name" placeholder="Placeholder" id="name_modal" type="text" class="validate" required>
				          <label for="first_name">Nombre</label>
				        </div>
				       <div class="input-field col s12">
				          <input name="description" placeholder="Placeholder" id="description_modal" type="text" class="validate" required>
				          <label for="first_name">Descripcion</label>
				        </div>
		        	</div> 
		        	 <div class="modal-footer">
				      	<a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat">Cerrar</a>
				    	<button class="modal-action waves-effect waves-green btn-flat" type="submit" >Guardar
							<i class="material-icons right">play_for_work</i>
						</button>
				    </div>       	
       		  </form>
	</div>    
</div>  -->
<div id="modal1" class="modal modal-fixed-footer">
		
		      <form method="POST" enctype="multipart/form-data">
        	  {{ csrf_field() }}
		        	<div class="modal-content">
		        		<h4>Registrar Especie</h4>
		        		<!-- <input type="text" name="id" id="id_modal" > -->
		        		<div class="input-field col s12">
				          <input  name="name" placeholder="Ingrese aqui el nombre " type="text" class="validate" required>
				          <label for="first_name">Nombre</label>
				        </div>
				        <div class="input-field col s12">
				           <div class="file-field input-field">
						      <div class="btn">
						        <span>File</span>
						        <input name="photo" type="file" required>
						      </div>
						      <div class="file-path-wrapper">
						        <input class="file-path validate" type="text">
						      </div>
						    </div>
				        </div>
		        	</div> 
		        	 <div class="modal-footer">
				      	<a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat">Cerrar</a>
				    	<button class="modal-action waves-effect waves-green btn-flat" type="submit" >Guardar
							<i class="material-icons right">play_for_work</i>
						</button>
				    </div>       	
       		  </form>
	</div>    
@endsection

@section('scripts')
    <script>
        // $(document).ready(function(){   

        //     $('#modal1').modal();           
        // });
        $(function(){
        	$('[data-speciesId]').on('click',addSpeciesModal);	
        });
        function addSpeciesModal(){
        	//id
			var species_id = $(this).attr('data-speciesId');
			$('#id_modal').val(species_id);
        	
        	$('#modal1').modal(); 
        }

    </script>
@endsection
