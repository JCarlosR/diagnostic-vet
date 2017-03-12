@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-content">
        <span class="card-title">ACTUALIZAR ENFERMEDADES</span>
        <form method="POST">
        {{ csrf_field() }}
        	<div class="row">
        		<div class="input-field col s12">
		          <input id="name" name="name" type="text" class="validate" value="{{old('name',$diseases->name)}}" required>
		          <label for="name">Nombre</label>
		        </div>
		        <div class="input-field col s12">
		          <input id="description" name="description" type="text" class="validate" value="{{old('description',$diseases->description)}}" required>
		          <label for="description">Descripcion</label>
		        </div>
		        <button class="btn waves-effect waves-light" type="submit" name="action">Guardar cambios
				    <i class="material-icons right">play_for_work</i>
				 </button>
        	</div>        	
        </form>
        <div class="row">
        	<div class="col s6 ">
        		<div class="card">
		        	<div class="card-content">
		        		<div class="row">
		        			<div class="col s9">
		        				<span class="card-title">Sintomas</span>
		        			</div>
		        			<div class="col s3">
		        				<a  href="#modal1" title="Agregar Nuevo Sintoma" class="btn-floating btn-large waves-effect waves-light red">
		        					<i class="material-icons">add</i>
		        				</a>
		        			</div>
		        		</div>  			           		      	        		
		        		<div class="row">
		        			<div class="input-field col s12">
					          <i class="material-icons prefix">view_headline</i>
					          <input id="icon_prefix" type="text" class="validate">
					          <label for="icon_prefix">Sintoma</label>
					        </div>
		        		</div>	
		        		<table class="bordered">
				        <thead>
				          <tr>
				              <th data-field="id">Nombre</th>
				              <th data-field="name">Opciones</th>
				          </tr>
				        </thead>
				        
				        <tbody>
				          @foreach($unassigned_symptoms as $unassigned_symptom)
					          <tr>					          						          	  
					            <td>{{$unassigned_symptom->name}}</td>
					            <td>
        				            <form action="/enfermedad-sintoma" method="POST">
					          			{{ csrf_field() }}
						                <input type="hidden" name="disease_id" value="{{ $diseases->id }}">
						          	    <input type="hidden" name="symptom_id" value="{{ $unassigned_symptom->id }}">
							           	<a href="#" id="add" data-id="add_symptom" title="Agregar">
							           		<i class="small material-icons">add</i>
							           	</a>
							           	<a href="#modal2"  data-symptomId="{{ $unassigned_symptom->id }}" data-symptomName="{{$unassigned_symptom->name}}" title="Editar">
							           		<i class="small material-icons">edit</i>
							           	</a>
							           	<a href="#" title="Eliminar">
							           		<i class="small material-icons">delete</i>
							           	</a>				     
       					            </form>
					            </td>
					          </tr>
				          @endforeach
				     
				        </tbody>
				      </table>
		        	</div>
	        	</div>
        	</div>
        	<!-- <div class="col s2 "><br><br><br>  		
		        	<div class="center-align">
		        		<a href="#!user" title="Agregar"><i class="large material-icons">playlist_add</i></a>
		        	</div>	        	
        	</div> -->
        	<div class="col s6 ">
        		<div class="card">
		        	<div class="card-content">
		        		<span class="card-title">Sintomas Asignados</span>
		        		<div class="row">
		        			<div class="input-field col s12">
					          <i class="material-icons prefix">search</i>
					          <input id="icon_prefix" type="text" class="validate">
					          <label for="icon_prefix">Buscar</label>
					        </div>
		        		</div>	
		        		<table class="bordered">
				        <thead>
				          <tr>
				              <th data-field="id">Nombre</th>
				              <th data-field="name">Opciones</th>
				          </tr>
				        </thead>

				        <tbody>
				        @foreach($assigned_symptoms as $assigned_symptom)
				          <tr>				  
				            <td>{{$assigned_symptom->symptom->name}}</td>
				            <td>		            
					            <form id="form-delete" action="/enfermedad-sintoma/eliminar" method="POST">	
					            	{{ csrf_field() }}
					            	<input type="hidden" name="id" value="{{$assigned_symptom->id}}">
						            <a class="delete" href="#!" title="Eliminar">
						           		<i  class="small material-icons center-align">delete</i>
						           	</a>			           	
					            </form>				          
				            </td>
				          </tr>
				        @endforeach
				        </tbody>
				      </table>
		        	</div>
	        	</div>
        	</div>
        </div>     
             
    

		     <!-- Modal Structure -->
		<div id="modal1" class="modal modal-fixed-footer">
		      <form action="/sintomas" method="POST">
	          {{ csrf_field() }}
					<div class="modal-content">
				      <h4>Agregar Nuevo Sintoma</h4>
			        	<div class="row">
			        		<div class="input-field col s12">
					          <input name="name" type="text" class="validate" >
					          <label for="name">Nombre</label>
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

		<div id="modal2" class="modal modal-fixed-footer">
		      <form action="/sintomas/editar" method="POST">
        	  {{ csrf_field() }}
		        	<div class="modal-content">
		        		<h4>Editar Sintoma</h4>
		        		<div class="input-field col s12">
		        		  <input type="hidden" name="id"    id="id_modal">
				          <input type="text"   name="name"  id="name_modal" class="validate" required>
				          <label for="name"></label>
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
	
    </div>
</div> 

@endsection
@section('scripts')
    <script>
        $(document).ready(function(){   

            $('#modal1').modal();           
        });
        $(function(){
        	$('[data-symptomName]').on('click',editSymptomModal);	
        });
        function editSymptomModal(){
        	//name
			var symptom_id = $(this).attr('data-symptomId');
			$('#id_modal').val(symptom_id);
        	//name
			var symptom_name = $(this).attr('data-symptomName');
			$('#name_modal').val(symptom_name);

        	$('#modal2').modal(); 
        }
        //AJAX PRUEBA
        $(document).ready(function(){   

            $('.delete').click(function(){

            	$formDelete = $('#form-delete');            	
            	var url = $formDelete.attr('action');

            	alert($formDelete.serialize());

            	$.ajax({
		            url: url,
		            method: 'POST',
		            data: $formDelete.serialize()
		        }).done(function(result){

		        	alert(result);

		        }).fail(function(){

		        	alert("error");

		        });
            });           
        });

    </script>
@endsection
<!-- $.ajax({
            url: avatarUrl,
            method: 'POST',
            data: $formDelete.serialize()
        })
            .done(function (data) {
                if(data.error)
                    Materialize.toast(data.message, 4000);
                else{
                    Materialize.toast(data.message, 4000);
                    setTimeout(function(){
                        location.reload();
                    }, 2000);
                }
            })
            .fail(function () {
                alert('Ocurrió un error inesperado');
            });
    });
 -->
<!-- $(function(){
	$('[data-category]').on('click',editCategoryModal);	
	$('[data-level]').on('click',editLevelModal);	
});
function editCategoryModal(){
	//id
	var category_id = $(this).data('category');
	$('#category_id').val(category_id);
	//name
	var name = $(this).parent().prev().text();
	$('#category_name').val(name);

	$('#modalEditCategory').modal('show');


}
 -->