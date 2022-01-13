$( function () {

	$('.btn-nav-form').on('click', function() {
		$('#nav-form').trigger('reset');
		$('#nav-modal').modal('show');
	});

	var t = $('#navTbl').DataTable({
		"processing" : true,
		"language": {
			"processing": '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
		},
		"serverSide": true, 
		"order": [], 
		"ajax": {
			"url": base_url + "developer/view_nav",
			"type": "POST"
		},
		"searchDelay" : 750,
		"columnDefs"	: [{
			"targets"	: [0,4],
			"orderable"	: false
		}]
	});

	$("#nav-form").ajaxForm({
		dataType: "json",
		url : base_url + 'developer/save_nav',
		beforeSubmit: function(){
			$('#btn-submit').removeClass('btn-primary').addClass('btn-warning').prop('disabled', true);
		},
		success: function(data){
			var sa_title = (data.type == 'done') ? "Success!" : "Failed!";
			var sa_type = (data.type == 'done') ? "success" : "warning";
			Swal.fire({ title:sa_title, type:sa_type, html:data.msg }).then(function(){ 
				if (data.type == 'done') window.location.reload(); 
			});
		},
		error: function(){
			Swal.fire ( "Failed!", "Error Occurred, Please refresh your browser.", "error" );
		},
		complete: function(){
			$('#btn-submit').removeClass('btn-warning').addClass('btn-primary').prop('disabled', false);
		}
	});

	t.on('click', '.btn-edit', function () {
		var row_id = $(this).data('id');
		$.ajax({
			url: base_url + "developer/find_nav",
			type: 'post',
			data: { 'key' : row_id },
			dataType: 'json',
			success: function(data){
				if (data.type != 'done'){
					var sa_title = (data.type == 'done') ? "Success!" : "Failed!";
					var sa_type = (data.type == 'done') ? "success" : "error";
					Swal.fire({ title:sa_title, type:sa_type, html:data.msg });
				}
				else {
					$("#id").val ( row_id );
					$("#nav_name").val ( data.msg[0].nav_name );
					$("#nav_ctr").val ( data.msg[0].nav_ctr );
					$("#nav_parent").val ( data.msg[0].nav_parent );
					$("#nav_order").val ( data.msg[0].nav_order );
					$("#type").val ( "update" );

					var mod = $('#nav-modal');
					mod.find('#modal-type').text( 'Edit Entry' );
					mod.modal('show');
				}
			},
			error : function(){
				Swal.fire ( "(500)", "Error Occurred, Please refresh your browser.", "error" );
			}
		});
	});


	t.on('click', '.btn-delete', function () {
		var row_id = $(this).data('id');
		var row_name = $(this).data('name');
		Swal.fire({
			title: 'Delete data !',
			type: 'warning',
			html: '<span class="italic">Are you sure to delete <strong>' + row_name + '</strong> ?</span>',
			showCancelButton: true,
			confirmButtonText: "Yes, delete it!",
			confirmButtonColor: "#DD6B55",
			showLoaderOnConfirm: true,
		}).then(function(result){
			if (result.value) {
				$.ajax({
					url: base_url + "developer/delete_nav",
					type: 'post',
					data: { 'key' : row_id },
					dataType: 'json',
					success: function(data){
						var sa_title = (data.type == 'done') ? "Success!" : "Failed!";
						var sa_type = (data.type == 'done') ? "success" : "error";
						Swal.fire({ title:sa_title, type:sa_type, html:data.msg }).then(function(){
							if (data.type == 'done') window.location.reload();
						});
					}
				});
			}else{
				Swal.fire('Canceled', 'Canceled remove data', 'warning');
			}
		});
	});
	

});