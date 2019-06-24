<script>
  $('#largeModal').modal('hide');
  $(".modal-backdrop.fade.in").remove();
  window.sound = new Howl({
            src: ['{{ asset('Notificaciones/noti_1.mp3') }}'],
            autoplay: true,
            volume: 0.5,
        });
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
                  <h4 class="modal-title nombre-instalacion" id="largeModalLabel">Ultima Mendicion:  {{$Datos["Dinamometro"][count($Datos["Dinamometro"])-1]->mt_time}}</h4>
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
         <div class="modal-body table-custom" style="padding-top: 0;margin-top: -5px">
            <div class="body">
               <!-- Nav tabs -->
               <ul class="nav nav-tabs tab-nav-right" role="tablist">
                  <li role="presentation" class="active"><a href="#home" data-toggle="tab">Panel</a></li>
                  <li role="presentation" id="parametros"><a href="#profile" data-toggle="tab">Parametros</a></li>
               </ul>
               <!-- Tab panes -->
               <div class="tab-content">
                  <div role="tabpanel" class="tab-pane fade in active" id="home">
                     <div class="col-md-4">
                       <div class="body table-responsive">
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
                     <div class="col-md-4">
                       <div class="body table-responsive">
                           <table class="table sicut-table-bordered sicut-modal-table1 planta_agua_table">
                             <thead>
                                 </thead><caption scope="row" class="sicut-tabla-titulo">Planta de agua <i class="fa fa-volume-up" onclick='window.sound.pause();$(this).hide()' style="cursor: pointer;display:none;color: red;margin-left: 20px;"></i></caption>
                             <tbody>
                                 <tr>
                                     <th class="sicut-th">Bomba 1</th>
                                     <td>@if ($Datos["PlantaAgua"][0]->mt_value==1) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;">error</i> @endif</td>
                                 </tr>
                                 <tr>
                                     <th class="sicut-th">Bomba 2</th>
                                     <td>@if ($Datos["PlantaAgua"][1]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;">error</i> @endif</td>
                                 </tr>
                                 <tr>
                                     <th class="sicut-th">Bomba 3</th>
                                     <td>@if ($Datos["PlantaAgua"][2]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;">error</i> @endif</td>
                                 </tr>
                                 <tr>
                                     <th class="sicut-th">Bomba 4</th>
                                     <td>@if ($Datos["PlantaAgua"][3]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;">error</i> @endif</td>
                                 </tr>
                                 <tr>
                                     <th class="sicut-th">Nivel Bajo TK-100</th>
                                     <td>@if ($Datos["PlantaAgua"][4]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;">error</i> @endif</td>
                                 </tr>
                                 <tr>
                                     <th class="sicut-th">Nivel Alto TK-100</th>
                                     <td>@if ($Datos["PlantaAgua"][5]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;">error</i> @endif</td>
                                 </tr>
                                 <tr>
                                     <th class="sicut-th">Nivel Bajo TK-101</th>
                                     <td>@if ($Datos["PlantaAgua"][6]->mt_value==1) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;">error</i> @endif</td>
                                 </tr>
                                 <tr>
                                     <th class="sicut-th">Nivel Alto TK-101</th>
                                     <td>@if ($Datos["PlantaAgua"][7]->mt_value==1) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;">error</i> @endif</td>
                                 </tr>
                             </tbody>
                         </table>
                       </div>
                     </div>

                     <div class="col-md-4">
                       <div class="body table-responsive">
                           <table class="table sicut-table-bordered sicut-modal-table1 dinamometro_table">
                             <thead>
                                 </thead><caption scope="row" class="sicut-tabla-titulo">Dinamometro <i class="fa fa-volume-up" style="cursor: pointer;display: none;color: red;margin-left: 20px;" onclick='window.sound.pause();$(this).hide()'></i></caption>
                             <tbody>
                                 <tr>
                                     <th class="sicut-th">Bomba 601</th>
                                     <td>@if ($Datos["Dinamometro"][0]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                 </tr>
                                 <tr>
                                     <th class="sicut-th">Bomba 602</th>
                                     <td>@if ($Datos["Dinamometro"][1]->mt_value==1) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                 </tr>
                                 <tr>
                                     <th class="sicut-th">Bomba 603</th>
                                     <td>@if ($Datos["Dinamometro"][2]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                 </tr>
                                 <tr>
                                     <th class="sicut-th">Bomba 604</th>
                                     <td>@if ($Datos["Dinamometro"][3]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                 </tr>
                                  <tr>
                                     <th class="sicut-th">Bomba 605</th>
                                     <td>@if ($Datos["Dinamometro"][4]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;">error</i> @endif</td>
                                 </tr>
                                  <tr>
                                     <th class="sicut-th">Bomba 606</th>
                                     <td>@if ($Datos["Dinamometro"][5]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;">error</i> @endif</td>
                                 </tr>
                                  <tr>
                                     <th class="sicut-th">Bomba 607</th>
                                     <td>@if ($Datos["Dinamometro"][6]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;">error</i> @endif</td>
                                 </tr>
                                  <tr>
                                     <th class="sicut-th">Bomba 608</th>
                                     <td>@if ($Datos["Dinamometro"][7]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;">error</i> @endif</td>
                                 </tr>
                                 <tr>
                                     <th class="sicut-th">Inundación sala 1</th>
                                     <td>@if ($Datos["Dinamometro"][8]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;">error</i> @endif</td>
                                 </tr>
                                 <tr>
                                     <th class="sicut-th">Inundación sala 2</th>
                                     <td>@if ($Datos["Dinamometro"][9]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;">error</i> @endif</td>
                                 </tr>
                             </tbody>
                         </table>
                       </div>
                     </div>



                     <div class="col-md-12" style="margin-top: 20px">
                       <div class="body table-responsive">
                            @php
                             if (count($Datos["PlantaAgua15"])<count($Datos["Dinamometro15"])) $Mayor=count($Datos["Dinamometro15"])-1; else $Mayor=count($Datos["PlantaAgua15"])-1; 
                             @endphp
                            <table class="table sicut-table-bordered sicut-modal-table1">
                              <thead align="center">


                                <td>Fecha Hora</td>
                                <td>Nivel ↓</td>
                                <td>Nivel ↑ pozo</td>
                                <td>Nivel ↑</td>
                                <td>Nivel ↑ TK</td>

                                <td>Bom 1</td>
                                <td>Bom 2</td>
                                <td>Bom 3</td>
                                <td>Bom 4</td>
                                <td>Nvl ↑ TK-100</td>
                                <td>Nvl ↑ TK-101</td>
                                <td>Nvl ↓ TK-100</td>
                                <td>Nvl ↓ TK-101</td>
                                
                                <td>Bom 601</td>
                                <td>Bom 602</td>
                                <td>Bom 603</td>
                                <td>Bom 604</td>
                                <td>Bom 605</td>
                                <td>Bom 606</td>
                                <td>Bom 607</td>
                                <td>Bom 608</td>
                                <td>Inun. Sala 1</td>
                                <td>Inun. Sala 2</td>
                              </thead>
                              <tbody>

                                @php $j=0; $h=0; @endphp
                                @for ($i = 0; $i < $Mayor; $i++)
                                    <tr>
                                      
                                      @if (!isset($Datos["Dinamometro15"][$i+$h+9])) @php break; @endphp @endif

                                      <td>{{ date_format(date_create($Datos["Dinamometro15"][$i+$h]->mt_time), 'H:i:s')}}</td>
                                      <td><i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i></td>
                                      <td><i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i></td>
                                      <td><i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i></td>
                                      <td><i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i></td>

                                      @if (isset($Datos["PlantaAgua15"][$i+$j+7]))
                                        <td>@if ($Datos["PlantaAgua15"][$i+$j]->mt_value==1) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i> @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                        <td>@if ($Datos["PlantaAgua15"][$i+$j+1]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i> @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                        <td>@if ($Datos["PlantaAgua15"][$i+$j+2]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i> @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                        <td>@if ($Datos["PlantaAgua15"][$i+$j+3]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i> @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                        <td>@if ($Datos["PlantaAgua15"][$i+$j+4]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i> @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                        <td>@if ($Datos["PlantaAgua15"][$i+$j+5]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i> @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                        <td>@if ($Datos["PlantaAgua15"][$i+$j+6]->mt_value==1) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i> @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                        <td>@if ($Datos["PlantaAgua15"][$i+$j+7]->mt_value==1) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i> @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                        @php $j=$j+7; @endphp
                                      @endif




                                      @if (isset($Datos["Dinamometro15"][$i+$h+9]))
                                        <td>@if ($Datos["Dinamometro15"][$i+$h]->mt_name==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i> @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif  </td>
                                        <td>@if ($Datos["Dinamometro15"][$i+$h+1]->mt_name==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i> @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif </td>
                                        <td>@if ($Datos["Dinamometro15"][$i+$h+2]->mt_name==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i> @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif </td>
                                        <td>@if ($Datos["Dinamometro15"][$i+$h+3]->mt_name==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i> @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif </td>
                                        <td>@if ($Datos["Dinamometro15"][$i+$h+4]->mt_name==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i> @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif </td>
                                        <td>@if ($Datos["Dinamometro15"][$i+$h+5]->mt_name==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i> @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif </td>
                                        <td>@if ($Datos["Dinamometro15"][$i+$h+6]->mt_name==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i> @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif </td>
                                        <td>@if ($Datos["Dinamometro15"][$i+$h+7]->mt_name==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i> @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif </td>
                                        <td>@if ($Datos["Dinamometro15"][$i+$h+8]->mt_name==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i> @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif </td>
                                        <td>@if ($Datos["Dinamometro15"][$i+$h+9]->mt_name==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i> @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif </td>
                                        @php $h=$h+9; @endphp
                                      @else
                                      @endif
                                    </tr>
                                @endfor
                              </tbody>
                            </table>
                       </div>
                     </div>

                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="profile">
                     <div id="MaitenalParametros"></div>
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
<style>
   div .btn-bomba{
   color: #2b982b !important;
   font-size: 13px;
   }
   .boton-bombas{
   width: 9px;
   height: 16px;
   }            
   .tabla-titulo{
   background: #cccccc;
   border: 1px solid #cccccc;
   border-bottom: 0;
   text-align: center; 
   font-weight: 600; 
   color: black;
   padding-top: 4px;
   padding-bottom: 4px;
   border-top-left-radius: 10px;
   border-top-right-radius: 10px;
   }
   .nombre-instalacion{
   text-align: left;
   }
   .modal-table1 tbody tr th{
   padding-top: 0px !important;
   padding-bottom: 0px !important;
   padding-right: 0px !important;
   padding-left: 10px !important;
   text-align: left;
   }
   .modal-table1 tbody tr td{
   text-align: center;
   padding: 0px !important;
   }
   .table-bordered tbody tr td, .table-bordered tbody tr th {
   font-size: 13px;
   border-color: #cccccc;
   }
   .col-1-5{
   width: 20%;
   float: left;
   position: relative;
   min-height: 1px;
   padding-right: 15px;
   padding-left: 15px;
   }
   .table tbody tr td, .table tbody tr th {
   padding: 5px;
   }
   .table-custom table{
   font-size: 13px;
   }
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
          $("#contenedor").load("{{Request::root()}}/FinningController", {id: 6, tabla_asociada: "log_biofiltro03", rol: 1 })
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

    $(".pozo_nave_table td").map(function(){
    if ($(this).find("i").text()==" error") {
          $(".pozo_nave_table caption i").show();

          window.sound.play();
      }
    })

  $(".planta_agua_table td").map(function(){
    if ($(this).find("i").text()==" error") {
        $(".planta_agua_table caption i").show();

            window.sound.play();
        }
      })

  $(".dinamometro_table td").map(function(){
    if ($(this).find("i").text()==" error") {
        $(".dinamometro_table caption i").show();

            window.sound.play();
        }
      })

</script>