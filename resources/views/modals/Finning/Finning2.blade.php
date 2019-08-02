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

    if (!window.AlarmaPrimera) {
      console.log("Suena la alarma");
      if ({{$Datos['Reloj1'][0]->mt_value}}==75 || {{$Datos['Reloj2'][0]->mt_value}}==75 || {{$Datos["Dinamometro"][8]->mt_value}}==1 || {{$Datos["Dinamometro"][9]->mt_value}}==1) {
         window.sound.play();
       } else{
        window.sound.pause();
       }
    }

   if (window.PrimeraVez=="Si") {
     $("#largeModal").removeClass("fade");

   }
   
   
   
   setInterval(function(){ 
     window.FechaInicio =$("#fecha_flujo_inicio").val();
     window.FechaFin    =$("#fecha_flujo_fin").val();
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
                  <h4 class="modal-title nombre-instalacion" id="largeModalLabel">Ultima Medición:  {{$Datos["Dinamometro"][count($Datos["Dinamometro"])-1]->mt_time}}</h4>
               </div>
               <div class="col-md-6" id="div_3b6e_2">
                  <div class="row">
                     <div class="col-md-5">
                        <div class="form-group">
                           <div class="form-line">
                              <input type="datetime-local" id="fecha_flujo_inicio" class="datetimepicker form-control" placeholder="Fecha Inicio">
                           </div>
                        </div>
                     </div>
                     <div class="col-md-5">
                        <div class="form-group">
                           <div class="form-line">
                              <input type="datetime-local" id="fecha_flujo_fin" class="datetimepicker form-control" placeholder="Fecha Fin">
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
            <div class="row">
               <div class="col-md-2">
                  <h1 align="center" id="h1_3b6e_0">Pozo Nave 4</h1>
                  <div id="div_3b6e_4">
                    <div align="center" style="margin: 0 auto; display: flex">
                      <img style="width: 95px" id="img_3b6e_1" src="{{ asset('images/tanque_pozo_nave0.png') }}" alt=""> 
                      <img style="width: 95px" id="img_3b6e_2" src="{{ asset('images/tanque_pozo_nave0.png') }}" alt=""> 
                     </div>
                  </div>
                  <div id="div_3b6e_5"></div>
                  <div class="body table-responsive" align="center" style='margin-top:25px'>
                      <table class="table sicut-table-bordered sicut-modal-table1 pozo_nave_table">
                        <thead>
                            </thead><caption scope="row" class="sicut-tabla-titulo">Pozo nave 4 <i class="fa fa-volume-up" onclick='$window.sound.play();$(this).pause()' style="cursor: pointer;display:none;color: red;margin-left: 20px;"></i></caption>
                        <tbody>
                            <tr>
                                <th class="sicut-th">Nivel Bajo</th>
                                <td><i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i></td>
                            </tr>
                            <tr>
                                <th class="sicut-th">Nivel alto pozo</th>
                                <td><i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i></td>
                            </tr>
                            <tr>
                                <th class="sicut-th">Nivel alto</th>
                                <td><i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i></td>
                            </tr>
                            <tr>
                                <th class="sicut-th">Nivel alto TK</th>
                                <td><i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i></td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
               </div>
               <div class="col-md-5">
                  <div class="row">
                     <h1 align="center" id="h1_3b6e_1">Planta Agua</h1>
                     <div class="col-md-1"></div>
                     <div class="col-md-10" align="center">
                      <div class="row">
                        <div class="col-md-6">
                           @if ($Datos['Reloj2'][0]->mt_value==25) <img style="width: 95px" id="img_3b6e_3" src="{{ asset('images/tanque_ancho0.png') }}" alt=""> @endif
                        @if ($Datos['Reloj2'][0]->mt_value==50) <img style="width: 95px" id="img_3b6e_4" src="{{ asset('images/tanque_ancho1.png') }}" alt=""> @endif
                        @if ($Datos['Reloj2'][0]->mt_value==75) <img style="width: 95px" id="img_3b6e_5" src="{{ asset('images/tanque_ancho11png') }}" alt=""> @endif
                        <div class="row" id="div_3b6e_6">
                           <div class="col-md-6" align="center">
                              <img src="{{Request::root()}}/images/bomba2.png" width="20%" alt="" @if ($Datos["PlantaAgua"][0]->mt_value==0) style="filter: hue-rotate(128deg)" @else style="filter: hue-rotate(327deg)" @endif>
                           </div>
                           <div class="col-md-6" align="center">
                              <img src="{{Request::root()}}/images/bomba2.png" width="20%" alt="" @if ($Datos["PlantaAgua"][1]->mt_value==0) style="filter: hue-rotate(128deg)" @else style="filter: hue-rotate(327deg)" @endif>
                           </div>
                        </div>

                        </div>
                        <div class="col-md-6">
                          @if ($Datos['Reloj2'][0]->mt_value==25) <img style="width: 95px" id="img_3b6e_6" src="{{ asset('images/tanque_ancho0.png') }}" alt=""> @endif
                          @if ($Datos['Reloj2'][0]->mt_value==50) <img style="width: 95px" id="img_3b6e_7" src="{{ asset('images/tanque_ancho1.png') }}" alt=""> @endif
                          @if ($Datos['Reloj2'][0]->mt_value==75) <img style="width: 95px" id="img_3b6e_8" src="{{ asset('images/tanque_ancho11png') }}" alt=""> @endif
                        <div class="row" id="div_3b6e_7">
                           <div class="col-md-6" align="center">
                              <img src="{{Request::root()}}/images/bomba2.png" width="20%" alt="" @if ($Datos["PlantaAgua"][2]->mt_value==0) style="filter: hue-rotate(128deg)" @else style="filter: hue-rotate(327deg)" @endif>
                           </div>
                           <div class="col-md-6" align="center">
                              <img src="{{Request::root()}}/images/bomba2.png" width="20%" alt="" @if ($Datos["PlantaAgua"][3]->mt_value==0) style="filter: hue-rotate(128deg)" @else style="filter: hue-rotate(327deg)" @endif>
                           </div>
                        </div>

                        </div>
                      </div>
                      <div class="body table-responsive" align="center" style='margin-top:25px; max-height: 200px'>
                          <table class="table sicut-table-bordered sicut-modal-table1 pozo_nave_table">
                            <thead>
                              <th class="sicut-th">Hrs</th>
                              <th class="sicut-th">Tq. 1</th>
                              <th class="sicut-th">Tq. 2</th>
                              <th class="sicut-th">B. 1001</th>
                              <th class="sicut-th">B. 1002</th>
                              <th class="sicut-th">B. 1011</th>
                              <th class="sicut-th">B. 1011</th>
                            </thead>
                            <caption scope="row" class="sicut-tabla-titulo">Planta Agua <i class="fa fa-volume-up" style="cursor: pointer;display:none;color: red;margin-left: 20px;"></i></caption>
                            <tbody style="overflow: auto;">
                              @for ($i = 0; $i <60 ; $i++)
                              <tr>
                                    <th class="sicut-th">{{date_format(date_create($Datos["PlantaAguaTabla"]["BajoTK100"][$i]->mt_time), 'H:i') }}</th>
                                    <th class="sicut-th">
                                      @if ( ($Datos["PlantaAguaTabla"]["BajoTK100"][$i]->mt_value)+($Datos["PlantaAguaTabla"]["AltoTK100"][$i]->mt_value)==0 )
                                        <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>
                                      @endif

                                      @if ( ($Datos["PlantaAguaTabla"]["BajoTK100"][$i]->mt_value)+($Datos["PlantaAguaTabla"]["AltoTK100"][$i]->mt_value)==1 )
                                        <i class="material-icons"  style="color: orange;font-size: 15px;">warning</i>
                                      @endif

                                      @if ( ($Datos["PlantaAguaTabla"]["BajoTK100"][$i]->mt_value)+($Datos["PlantaAguaTabla"]["AltoTK100"][$i]->mt_value)==2 )
                                        <i class="material-icons" style="color: red;font-size: 15px;">error</i>
                                      @endif

                                    </th>
                                    <th class="sicut-th">
                                      @if ( ($Datos["PlantaAguaTabla"]["BajoTK101"][$i]->mt_value)+($Datos["PlantaAguaTabla"]["AltoTK101"][$i]->mt_value)==0 )
                                        <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>
                                      @endif

                                      @if ( ($Datos["PlantaAguaTabla"]["BajoTK101"][$i]->mt_value)+($Datos["PlantaAguaTabla"]["AltoTK101"][$i]->mt_value)==1 )
                                        <i class="material-icons"  style="color: orange;font-size: 15px;">warning</i>
                                      @endif

                                      @if ( ($Datos["PlantaAguaTabla"]["BajoTK101"][$i]->mt_value)+($Datos["PlantaAguaTabla"]["AltoTK101"][$i]->mt_value)==2 )
                                        <i class="material-icons" style="color: red;font-size: 15px;">error</i>
                                      @endif

                                    </th>


                                    <th class="sicut-th">
                                      @if ($Datos["PlantaAguaTabla"]["Bomba1001"][$i]->mt_value==0)
                                        <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>
                                        @else
                                        <i class="material-icons" style="color: red;font-size: 15px;">error</i>
                                      @endif
                                    </th>
                                    <th class="sicut-th">
                                      @if ($Datos["PlantaAguaTabla"]["Bomba1002"][$i]->mt_value==0)
                                        <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>
                                        @else
                                        <i class="material-icons" style="color: red;font-size: 15px;">error</i>
                                      @endif
                                    </th>
                                    <th class="sicut-th">
                                      @if ($Datos["PlantaAguaTabla"]["Bomba1011"][$i]->mt_value==0)
                                        <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>
                                        @else
                                        <i class="material-icons" style="color: red;font-size: 15px;">error</i>
                                      @endif
                                    </th>
                                    <th class="sicut-th">
                                      @if ($Datos["PlantaAguaTabla"]["Bomba1012"][$i]->mt_value==0)
                                        <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>
                                        @else
                                        <i class="material-icons" style="color: red;font-size: 15px;">error</i>
                                      @endif
                                    </th>
                              </tr>
                              @endfor
                            </tbody>
                        </table>
                      </div>
                     </div>
                     <div class="col-md-1"></div>
                  </div>
               </div>
               <div class="col-md-5">
                  <h1 align="center" id="h1_3b6e_2">Dinamometro</h1>
                  <div class="row">
                     <div class="col-md-2 bombas_dinamometro" style="padding-left: 0px !important;padding-right: 0px !important" align="center">
                        <p id="p_3b6e_0">Bom 601</p>
                        <img src="{{Request::root()}}/images/bomba2.png" width="35%" alt="" @if ($Datos["Dinamometro"][0]->mt_value==0) style="filter: hue-rotate(128deg)" @else style="filter: hue-rotate(327deg)" @endif><br><br>
                        <p id="p_3b6e_1">Bom 602</p>
                        <img src="{{Request::root()}}/images/bomba2.png" width="35%" alt="" @if ($Datos["Dinamometro"][1]->mt_value==0) style="filter: hue-rotate(128deg)" @else style="filter: hue-rotate(327deg)" @endif><br><br>
                     </div>
                     <div class="col-md-2 bombas_dinamometro" style="padding-left: 0px !important;padding-right: 0px !important" align="center">
                        <p id="p_3b6e_2">Bom 603</p>
                        <img src="{{Request::root()}}/images/bomba2.png" width="35%" alt="" @if ($Datos["Dinamometro"][2]->mt_value==0) style="filter: hue-rotate(128deg)" @else style="filter: hue-rotate(327deg)" @endif><br><br>
                        <p id="p_3b6e_3">Bom 604</p>
                        <img src="{{Request::root()}}/images/bomba2.png" width="35%" alt="" @if ($Datos["Dinamometro"][3]->mt_value==0) style="filter: hue-rotate(128deg)" @else style="filter: hue-rotate(327deg)" @endif><br><br>
                     </div>
                     <div class="col-md-2 bombas_dinamometro" style="padding-left: 0px !important;padding-right: 0px !important" align="center">
                        <p id="p_3b6e_4">Bom 605</p>
                        <img src="{{Request::root()}}/images/bomba2.png" width="35%" alt="" @if ($Datos["Dinamometro"][4]->mt_value==0) style="filter: hue-rotate(128deg)" @else style="filter: hue-rotate(327deg)" @endif><br><br>
                        <p id="p_3b6e_5">Bom 606</p>
                        <img src="{{Request::root()}}/images/bomba2.png" width="35%" alt="" @if ($Datos["Dinamometro"][5]->mt_value==0) style="filter: hue-rotate(128deg)" @else style="filter: hue-rotate(327deg)" @endif><br><br>
                     </div>
                     <div class="col-md-2 bombas_dinamometro" style="padding-left: 0px !important;padding-right: 0px !important" align="center">
                        <p id="p_3b6e_6">Bom 607</p>
                        <img src="{{Request::root()}}/images/bomba2.png" width="35%" alt="" @if ($Datos["Dinamometro"][6]->mt_value==0) style="filter: hue-rotate(128deg)" @else style="filter: hue-rotate(327deg)" @endif><br><br>
                        <p id="p_3b6e_7">Bom 608</p>
                        <img src="{{Request::root()}}/images/bomba2.png" width="35%" alt="" @if ($Datos["Dinamometro"][7]->mt_value==0) style="filter: hue-rotate(128deg)" @else style="filter: hue-rotate(327deg)" @endif><br><br>
                     </div>
                     <div class="col-md-4" align="center">
                        <ul id="ul_3b6e_0">
                           @if ($Datos["Dinamometro"][8]->mt_value==0) <img style="width: 65px" id="img_3b6e_9" src="{{ asset('images/tanque_dina0.png') }}" alt=""> @else <img style="width: 65px" id="img_3b6e_10" src="{{ asset('images/tanque_dina1.png') }}" alt=""> @endif
                           @if ($Datos["Dinamometro"][9]->mt_value==0) <img style="width: 65px" id="img_3b6e_11" src="{{ asset('images/tanque_dina0.png') }}" alt=""> @else <img style="width: 65px" id="img_3b6e_12" src="{{ asset('images/tanque_dina1.png') }}" alt=""> @endif
                        </ul>
                     </div>
                  </div>
                  <div class="body table-responsive" align="center" style='max-height: 200px'>
                          <table class="table sicut-table-bordered sicut-modal-table1 pozo_nave_table">
                            <thead>
                              <th class="sicut-th">Hrs</th>
                              <th class="sicut-th">B.601</th>
                              <th class="sicut-th">B.602</th>
                              <th class="sicut-th">B.603</th>
                              <th class="sicut-th">B.604</th>
                              <th class="sicut-th">B.605</th>
                              <th class="sicut-th">B.606</th>
                              <th class="sicut-th">B.607</th>
                              <th class="sicut-th">B.608</th>
                              <th class="sicut-th">Sl 1</th>
                              <th class="sicut-th">Sl 2</th>
                            </thead>
                            <caption scope="row" class="sicut-tabla-titulo">Dinamometro <i class="fa fa-volume-up" style="cursor: pointer;display:none;color: red;margin-left: 20px;"></i></caption>
                            <tbody style="overflow: auto;">
                              @for ($i = 0; $i <60 ; $i++)
                              <tr>
                                    <th class="sicut-th">{{date_format(date_create($Datos["DinamometroTabla"]["ErrorBomba601"][$i]->mt_time), 'H:i') }}</th>
                                    <th class="sicut-th">
                                      @if ($Datos["DinamometroTabla"]["ErrorBomba601"][$i]->mt_value==0)
                                        <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>
                                      @else
                                        <i class="material-icons" style="color: red;font-size: 15px;">error</i>
                                      @endif
                                    </th>
                                    <th class="sicut-th">
                                      @if ($Datos["DinamometroTabla"]["ErrorBomba602"][$i]->mt_value==0)
                                        <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>
                                      @else
                                        <i class="material-icons" style="color: red;font-size: 15px;">error</i>
                                      @endif
                                    </th>
                                    <th class="sicut-th">
                                      @if ($Datos["DinamometroTabla"]["ErrorBomba603"][$i]->mt_value==0)
                                        <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>
                                      @else
                                        <i class="material-icons" style="color: red;font-size: 15px;">error</i>
                                      @endif
                                    </th>
                                    <th class="sicut-th">
                                      @if ($Datos["DinamometroTabla"]["ErrorBomba604"][$i]->mt_value==0)
                                        <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>
                                      @else
                                        <i class="material-icons" style="color: red;font-size: 15px;">error</i>
                                      @endif
                                    </th>
                                    <th class="sicut-th">
                                      @if ($Datos["DinamometroTabla"]["ErrorBomba605"][$i]->mt_value==0)
                                        <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>
                                      @else
                                        <i class="material-icons" style="color: red;font-size: 15px;">error</i>
                                      @endif
                                    </th>
                                    <th class="sicut-th">
                                      @if ($Datos["DinamometroTabla"]["ErrorBomba606"][$i]->mt_value==0)
                                        <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>
                                      @else
                                        <i class="material-icons" style="color: red;font-size: 15px;">error</i>
                                      @endif
                                    </th>
                                    <th class="sicut-th">
                                      @if ($Datos["DinamometroTabla"]["ErrorBomba607"][$i]->mt_value==0)
                                        <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>
                                      @else
                                        <i class="material-icons" style="color: red;font-size: 15px;">error</i>
                                      @endif
                                    </th>
                                    <th class="sicut-th">
                                      @if ($Datos["DinamometroTabla"]["ErrorBomba608"][$i]->mt_value==0)
                                        <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>
                                      @else
                                        <i class="material-icons" style="color: red;font-size: 15px;">error</i>
                                      @endif
                                    </th>

                                    <th class="sicut-th">
                                      @if ($Datos["DinamometroTabla"]["InundacionSala1"][$i]->mt_value==0)
                                        <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>
                                      @else
                                        <i class="material-icons" style="color: red;font-size: 15px;">error</i>
                                      @endif
                                    </th>
                                    <th class="sicut-th">
                                      @if ($Datos["DinamometroTabla"]["InundacionSala2"][$i]->mt_value==0)
                                        <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>
                                      @else
                                        <i class="material-icons" style="color: red;font-size: 15px;">error</i>
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
   $( ".display-modal" ).click();
   $(".loader-insta").css("display", "none");
   
   function GraficarFinning() {
     var win = window.open(location.href+'/../ExportarFinning?FechaInicio='+$("#fecha_flujo_inicio").val()+'&FechaFin='+$("#fecha_flujo_fin").val(), '_blank');
     win.focus();
   }
   
   
   window.segti=0;
   
   var myTimer = window.setInterval(function(){
   
     window.segti++;
     // console.log(window.segti);  
     if (Number(window.segti)==Number(60)) {
       // console.log("LISTOOOOO")
       clearInterval(myTimer);
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
   
   }, 1000);
   
   
   function pauseAudio() { 
     var x = document.getElementById("notifi"); 
     x.loop = true;
     x.pause(); 
   }
     window.PrimeraVez="Si";
     window.AlarmaPrimera=true;
   
     $('#largeModal').on('hidden.bs.modal', function () {
        window.AlarmaPrimera=false;
       window.request.abort();
     })
   

   
   
  
   
   var PlantaAgua1=[];
   var PlantaAgua2=[];
   var mt_time=[];
   
   
   $("#fecha_flujo_inicio").val(window.FechaInicio);
     
   $("#fecha_flujo_fin").val(window.FechaFin);
  

   
   
   
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