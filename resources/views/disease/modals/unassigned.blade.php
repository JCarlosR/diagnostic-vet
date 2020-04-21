<div id="modal_unassigned" class="modal bottom-sheet">
    <div class="modal-content">
        <h4>Enfermedades sin sistemas asociados</h4>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Reseña</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($unassignedDiseases as $disease)
                <tr>
                    <td>{{ $disease->name }}</td>
                    <td>{{ $disease->review_short }}</td>
                    <td>
                        <a class="btn-floating blue" data-edit="x"  href="/enfermedadAll/{{ $species->id }}/{{ $disease->id }}/editar">
                            <i class="material-icons">edit</i>
                        </a>
                        <a class="btn-floating red"  data-delete="{{ $disease->id }}" href="#modal_delete">
                            <i class="material-icons">delete</i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>