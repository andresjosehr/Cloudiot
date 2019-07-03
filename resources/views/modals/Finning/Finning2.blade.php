<script>
  $(".dtp.hidden").remove()
  $(".modal-backdrop.in").remove()
  $(".modal-backdrop.fade.in").remove();
  // window.sound = new Howl({
  //           src: ['{{ asset('Notificaciones/noti_1.mp3') }}'],
  //           autoplay: true,
  //           volume: 0.5,
  //       });
  if (window.PrimeraVez=="Si") {
    $("#largeModal").removeClass("fade");
  }
</script>
<button type="button" class="btn btn-default waves-effect m-r-20 display-modal" data-toggle="modal" data-target="#largeModal" style="display: none"></button>
<!-- Large Size -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-lg" role="document" style="width: 95%;margin-top: 2%;">
      <div class="modal-content">
         <div class="modal-header">
            <div class="row" style="display: flex;">
               <div class="col-md-2">
                  <h4 class="modal-title nombre-instalacion" id="largeModalLabel" ><img style="width: 100%" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTUa9m_RoIT_ufuH3oNPhKded1VXMx8_KnuE5PjUT9Gn5HjE1_CbA" alt=""></h4>
               </div>
               <div class="col-md-5">
                  <h4 class="modal-title nombre-instalacion" id="largeModalLabel">Ultima Medición:  {{$Datos["Dinamometro"][count($Datos["Dinamometro"])-1]->mt_time}}</h4>
               </div>
               <div class="col-md-6" style="padding-top: 9px;margin-top: -9px;margin-right: 26px;padding-right: 1px;-webkit-box-shadow: -1px 2px 40px -15px rgba(0,0,0,0.75);-moz-box-shadow: -1px 2px 40px -15px rgba(0,0,0,0.75);box-shadow: -1px 2px 40px -15px rgba(0,0,0,0.75);">
                   <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="fecha_flujo_inicio" class="datetimepicker form-control" placeholder="Fecha Inicio">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="fecha_flujo_fin" class="datetimepicker form-control" placeholder="Fecha Fin">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button onclick="GraficarFinning();" type="button" class="btn btn-primary waves-effect"><i class="fa fa-table"></i></button>
                        </div>
                   </div>
               </div>
            </div>
         </div>

         
         <div class="modal-body table-custom" style="padding-top: 0;margin-top: 35px">
            <div class="row">   
                <div class="col-md-2">
                    <h1 align="center" style="margin-top: 35px;font-size: 22px">Pozo Nave 4</h1>
                    <canvas id="pozo4" width="100%"></canvas>  
                    <div style="margin-top: -50px"></div>
                    <canvas id="pozo4Chart" width="400" height="200"></canvas>
                </div>
                <div class="col-md-2">
                    <h1 align="center" style="margin-top: 35px;font-size: 22px">Planta Agua</h1>
                    <canvas id="plantaAgua" width="100%"></canvas>
                    <div class="row" style="margin-top: -68px">
                      <div class="col-md-6" align="center">
                        {{-- style="filter: hue-rotate(327deg)" --}}
                        <img src="{{Request::root()}}/images/bomba2.png" width="20%" alt="" @if ($Datos["PlantaAgua"][0]->mt_value==0) style="filter: hue-rotate(128deg)" @else style="filter: hue-rotate(327deg)" @endif>
                      </div>
                      <div class="col-md-6" align="center">
                        <img src="{{Request::root()}}/images/bomba2.png" width="20%" alt="" @if ($Datos["PlantaAgua"][1]->mt_value==0) style="filter: hue-rotate(128deg)" @else style="filter: hue-rotate(327deg)" @endif>
                      </div>
                    </div>
                    <canvas id="plantaAguaChart" width="400" height="200"></canvas>
                </div>
                <div class="col-md-2">
                    <h1 align="center" style="margin-top: 35px;font-size: 22px">Planta Agua</h1>
                    <canvas id="plantaAgua2" width="100%"></canvas>
                    <div class="row" style="margin-top: -68px">
                      <div class="col-md-6" align="center">
                        <img src="{{Request::root()}}/images/bomba2.png" width="20%" alt="" @if ($Datos["PlantaAgua"][2]->mt_value==0) style="filter: hue-rotate(128deg)" @else style="filter: hue-rotate(327deg)" @endif>
                      </div>
                      <div class="col-md-6" align="center">
                        <img src="{{Request::root()}}/images/bomba2.png" width="20%" alt="" @if ($Datos["PlantaAgua"][3]->mt_value==0) style="filter: hue-rotate(128deg)" @else style="filter: hue-rotate(327deg)" @endif>
                      </div>
                    </div>
                    <canvas id="dinamometroChart" width="400" height="200"></canvas>
                </div>
                <div class="col-md-3">
                    
                </div>
            </div>
         </div>
         <div class="modal-footer">
            <div id="grafico_maitenal"></div>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
         </div>
      </div>
   </div>
</div>
<style>
</style>
<script  src="instalaciones/PlantaLican.js"></script>


