<div id="modal_create" class="modal modal-fixed-footer lg">
    <form action="/enfermedades" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="modal-content">
            <h5 class="center-align">REGISTRAR ENFERMEDAD - Especie: {{$species->name}}</h5><br>

            <input type="hidden" name="species_id" value="{{$species->id}}">

            <div class="input-field col s6">
                <input id="name" name="name" placeholder="Ingrese aqui el nombre " type="text" class="validate" required>
                <label for="name">Nombre</label>
            </div>

            <div class="input-field col s6">
                <textarea id="review" name="review" class="materialize-textarea" required></textarea>
                <label for="review">Reseña</label>
            </div>

            <div class="input-field col s6">
                <textarea id="exams" name="exams"  class="materialize-textarea" required></textarea>
                <label for="exams">Exámenes Complementarios</label>
            </div>

            <div class="input-field col s6">
                <textarea id="treatment" name="treatment"  class="materialize-textarea" required></textarea>
                <label for="treatment">Tratamiento</label>
            </div><br>

            <div class="row">
                <div class="col s2">
                    <h6>Sistemas afectados</h6>
                </div>
                <div class="col s10">
                    @foreach ($systems as $system_species)
                        <div class="col s12">
                            <input type="checkbox" name="systems[]" value="{{ $system_species->id }}" class="filled-in" id="system{{ $system_species->id }}"/>
                            <label for="system{{ $system_species->id }}">{{$system_species->name}}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col s12">
                <input type="hidden" name="symptoms" value="" id="symptoms">
                <div id="symptoms_chips" class="chips chips-autocomplete"></div>
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