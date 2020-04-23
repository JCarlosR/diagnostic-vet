@extends('layouts.app')

@section('contentMenu')
	<a href="/especies" class="breadcrumb">
		Especies
	</a>
	<a href="/sistemas/{{ $species->id }}" class="breadcrumb">
		Especie {{ $species->name }}
	</a>
	<a href="#" class="breadcrumb">
		Editar Enfermedad {{ $disease->name }}
	</a>
@endsection

@section('content')
	<div class="card-panel">
		<form action="/enfermedad/{{$disease->id}}" method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}
		
			<h5 class="center-align">EDITAR ENFERMEDAD</h5>
			
			<div class="row">
				<div class="input-field col s6">
					<input id="name" name="name" placeholder="Ingrese aqui el nombre" type="text" class="validate" value="{{ $disease->name }}" required>
					<label for="name">Nombre</label>
				</div>

				<div class="input-field col s6">
					<textarea id="review" name="review" class="materialize-textarea" required>{{ $disease->review }}</textarea>
					<label for="review">Reseña</label>
				</div>	
			</div>
			
			<div class="row">
				<div class="input-field col s6">
					<textarea id="exams" name="exams"  class="materialize-textarea" required>{{ $disease->exams }}</textarea>
					<label for="exams">Exámenes Complementarios</label>
				</div>

				<div class="input-field col s6">
					<textarea id="treatment" name="treatment"  class="materialize-textarea" required>{{ $disease->treatment }}</textarea>
					<label for="treatment">Tratamiento</label>
				</div>	
			</div>
			
			<div class="row">
				<div class="col s2">
					<h6>Sistemas afectados</h6>
				</div>
				<div class="col s10">
					@foreach ($systems as $system)
						<div class="col s2">
							<input name="systems[]" type="checkbox" class="filled-in"
								   value="{{ $system->id }}" id="system{{ $system->id }}" @if($system->checked) checked @endif>
							<label for="system{{ $system->id }}">{{ $system->name }}</label>
						</div>
					@endforeach
				</div>
			</div>
			
			<div class="row">
				<div class="col s12">
					<input type="hidden" name="symptoms" value="@foreach($chips as $chip) {{ $chip->name }}, @endforeach" id="symptoms">
					<div id="symptoms_chips" class="chips chips-autocomplete">
					</div>
				</div>
			</div>
		
			<div class="right-align">
				<button class="btn waves-effect waves-light" type="submit" name="action">Guardar cambios
					<i class="material-icons right">play_for_work</i>
				</button>
			</div>
		</form>
	</div>
@endsection

@section('scripts')
	<script>
		const $chips = $('#symptoms_chips');

		$chips.material_chip({
			@if (sizeof($chips) > 0)
			data: [
				@foreach ($chips as $chip)
				{ tag: '{{ $chip->name }}'},
				@endforeach
			],
			@endif
			secondaryPlaceholder: 'Ingresa un síntoma y presiona ENTER',
			placeholder: '+Síntoma',
			autocompleteData: {
				@foreach ($symptoms as $symptom)
				'{{ $symptom->name }}': null,
				@endforeach
			}
		});
	</script>
	<script src="{{ asset('js/disease/chips.js') }}"></script>
@endsection