$( function () {

	var t = $('#eVchTbl').DataTable();

	$('.btn-eVchForm').on('click', function() {

		$('#eVch-form').trigger('reset');
		$('#eVch-modal').modal('show');
		
	});
	
});