@extends('layouts.app')

@section('contentMenu')
<a href="#" class="breadcrumb">Especies</a>
@endsection

@section('content')
<br><br>
	@foreach($species as $specie)
	<div class="col s12 m6 l2">
		  <div class="card center">
		      	<div class="card-title">{{$specie->name}}</div>
		        <div class="card-image">
		          <img src="{{$specie->photo_route}}">
		          <a href="/sistemas/{{$specie->id}}" style="right:10px;" class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">visibility</i></a>
		          <a href="/especie/{{$specie->id}}" style="right:60px;" class="btn-floating halfway-fab waves-effect waves-light blue"><i class="material-icons">edit</i></a>
		        </div>
		      </div>
	</div>

	@endforeach

	<div class="fixed-action-btn ">
	    <a data-speciesId="xd" href="#modal1" class="btn-floating btn-large teal">
	      <i class="large material-icons">add</i>
	    </a>
	</div>

	<!-- img prueba -->
	    <!-- <input type='file' id="imgInp" />
	    <img id="blah" src="#" alt="your image" /> -->
	
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
				        <div class="col s3 ">
					      <div class="card samll">
					        <div class="card-image">

					        <img id="blah" src="/images/no_image.png" alt="your image" />
					        
					        </div>
					      </div>
					    </div>
				        <div class="input-field col s9">
				           <div class="file-field input-field">
						      <div class="btn btn-red">
						        <span >Imagen</span>
						        <input id="imgInp" name="photo" type="file" required>
						      </div>
						      <div class="file-path-wrapper">
						        <input class="file-path validate" type="text">
						      </div>
						    </div>
				        </div>
		        	</div> 
		        	 <div class="modal-footer">
				      	<a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat">Cerrar</a>
				    	<button class="btn waves-effect waves-light" type="submit" name="action">Registrar
						    <i class="material-icons right">done</i>
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
        function readURL(input) {

		    if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $('#blah').attr('src', e.target.result);
		        }

		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#imgInp").change(function(){
		    readURL(this);
		});

    </script>
@endsection
