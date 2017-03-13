@extends('layouts.app')

@section('contentMenu')
<a href="/especies" class="breadcrumb">Especies</a>
<a href="/sistemas/{{$species_system->id}}" class="breadcrumb">Especie {{$species_system->name}}</a>
<a href="#" class="breadcrumb">Sistema {{$system->name}}</a>
@endsection

@section('content')

<div class="col s12">
	<h4 class="center-align">
		Listado de enfermedades
	</h4>
</div>
<div class="col s12">
	<h4 class="center-align">
		Especie: {{$species_system->name}} - Sistema: {{$system->name}}
	</h4>
</div>

<br>

<div class="fixed-action-btn ">
	<a data-add="x" href="#modal_disease" title="AGREGAR ENFERMEDAD" class="btn-floating btn-large teal">
		<i class="large material-icons">add</i>
	</a>
</div>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Reseña</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach($diseases_system as $disease_system)
		<tr>
			<td>{{$disease_system->disease->name}}</td>
			<td>{{$disease_system->disease->review_short}}</td>
			<td>                
				<a class="btn-floating blue" data-edit="x"  href="/enfermedad/{{$system->id}}/{{$disease_system->disease_id}}"><i class="material-icons">edit</i></a>     
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

<div id="modal_disease" class="modal modal-fixed-footer lg">			
	<form action="/enfermedades" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="modal-content">
			<h5 class="center-align">REGISTRAR ENFERMEDAD - Especie : {{$species_system->name}}</h5><br>

			<input type="hidden" name="species_id" value="{{$species_system->id}}">

			<div class="input-field col s6">
				<input  name="name" placeholder="Ingrese aqui el nombre " type="text" class="validate" required>
				<label for="first_name">Nombre</label>
			</div>

			<div class="input-field col s6">
				<textarea name="review" class="materialize-textarea" required></textarea>
				<label for="textarea1">Reseña</label>
			</div>

			<div class="input-field col s6">
				<textarea name="exams"  class="materialize-textarea" required></textarea>
				<label for="textarea1">Examenes Complementarios</label>
			</div>

			<div class="input-field col s6">
				<textarea name="treatment"  class="materialize-textarea" required></textarea>
				<label for="textarea1">Tratamiento</label>
			</div><br>
			
			<div class="row">
				<div class="col s2">
					<h6>Sistemas afectados</h6>
					
				</div>
				<div class="col s10">
					@foreach ($systems_species as $system_species)
					<div class="col s12 m6 l2">
						<input type="checkbox" name="systems[]" value="{{ $system_species->id }}" class="filled-in" id="system{{ $system_species->id }}"/>
						<label for="system{{ $system_species->id }}">{{$system_species->name}}</label>
					</div>
					@endforeach
				</div>
			</div>
			<div class="col s12">
				<input type="hidden" name="symptoms" value="" id ="symptoms">
				<div class="chips chips-autocomplete"></div>
			</div>
		</div> 
		<div class="modal-footer">
			<a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat">Cerrar</a>
			<button class="btn waves-effect waves-light" type="submit" name="action">Guardar cambios
				<i class="material-icons right">done</i>
			</button>
		</div>       	
	</form>
</div>
@endsection

@section('scripts')
<!-- <script src="/js/jquery.autocomplete.min.js"></script> -->
<script>

	$(function(){
		$('[data-add]').on('click',addDiseaseModal);	
        	// $('[data-edit]').on('click',editDiseaseModal);	


        	$('.chips-autocomplete').material_chip({
        		secondaryPlaceholder: 'Ingrese síntomas',
        		placeholder: '+Síntoma',
        		autocompleteData: {
        			@foreach ($symptoms as $symptom)
        			'{{ $symptom->name }}': null,
        			@endforeach
        		}
        	});

        	$('.chips').on('chip.add', function(e, chip){
        		updateChipsInputHidden();
        	});

        	$('.chips').on('chip.delete', function(e, chip){
        		updateChipsInputHidden(); 
        	});
        });

	function addDiseaseModal(){        	
		$('#modal_disease').modal({
				startingTop: '3%', // Starting top style attribute
				endingTop: '3%' // Ending top style attribute
			});
	}

	function updateChipsInputHidden() {
		var data = $('.chips').material_chip('data');
		var chips = [];

		for (var i=0; i<data.length; ++i) {
			chips.push(data[i].tag);
		}

		$('#symptoms').val(chips.join(','));
	}


</script>
@endsection
