
<script>
   $(".dtp.hidden").remove()
   $(".modal-backdrop.in").remove()
   $(".modal-backdrop.fade.in").remove();


// window.sound = new Howl({
//                          src: ['{{ asset('Notificaciones/noti_1.mp3') }}'],
//                          autoplay: true,
//                          volume: 0.5,
//                       });
//                       window.sound.pause();

//    if (window.PrimeraVez=="Si") {
//      $("#largeModal").removeClass("fade");

//    }

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
               <div class="col-md-5" style="line-height: 0">
                  <h4 class="modal-title nombre-instalacion" id="largeModalLabel">Ultima Medición Pozo Nave 4: {{$Datos["UltimaMedicionPozoNave4"][0]->mt_time}}</h4>
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
               <div class="col-md-12" id='pozo_nave_4_div' style="padding: 0px">
                 <h1 align='center' id='h1_3b6e_0'>Pozo Nave 4</h1>
<div id='div_3b6e_4'>
  <div align='center' style='width: 100%'>
    <div style="float: left;margin-left: 20%"><br>
      <h3>Pozo de Contencion</h3> 
        @if ($Datos['PozoNave4Tabla']['NivelBajoE1'][59]->mt_value==0 && $Datos['PozoNave4Tabla']['NivelAltoE1'][59]->mt_value==0)
          <img style='width: 95px' id='img_3b6e_1' src='{{ asset('images/tanque_pozo_nave0.png') }}' alt='' style="float: left;"> 
        @endif
        @if ($Datos['PozoNave4Tabla']['NivelBajoE1'][59]->mt_value==1 && $Datos['PozoNave4Tabla']['NivelAltoE1'][59]->mt_value==0)
          <img style='width: 95px' id='img_3b6e_1' src='{{ asset('images/tanque_pozo_nave2.png') }}' alt='' style="float: left;"> 
        @endif
        @if ($Datos['PozoNave4Tabla']['NivelAltoE1'][59]->mt_value==1)
          <img style='width: 95px' id='img_3b6e_1' src='{{ asset('images/tanque_pozo_nave4.png') }}' alt='' style="float: left;"> 
        @endif
    </div>
    <div style="float: right;margin-right: 20%"><br>
      <h3>Pozo de Emergencia</h3>
      @if ($Datos['PozoNave4Tabla']['NivelBajoE2'][59]->mt_value==0 && $Datos['PozoNave4Tabla']['NivelAltoE2'][59]->mt_value==0)
        <img style='width: 95px' id='img_3b6e_1' src='{{ asset('images/tanque_pozo_nave0.png') }}' alt='' style="float: right;"> 
      @endif
      @if ($Datos['PozoNave4Tabla']['NivelBajoE2'][59]->mt_value==1 && $Datos['PozoNave4Tabla']['NivelAltoE2'][59]->mt_value==0)
        <img style='width: 95px' id='img_3b6e_1' src='{{ asset('images/tanque_pozo_nave2.png') }}' alt='' style="float: right;"> 
      @endif
      @if ($Datos['PozoNave4Tabla']['NivelAltoE2'][59]->mt_value==1)
        <img style='width: 95px' id='img_3b6e_1' src='{{ asset('images/tanque_pozo_nave4.png') }}' alt='' style="float: right;"> 
      @endif
    </div>
   </div>
</div>
<div id='div_3b6e_5'></div>
<div class='body table-responsive' align='center' style='margin-top:25px; max-height: 150px;overflow: auto;'>
    <table class='table sicut-table-bordered sicut-modal-table1 pozo_nave_table'>
      <thead></thead>
      <caption scope='row' class='sicut-tabla-titulo'>Pozo nave 4 <i class='fa fa-volume-up' onclick='$window.sound.play();$(this).pause()' style='cursor: pointer;display:none;color: red;margin-left: 20px;'></i></caption>
      <thead>
                              <th class='sicut-th'>Hrs</th>
                              <th class='sicut-th'>Bajo<br>E1</th>
                              <th class='sicut-th'>Alto<br>E1</th>
                              <th class='sicut-th'>Bajo<br>E2</th>
                              <th class='sicut-th'>Alto<br>E2</th>
      </thead>
      <tbody>
         @for ($i = 0; $i <60 ; $i++)
                              <tr>
                                    <th class='sicut-th'>{{date_format(date_create($Datos['PozoNave4Tabla']['NivelBajoE1'][$i]->mt_time), 'H:i') }}</th>

                                    <th class='sicut-th'>
                                      @if ($Datos['PozoNave4Tabla']['NivelBajoE1'][$i]->mt_value==0)
                                        <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                        @else
                                        <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                      @endif
                                    </th>
                                    <th class='sicut-th'>
                                        @if ($Datos['PozoNave4Tabla']['NivelAltoE1'][$i]->mt_value==0)
                                        <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                        @else
                                        <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                      @endif
                                    </th>


                                    <th class='sicut-th'>
                                       @if ($Datos['PozoNave4Tabla']['NivelBajoE2'][$i]->mt_value==0)
                                        <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                        @else
                                        <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                      @endif
                                      
                                    </th>

                                    <th class='sicut-th'>
                                       @if ($Datos['PozoNave4Tabla']['NivelAltoE2'][$i]->mt_value==0)
                                        <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                        @else
                                        <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                      @endif
                                      
                                    </th>
                              </tr>
                              @endfor
      </tbody>
  </table>
