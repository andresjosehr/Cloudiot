




window.ImprimirDatosFinning=function(vista, id, datos){

	$("#"+id).empty()
	$("#"+id).html(vista)

	datos=JSON.parse(datos);
	console.log(datos)

	console.log(datos.PlantaAgua[0].mt_value+" ----> Esto es informacion de planta agua")
	console.log(datos.PlantaAgua[1].mt_value+" ----> Esto es informacion de planta agua")


if (id=='planta_agua_div') {
	if (!window.AlarmaPrimera) {
      if (datos.Reloj1[0].mt_value==75 || datos.Reloj2[0].mt_value==75 || datos.PlantaAgua[0].mt_value==1 || datos.PlantaAgua[1].mt_value==1) {
          window.sound.play();
       } else{
          window.sound.pause();
       }
    }
 }



    if (id=='dinamometro_div') {

    	if (!window.AlarmaPrimera) {
          if (datos.Dinamometro[8].mt_value==1 || datos.Dinamometro[9].mt_value==1) {
             window.sound.play();
           } else{
            window.sound.pause();
           }
        }
    }

}