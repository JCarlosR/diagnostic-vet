@extends('layouts.app')

@section('contentMenu')
<a href="/especies" class="breadcrumb">Especies</a>
<a href="#" class="breadcrumb">Especie {{$species->name}}</a>
@endsection

@section('content')
	<br>
	<div class="col s12"><h3 class="center-align">Sistemas de la Especie {{$species->name}}</h3></div><br>
	@foreach($systems as $system)
	<div class="col s2">
		<div class="row">
		    <div class="col s12 ">
		      <div class="card center">
		      	<div class="card-title">{{$system->name}}</div>
		        <div class="card-image">
		          <img src="{{$system->photo_route}}">
		          <a href="/enfermedades/{{$system->id}}" style="right:10px;" class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">visibility</i></a>
		          <a href="/sistema/{{$system->id}}" style="right:60px;"class="btn-floating halfway-fab waves-effect waves-light blue"><i class="material-icons">edit</i></a>
		        </div>
		      </div>
		    </div>
	  </div>
	</div>

	@endforeach

	<div class="fixed-action-btn ">
	    <a data-speciesId="x" href="#modal1" class="btn-floating btn-large teal">
	      <i class="large material-icons">add</i>
	    </a>
	</div>


	<div id="modal1" class="modal modal-fixed-footer">			
		<form method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="modal-content">
			<h4>Registrar Sistema</h4>
			<input type="hidden" name="species_id" value="{{$species->id}}">
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
					<div class="btn">
						<span>Imagen</span>
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
        $(function(){
        	$('[data-speciesId]').on('click',addSpeciesModal);	
        });
        function addSpeciesModal(){
        	       	
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