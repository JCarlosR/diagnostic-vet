@extends('layouts.app')

@section('contentMenu')
<a href="/especies" class="breadcrumb">Especies</a>
<a href="/sistemas/{{$species_system->id}}" class="breadcrumb">Especie {{$species_system->name}}</a>
<a href="#" class="breadcrumb">Editar Enfermedad {{$diseases->name}}</a>
@endsection

@section('content')
<br><br>
<form action="/enfermedad/{{$diseases->id}}" method="POST" enctype="multipart/form-data">
	{{ csrf_field() }}
		<div>
			<h5 class="center-align">EDITAR ENFERMEDAD</h5><br>

			<div class="input-field col s6">
	          <input  name="name" placeholder="Ingrese aqui el nombre " type="text" class="validate" value="{{$diseases->name}}" required>
	          <label for="first_name">Nombre</label>
	        </div>

	        <div class="input-field col s6">
	          <textarea name="review" class="materialize-textarea" value="{{$diseases->review}}" required>{{$diseases->review}}</textarea>
	          <label for="textarea1">Reseña</label>
	        </div>

	        <div class="input-field col s6">
	          <textarea name="exams"  class="materialize-textarea" value="{{$diseases->name}}" required>{{$diseases->exams}}</textarea>
	          <label for="textarea1">Examenes Complementarios</label>
	        </div>

	         <div class="input-field col s6">
	          <textarea name="treatment"  class="materialize-textarea" required>{{$diseases->treatment}}</textarea>
	          <label for="textarea1">Tratamiento</label>
	        </div><br>
			
			<div class="row">
				<div class="col s2">
				<h6>Sistemas afectados</h6>					
				</div>
				<div class="col s10">
					@foreach ($systems as $system)
					<div class="col s2">						
						<input name="systems[]" type="checkbox" value="{{$system->id}}" class="filled-in" id="{{$system->id}}" @if($system->checked) checked @endif />
		      			<label for="{{$system->id}}">{{ $system->name }}</label>
		      		</div>
					@endforeach
				</div>
			</div>
			<div class="col s12">
				<input type="hidden" name="symptoms" value="" id ="symptoms">
				<div class="chips chips-autocomplete">
				</div>
			</div>
		</div> <br><br>
		<div class="right-align">
	    	<button class="btn waves-effect waves-light" type="submit" name="action">Guardar cambios
			    <i class="material-icons right">play_for_work</i>
			</button>
		</div>
	        	
	</form>

@endsection
@section('scripts')
    <script>
    	$(function () {
        	$('.chips-autocomplete').material_chip({
			    @if (sizeof($chips) > 0)
        	    data: [
			    	@foreach ($chips as $chip)
			    		{ tag: '{{ $chip->name }}'},
			    	@endforeach
		    	],
				@endif
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