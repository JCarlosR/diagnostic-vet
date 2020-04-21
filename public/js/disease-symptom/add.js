$(function () {
	$('[data-id=add_symptom]').click(onClickAddSymptom);
});

function onClickAddSymptom(event) {
	event.preventDefault();	
	$(this).parent().submit();
}
