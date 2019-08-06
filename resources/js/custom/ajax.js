

window.AjaxRequest=function (metodo, ruta, datos) {
	$(".loader-insta").show();


	$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

	$.ajax({
		type: metodo,
		url: ruta,
		data: datos,
		success: function(result) {
			$(".loader-insta").hide();
			eval(result);
		},
		error: function(e) {
			$(".loader-insta").hide();
	        console.log("Error en la peticion");
	        console.log(e);
	    }
	});

}


window.AjaxFileRequest=function (metodo, ruta, idArchivo) {

	$(".loader").show();

    var file_data = $('#'+idArchivo).prop('files')[0];   
    var form_data = new FormData();     
    form_data.append('_method', metodo);             
    form_data.append('file', file_data);

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });                   

    $.ajax({
        url: ruta, // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: "POST",
        success: function(result) {
			$(".loader").hide();
			eval(result);
		},
		error: function(e) {
			$(".loader").hide();
	        console.log("Error en la peticion");
	        console.log(e);
	    }
     });

}

