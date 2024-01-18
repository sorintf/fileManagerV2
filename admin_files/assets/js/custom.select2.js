$(document).ready(function() {
	$('.js-example-basic-single').select2({
		placeholder: 'Select an option'
	});

	$('#folders-list').select2({
		placeholder: 'Alege un folder', 
		minimumInputLength: 3
	});
});