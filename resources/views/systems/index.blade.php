@extends('layouts.app')

@section('contentMenu')
<a href="/especies" class="breadcrumb">Especies</a>
<a href="#" class="breadcrumb">Especie {{$species->name}}</a>
@endsection

@section('content')
	<br><br>
	



	<div class="fixed-action-btn ">
	    <a data-speciesId="x" href="#modal1" class="btn-floating btn-large red">
	      <i class="large material-icons">add</i>
	    </a>
	</div>


	<div id="modal1" class="modal modal-fixed-footer">			
		<form method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
			<div class="modal-content">
				<h4>Registrar Sistema</h4>
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