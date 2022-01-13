$( function () {
	$(window).on('load', function() {
		$.ajax({
			url : base_url + '/site/initiate_check',
			type : 'POST',
			dataType : 'JSON',
			success : function (data) {
				if(data.is_change == 0){
					$('.close-cPass-modal').hide();
					$('#cPass-modal').modal('show');
				}
			}
		});
	});

	var t = setInterval(function () {
		var showTime = moment().format('dddd, DD MMMM YYYY HH:mm:ss');
		$('#timeCont').text(showTime);
	}, 1000);

	$("#cPass-modal").on("click", ".click-to-view", function(){
		$(this).toggleClass("fa fa-eye-slash").toggleClass("fa fa-eye");
		var type = $(this).parent().parent().find("input").attr("type");
		if ( type == "text" )
			$(this).parent().parent().find("input").attr("type", "password");
		else
			$(this).parent().parent().find("input").attr("type", "text");
	});

	$("#cPass-form").ajaxForm({
		dataType: "json",
		url : base_url + '/site/change_password',
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

});