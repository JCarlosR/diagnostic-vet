@extends('layouts.app')

@section('contentMenu')
	<a href="/especies" class="breadcrumb">
		Especies
	</a>
	<a href="/sistemas/{{ $species->id }}" class="breadcrumb">
		Especie {{ $species->name }}
	</a>
	@if (isset($system))
	<a href="/enfermedades/{{ $system->id }}" class="breadcrumb">
		Sistema {{ $system->name }}
	</a>
	@endif
	<a href="#" class="breadcrumb">
		Editar Enfermedad {{ $disease->name }}
	</a>
@endsection

@section('content')
	<div class="card-panel">
		@include('disease.formEdit')
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