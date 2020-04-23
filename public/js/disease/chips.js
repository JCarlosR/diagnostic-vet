$(function() {
    $chips.on('chip.add', updateChipsInputHidden);
    $chips.on('chip.delete', updateChipsInputHidden);
});

function updateChipsInputHidden() {
    const data = $chips.material_chip('data');

    const chips = [];

    for (var i=0; i<data.length; ++i) {
        chips.push(data[i].tag);
    }

    $('#symptoms').val(chips.join(','));
}
