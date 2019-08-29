<script>
   $(".dtp.hidden").remove()
   $(".modal-backdrop.in").remove()
   $(".modal-backdrop.fade.in").remove();


window.sound = new Howl({
                         src: ['{{ asset('Notificaciones/noti_1.mp3') }}'],
                         autoplay: true,
                         volume: 0.5,
                      });
                      window.sound.pause();

   if (window.PrimeraVez=="Si") {
     $("#largeModal").removeClass("fade");

   }

   window.AlarmaPrimera=false;
   
   
   
   setInterval(function(){ 
     window.FechaInicio = $("#fecha_flujo_inicio").val();
     window.FechaFin    = $("#fecha_flujo_fin").val();
   }, 30);
   
   
</script>
<button type="button" class="btn btn-default waves-effect m-r-20 display-modal" data-toggle="modal" data-target="#largeModal" id="button_3b6e_0"></button>
<!-- Large Size -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-lg" role="document" id="div_3b6e_0">
      <div class="modal-content">
         <div class="modal-header">
            <div class="row" id="div_3b6e_1">
               <div class="col-md-2">
                  <h4 class="modal-title nombre-instalacion" id="largeModalLabel" ><img id="img_3b6e_0" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTUa9m_RoIT_ufuH3oNPhKded1VXMx8_KnuE5PjUT9Gn5HjE1_CbA" alt=""></h4>
               </div>
               <div class="col-md-5">
                  <h4 class="modal-title nombre-instalacion" id="largeModalLabel">Ultima Medición Dinamometro: {{$Datos["UltimaMedicionDinamometro"][0]->mt_time}}</h4><br>
                  <h4 class="modal-title nombre-instalacion" id="largeModalLabel">Ultima Medición PlantaAgua: {{$Datos["UltimaMedicionPlantaAgua"][0]->mt_time}}</h4>
               </div>
               <div class="col-md-6" id="div_3b6e_2">
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
         <div class="modal-body table-custom" id="div_3b6e_3">
            <div class="row" style="min-height: 300px;">
               <div class="col-md-2" id='pozo_nave_4_div'>
                 {{-- @include("modals.Finning.pozo_nave_4") --}}
                 <div class="sicut-loading" id="sicut-loading5" style="margin-top:75px;"></div>
               </div>
               <div class="col-md-5" id="planta_agua_div">
                 {{-- @include("modals.Finning.planta_agua") --}}
                 <div class="sicut-loading" id="sicut-loading5" style="margin-top:75px;"></div>
               </div>
               <div class="col-md-5" id="dinamometro_div">
                 {{-- @include("modals.Finning.dinamometro") --}}
                 <div class="sicut-loading" id="sicut-loading5" style="margin-top:75px;"></div>
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
<style></style>
<script  src="instalaciones/PlantaLican.js"></script>
<script>

   AjaxRequest("POST", window.url+"/FinningPozoNave4", "") 
   AjaxRequest("POST", window.url+"/FinningPlantaAgua", "") 
   AjaxRequest("POST", window.url+"/FinningDinamometro", "")
   $(".loader-insta").hide();


   $( ".display-modal" ).click();
   $(".loader-insta").css("display", "none");



   
   function GraficarFinning() {
     var win = window.open(location.href+'/../ExportarFinning?FechaInicio='+$("#fecha_flujo_inicio").val()+'&FechaFin='+$("#fecha_flujo_fin").val(), '_blank');
     win.focus();
   }
   
   
   window.segti=0;
   
   var myTimer = window.setInterval(function(){
     window.segti++;
     if (Number(window.segti)==Number(60)) {

      window.PrimeraVez="Si";
      window.AlarmaPrimera=true;

        window.segti=0;
         if (($("#largeModal").data('bs.modal') || {}).isShown) {

          window.request1 = AjaxRequest("POST", window.url+"/FinningPozoNave4", "");
          window.request2 = AjaxRequest("POST", window.url+"/FinningPlantaAgua", "");
          window.request3 = AjaxRequest("POST", window.url+"/FinningDinamometro", "");

          $(".loader-insta").hide();
         }
         }
   
   }, 1000);
   
   
   function pauseAudio() { 
     var x = document.getElementById("notifi"); 
     x.loop = true;
     x.pause(); 
   }
   
     $('#largeModal').on('hidden.bs.modal', function () {
       window.AlarmaPrimera=false;
       window.request1.abort();
       window.request2.abort();
       window.request3.abort();
     })
   

   
   
  
   
   var PlantaAgua1=[];
   var PlantaAgua2=[];
   var mt_time=[];
   
   
   $("#fecha_flujo_inicio").val(window.FechaInicio);
   $("#fecha_flujo_fin").val(window.FechaFin);


   $('#fecha_flujo_inicio').bootstrapMaterialDatePicker
    ({
      format: 'YYYY-MM-DD',
      lang: 'fr',
      weekStart: 1, 
      cancelText : 'ANNULER',
      nowButton : true,
      switchOnClick : true,
      time: false
    });

    $('#fecha_flujo_fin').bootstrapMaterialDatePicker
    ({
      format: 'YYYY-MM-DD',
      lang: 'fr',
      weekStart: 1, 
      cancelText : 'ANNULER',
      nowButton : true,
      switchOnClick : true,
      time: false
    });
  

   
   
   
