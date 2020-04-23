@extends('layouts.app')

@section('contentMenu')
	<a href="/especies" class="breadcrumb">
		Especies
	</a>
	<a href="/sistemas/{{$species->id}}" class="breadcrumb">
		Especie {{$species->name}}
	</a>
	<a href="#" class="breadcrumb">
		Sistema {{$system->name}}
	</a>
	<a href="#" class="breadcrumb">
		Enfermedades
	</a>
@endsection

@section('content')
	@include('disease.alertUnassigned')

	<h2 class="center-align">
		Listado de enfermedades
	</h2>
	<h3 class="center-align">
		Especie: {{$species->name}}
	</h3>
	<h4 class="center-align">
		Sistema: {{$system->name}}
	</h4>

	@include('disease.floatingButton')

<table class="table table-bordered">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Reseña</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach($diseases as $disease)
		<tr>
			<td>{{$disease->name}}</td>
			<td>{{$disease->review_short}}</td>
			<td>  
				<a class="btn-floating blue" data-edit="x" href="/enfermedad/{{ $system->id }}/{{ $disease->id }}/editar">
					<i class="material-icons">edit</i>
				</a>
				<a class="btn-floating red"  data-delete="{{$disease->id}}" href="#modal_delete">
					<i class="material-icons">delete</i>
				</a>    
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

	@include('disease.modals.create')
	@include('disease.modals.unassigned')
	@include('disease.modals.delete')
@endsection

@section('scripts')
	<script>
		const $chips = $('#symptoms_chips');

		$chips.material_chip({
			secondaryPlaceholder: 'Ingresa 1 síntoma y ENTER',
			placeholder: '+Síntoma',
			autocompleteData: {
				@foreach ($symptoms as $symptom)
				'{{ $symptom->name }}': null,
				@endforeach
			}
		});
	</script>
	<script src="{{ asset('js/disease/index.js') }}"></script>
@endsection
