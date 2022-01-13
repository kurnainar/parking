$( function () {

	var t = setInterval(function () {

		$.ajax({
			url : base_url + 'site/check_slot',
			type : 'POST',
			dataType : 'JSON',
			success : function (data) {
				if (data.type == 'done') {
					$('#carSlot').text(data.carSlot);
					$('#bikeSlot').text(data.bikeSlot);
				}
			}
		});

	}, 5000);

    $("#plat_no").bind('keyup', function (e) {
        if (e.which >= 97 && e.which <= 122) {
            var newKey = e.which - 32;
            // I have tried setting those
            e.keyCode = newKey;
            e.charCode = newKey;
        }

        $("#plat_no").val(($("#plat_no").val()).toUpperCase());
    });

    $(document).on('keydown', '#plat_no', function(e) {
        if (e.keyCode == 32) return false;
    });

    var barcode="";
    $(document).on('keydown', '#id_card', function(e) {

        var code = (e.keyCode ? e.keyCode : e.which);
        if(code==13) {
            save();
            clear();
            // getData( $("#plat_no").val(), $("#id_card").val() );
        } else {
            barcode=barcode+String.fromCharCode(code);
        }
    });

});

function save() {
    $.ajax({
        url : base_url + "VehiclesOut/saveout",
        type: "POST",
        data: $('#frmTapIn').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            console.log(data);
            // if(data.response == 0) {
            //     Swal.fire('', data.message, "error", 3000);
            // } else {
            //     console.log(data[0]);
            //     // $('[id="plat_no"]').val(data.GroupMenuId);
            // }
        }
    });
}

// function getData(plat,nip)
// {
//     $.ajax({
//         url : base_url + "",
//         type: "GET",
//         data: {
//             id : nip,
//             nomor : plat
//         }
//         dataType: "JSON",
//         success: function(data)
//         {
//             console.log(data);
//         },
//         error: function (jqXHR, textStatus, errorThrown)
//         {
//             console.log('Something Wrong!');
//         }
//     });
// }

function clear()
{
    $('#plat_no').val('');
    $('#id_card').val('');
    $('#plat_no').focus();
}