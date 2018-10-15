/*
**** FORM SUBMIT HANDLER PLUGIN ****
Author: Rumesh Dananjaya
*/

var ladda = Ladda.create( document.querySelector( '.ladda' ) );

$('#submitForm').submit(function(event){
	event.preventDefault();
	let data = $( this ).serialize();
	resetErrors();
	submitData(data);
});

function submitData(data){

	$.ajax({
		url: path,
		method: method,
		data: data,
		beforeSend: function () {
			ladda.start();
		},
		complete: function () {
			ladda.stop();
		},
		success: function (data) {
			successHandler(); // This need to be handled externally
		},
		error: function(data){
			if(data.status == 422){
				errorHandler(data.responseJSON.errors)
			}
		}
	});
}

function errorHandler(errors){
	$.each(errors, function(index, message) {
		displayErrors(index,message)
	});
}

function displayErrors(index,message){

	let input_id = '#' + index;
	let input_error_id = '#' + index + '-error';

	$(input_id).addClass('is-invalid');

	$(input_error_id).html(message);
	$(input_error_id).show();

}

function resetErrors(){
	$('.is-invalid').removeClass('is-invalid');
	$('.input-error-section').hide();
}



