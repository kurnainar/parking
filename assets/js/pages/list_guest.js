$( function () {

	var t = $('#listguestTbl').DataTable({
		"processing" : true,
		"language": {
			"processing": '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
		},
		"serverSide": true, 
		"order": [], 
		"ajax": {
			"url": base_url + "vehicle/view_guest_vehicle",
			"type": "POST"
		},
		"searchDelay" : 750,
		"columnDefs"	: [{
			"targets"	: [0,4],
			"orderable"	: false
		}]
	});

	$('.btn-l2Form').on('click', function() {
		$('#listguest-form').trigger('reset');
		$('#listguest-modal').modal('show');
	});

	$("#listguest-form").ajaxForm({
		dataType: "json",
		url : base_url + 'vehicle/save_guest_vehicle',
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
			url: base_url + "vehicle/find_guest_vehicle",
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
					$("#id2").val( data.msg[0].IdPengguna );
					$("#sUser_id").val ( data.msg[0].representative_id );
					$("#guest_name").val ( data.msg[0].guest_name );
					$("#guest_desc").val ( data.msg[0].guest_desc );
					$("#KendaraanId").val ( data.msg[0].KendaraanId );
					$("#NoKendaraan").val ( data.msg[0].NoKendaraan );
					$("#type").val ( "update" );

					var mod = $('#listguest-modal');
					mod.find('#modal-type').text( 'Ubah Data' );
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
					url: base_url + "vehicle/delete_guest_vehicle",
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