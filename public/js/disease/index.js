$(function(){
    $('[data-add]').on('click', addDiseaseModal);
    $('[data-delete]').on('click', deleteDiseaseModal);
    
    $chips.on('chip.add', updateChipsInputHidden);
    $chips.on('chip.delete', updateChipsInputHidden);

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

function updateChipsInputHidden() {
    const data = $chips.material_chip('data');
    
    const chips = [];

    for (var i=0; i<data.length; ++i) {
        chips.push(data[i].tag);
    }

    $('#symptoms').val(chips.join(','));
}
