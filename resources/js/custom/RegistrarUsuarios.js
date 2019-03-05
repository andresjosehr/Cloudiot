

window.RegistrarUsuario=function (url) {

	var repetido= false;

	$('table tr #email_temp').each(function(){
		if ($(this).text()==$("#email_user").val()) {
			repetido=true;
		}
	});
	if (repetido==false) {
		if ($("#email_user").val()=="") {
			swal("Error", "Deber introducir un correo", "warning");
		} else{
			emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
			if (emailRegex.test($("#email_user").val())) {
				$.ajaxSetup({
				       headers: {
				         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				       }
				});
		      $("#reg_usuario").load(url, { email: $("#email_user").val(), instalaciones: $("#instalaciones_asignadas").val() });
		    } else {
		      swal("Error", "Debes introducir un correo electronico valido", "waning");
		    }
		}
	} else{
		swal("Error", "Este email ya se encuentra registrado en el sistema", "warning");
	}
}


window.EliminarUserTemp = function(email, key, url) {
	$.ajaxSetup({
				       headers: {
				         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				       }
				});
	$("#reg_usuario").load(url, { email: email, key: key });
}