<script>
      $( ".display-modal" ).click();
   $(".loader-insta").css("display", "none");
   
   $('#fecha_flujo_inicio').bootstrapMaterialDatePicker
    ({
      format: 'YYYY-MM-DD HH:mm:ss',
      lang: 'fr',
      weekStart: 1, 
      cancelText : 'ANNULER',
      nowButton : true,
      switchOnClick : true,
      time: true
    });

    $('#fecha_flujo_fin').bootstrapMaterialDatePicker
    ({
      format: 'YYYY-MM-DD HH:mm:ss',
      lang: 'fr',
      weekStart: 1, 
      cancelText : 'ANNULER',
      nowButton : true,
      switchOnClick : true,
      time: true
    });

    function GraficarFinning() {
        var win = window.open(location.href+'/../ExportarFinning?FechaInicio='+$("#fecha_flujo_inicio").val()+'&FechaFin='+$("#fecha_flujo_fin").val(), '_blank');
        win.focus();
    }


    window.setInterval((function(){
    var start = Date.now();
    return function() {
         if (Math.floor((Date.now()-start)/1000)==30) {
          // $("#contenedor").load("{{Request::root()}}/FinningController", {id: 6, tabla_asociada: "log_biofiltro03", rol: 1 });
            if (($("#largeModal").data('bs.modal') || {}).isShown) {
              window.request = $.ajax({
                    type: 'POST',
                    data:{
                      id: 6,
                      tabla_asociada: "log_biofiltro03",
                      rol: 1 
                    },
                    url: '{{Request::root()}}/FinningController',
                    success: function(result){
                      $("#contenedor").html(result);
                    }
                });
              }


             }
         };
    }()), 1000);
            
</script>

<audio id="notifi">
  <source src="{{ asset('Notificaciones/noti_1.mp3') }}" type="audio/mpeg">
</audio>
<button onclick="playAudio()" id="play_audio" style="display: none;" type="button">Play Mp3</button>
<button onclick="pauseAudio()" id="pause_audio" style="display: none;" type="button">Pause Mp3</button> 


<script>


function pauseAudio() { 
  var x = document.getElementById("notifi"); 
  x.loop = true;
  x.pause(); 
}
  window.PrimeraVez="Si";

  $('#largeModal').on('hidden.bs.modal', function () {
    window.request.abort();
  })


window.RenderFinningGauge=function(id, title, tipo, valor){

if (tipo==1) {

        var high=[{ "from": 0, "to": 33, "color": "rgba(0, 133, 42)" },
                  { "from": 33, "to": 66, "color": "rgba(220, 200, 0, .75)" },
                  { "from": 66, "to": 100, "color": "rgba(200, 50, 50, .75)" }];
} else{

        var high=[{ "from": 0, "to": 25, "color": "rgba(100, 255, 100, .2)"},
                  { "from": 25, "to": 50, "color": "rgba(0, 133, 42)" },
                  { "from": 50, "to": 75, "color": "rgba(220, 200, 0, .75)" },
                  { "from": 75, "to": 100, "color": "rgba(200, 50, 50, .75)" }];
}

var gauge = new RadialGauge({
    renderTo: id,
    width: 150,
    height: 150,
    units: title,
    lineWidth: 0.23, // The line thickness
    value: valor,
    minValue: 0,
    startAngle: 90,
    ticksAngle: 180,
    valueBox: false,
    maxValue: 100,
    majorTicks: [
        " ",
        " ",
        " ",
        " ",
        " ",
    ],
    minorTicks: 2,
    strokeTicks: true,
    highlights: high,
    colorPlate: "#fff",
    borderShadowWidth: 0,
    borders: false,
    needleType: "arrow",
    needleWidth: 5,
    needleCircleSize: 2,
    needleCircleOuter: true,
    needleCircleInner: false,
    animationDuration: 1500,
    animationRule: "linear"
}).draw();

}



    window.renderFinningChart=function(id, mt_value, mt_time){
      if (id=="pozo4Chart") var Maxmax=3; else var Maxmax=2;
            var ctx = document.getElementById(id).getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: mt_time,
                    datasets: [{
                        label: 'Ultimos 15 min',
                        data: mt_value,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                       yAxes: [{
                                  ticks: {
                                    callback: function(label, index, labels) {
                                      if (id=="pozo4Chart") {
                                        if (label==0)  return "Vacio"
                                        if (label==1)  return "Bajo"
                                        if (label==2)  return "Medio"
                                        if (label==3)  return "Alto"
                                      } else{
                                        if (label==0)  return "Bajo"
                                        if (label==1)  return "Medio"
                                        if (label==2)  return "Alto"
                                      }
                                    },
                                      min: 0,
                                      max: Maxmax,
                                      stepSize: 1
                                  }
                              }]
                    }
                }
            });
}

var PlantaAgua1=[];
var PlantaAgua2=[];
var mt_time=[];

@for ($i = 0; $i < count($Datos["Grafico1"]); $i++)
  PlantaAgua1.push("{{$Datos["Grafico1"][$i]->mt_value}}");
  PlantaAgua2.push("{{$Datos["Grafico2"][$i]->mt_value}}");
  mt_time.push("{{date_format(date_create($Datos["Grafico1"][$i]->mt_time), 'H:i')}}");
@endfor

console.log(PlantaAgua1)
console.log(PlantaAgua2)
console.log(mt_time)

renderFinningChart("pozo4Chart", PlantaAgua1, mt_time);
renderFinningChart("plantaAguaChart", PlantaAgua1, mt_time);
renderFinningChart("dinamometroChart", PlantaAgua2, mt_time);

RenderFinningGauge("pozo4", "Pozo Nave 4", 2, "0");
RenderFinningGauge("plantaAgua", "Planta Agua", 1, "{{$Datos['Reloj1'][0]->mt_value}}");
RenderFinningGauge("plantaAgua2", "Planta Agua", 1, "{{$Datos['Reloj2'][0]->mt_value}}");