</script>
<style>
   table td, table th, tbody tr th{
    font-size: 10px
   }
   .bombas_dinamometro p{
   margin-bottom: -2px;
   }
   #button_3b6e_0{display: none}
    #div_3b6e_0{width: 95%;margin-top: 2%;}
    #div_3b6e_1{display: flex;}
    #img_3b6e_0{width: 100%}
    #div_3b6e_2{padding-top: 9px;margin-top: -9px;margin-right: 26px;padding-right: 1px;-webkit-box-shadow: -1px 2px 40px -15px rgba(0,0,0,0.75);-moz-box-shadow: -1px 2px 40px -15px rgba(0,0,0,0.75);box-shadow: -1px 2px 40px -15px rgba(0,0,0,0.75);}
    #div_3b6e_3{padding-top: 0;margin-top: 35px}
    #h1_3b6e_0{margin-top: 35px;font-size: 22px}
    #div_3b6e_4{display: flex;}
    #img_3b6e_1{margin-left:20px;width: 130px;margin-bottom: 70px}
    #img_3b6e_2{margin-left:20px;width: 130px;margin-bottom: 70px}
    #div_3b6e_5{margin-top: -50px}
    #h1_3b6e_1{margin-top: 35px;font-size: 22px}
    #img_3b6e_3{margin-left:20px;width: 140px;margin-bottom: 70px}
    #img_3b6e_4{margin-left:20px;width: 140px;margin-bottom: 70px}
    #img_3b6e_5{margin-left:20px;width: 140px;margin-bottom: 70px}
    #div_3b6e_6{margin-top: -68px}
    #img_3b6e_6{margin-left:20px;width: 140px;margin-bottom: 70px}
    #img_3b6e_7{margin-left:20px;width: 140px;margin-bottom: 70px}
    #img_3b6e_8{margin-left:20px;width: 140px;margin-bottom: 70px}
    #div_3b6e_7{margin-top: -68px}
    #h1_3b6e_2{margin-top: 35px;font-size: 22px}
    #p_3b6e_0{font-size: 10px;}
    #p_3b6e_1{font-size: 10px;}
    #p_3b6e_2{font-size: 10px;}
    #p_3b6e_3{font-size: 10px;}
    #p_3b6e_4{font-size: 10px;}
    #p_3b6e_5{font-size: 10px;}
    #p_3b6e_6{font-size: 10px;}
    #p_3b6e_7{font-size: 10px;}
    #img_3b6e_9{margin-left: -60px; margin-right:10px;width: 75px}
    #img_3b6e_10{margin-left: -60px; margin-right:10px;width: 80%}
    #img_3b6e_11{width: 75px}
    #img_3b6e_12{width: 80%}
    #play_audio{display: none;}
    #pause_audio{display: none;}

</style>