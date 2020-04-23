$(function(){
    $('[data-add]').on('click', addDiseaseModal);
    $('[data-delete]').on('click', deleteDiseaseModal);
    
    // Init all modals
    $('.modal').modal();
});

function deleteDiseaseModal() {
    var id = $(this).attr('data-delete');

    $('#delete').attr("href", "/enfermedad/"+id+"/eliminar");

    $('#modal_delete').modal();
}

function addDiseaseModal() {
    $('#modal_create').modal({
        startingTop: '3%',
        endingTop: '3%'
    });
}