</div>
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














  {{-- <h1 align='center' id='h1_3b6e_0'>Pozo Nave 4</h1>
  <div id='div_3b6e_4'>
    <div align='center' style='margin: 0 auto; display: flex'>
      @if ($Datos['PozoNave4Tabla']['NivelBajoE1'][59]->mt_value==0 && $Datos['PozoNave4Tabla']['NivelAltoE1'][59]->mt_value==0)
        <img style='width: 95px' id='img_3b6e_1' src='{{ asset('images/tanque_pozo_nave0.png') }}' alt=''> 
      @endif
      @if ($Datos['PozoNave4Tabla']['NivelBajoE1'][59]->mt_value==1 && $Datos['PozoNave4Tabla']['NivelAltoE1'][59]->mt_value==0)
        <img style='width: 95px' id='img_3b6e_1' src='{{ asset('images/tanque_pozo_nave2.png') }}' alt=''> 
      @endif
      @if ($Datos['PozoNave4Tabla']['NivelAltoE1'][59]->mt_value==1)
        <img style='width: 95px' id='img_3b6e_1' src='{{ asset('images/tanque_pozo_nave4.png') }}' alt=''> 
      @endif

      @if ($Datos['PozoNave4Tabla']['NivelBajoE2'][59]->mt_value==0 && $Datos['PozoNave4Tabla']['NivelAltoE2'][59]->mt_value==0)
        <img style='width: 95px' id='img_3b6e_1' src='{{ asset('images/tanque_pozo_nave0.png') }}' alt=''> 
      @endif
      @if ($Datos['PozoNave4Tabla']['NivelBajoE2'][59]->mt_value==1 && $Datos['PozoNave4Tabla']['NivelAltoE2'][59]->mt_value==0)
        <img style='width: 95px' id='img_3b6e_1' src='{{ asset('images/tanque_pozo_nave2.png') }}' alt=''> 
      @endif
      @if ($Datos['PozoNave4Tabla']['NivelAltoE2'][59]->mt_value==1)
        <img style='width: 95px' id='img_3b6e_1' src='{{ asset('images/tanque_pozo_nave4.png') }}' alt=''> 
      @endif

     </div>
  </div>
  <div id='div_3b6e_5'></div>
  <div class='body table-responsive' align='center' style='margin-top:25px; max-height: 200px;overflow: auto;'>
      <table class='table sicut-table-bordered sicut-modal-table1 pozo_nave_table'>
        <thead></thead>
        <caption scope='row' class='sicut-tabla-titulo'>Pozo nave 4 <i class='fa fa-volume-up' onclick='$window.sound.play();$(this).pause()' style='cursor: pointer;display:none;color: red;margin-left: 20px;'></i></caption>
        <thead>
                                <th class='sicut-th'>Hrs</th>
                                <th class='sicut-th'>Bajo<br>E1</th>
                                <th class='sicut-th'>Alto<br>E1</th>
                                <th class='sicut-th'>Bajo<br>E2</th>
                                <th class='sicut-th'>Alto<br>E2</th>
        </thead>
        <tbody>
           @for ($i = 0; $i <60 ; $i++)
                                <tr>
                                      <th class='sicut-th'>{{date_format(date_create($Datos['PozoNave4Tabla']['NivelBajoE1'][$i]->mt_time), 'H:i') }}</th>

                                      <th class='sicut-th'>
                                        @if ($Datos['PozoNave4Tabla']['NivelBajoE1'][$i]->mt_value==0)
                                          <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                          @else
                                          <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                        @endif
                                      </th>
                                      <th class='sicut-th'>
                                          @if ($Datos['PozoNave4Tabla']['NivelAltoE1'][$i]->mt_value==0)
                                          <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                          @else
                                          <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                        @endif
                                      </th>


                                      <th class='sicut-th'>
                                         @if ($Datos['PozoNave4Tabla']['NivelBajoE2'][$i]->mt_value==0)
                                          <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                          @else
                                          <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                        @endif
                                        
                                      </th>

                                      <th class='sicut-th'>
                                         @if ($Datos['PozoNave4Tabla']['NivelAltoE2'][$i]->mt_value==0)
                                          <i class='material-icons'  style='color: green;font-size: 15px;'>check_circle</i>
                                          @else
                                          <i class='material-icons' style='color: red;font-size: 15px;'>error</i>
                                        @endif
                                        
                                      </th>
                                </tr>
                                @endfor
        </tbody>
    </table>
  </div> --}}