<button type="button" class="btn btn-default waves-effect m-r-20 display-modal" data-toggle="modal" data-target="#largeModal" style="display: none"></button>
<!-- Large Size -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-lg" role="document" style="width: 95%;margin-top: 2%;">
      <div class="modal-content">
         <div class="modal-header">
            <div class="row">
               <div class="col-md-2">
                  <h4 class="modal-title nombre-instalacion" id="largeModalLabel" >Finning</h4>
               </div>
               <div class="col-md-5">
                  <h4 class="modal-title nombre-instalacion" id="largeModalLabel">Ultima Mendicion:  {{$Datos["Dinamometro"][count($Datos["Dinamometro"])-1]->mt_time}}</h4>
               </div>
               <div class="col-md-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="fecha_flujo_inicio" class="datetimepicker form-control" placeholder="Fecha Inicio">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="fecha_flujo_fin" class="datetimepicker form-control" placeholder="Fecha Fin">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button onclick="GraficarFinning();" type="button" class="btn btn-primary waves-effect">→</button>
                        </div>
            </div>
         </div>
         <hr style=" color: black">
         <div class="modal-body table-custom">
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
                           <table class="table sicut-table-bordered sicut-modal-table1">
                             <thead>
                                 </thead><caption scope="row" class="sicut-tabla-titulo">Pozo nave 4</caption>
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
                           <table class="table sicut-table-bordered sicut-modal-table1">
                             <thead>
                                 </thead><caption scope="row" class="sicut-tabla-titulo">Planta de agua</caption>
                             <tbody>
                                 <tr>
                                     <th class="sicut-th">Bomba 1</th>
                                     <td>@if ($Datos["PlantaAgua"][0]->mt_value==1) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                 </tr>
                                 <tr>
                                     <th class="sicut-th">Bomba 2</th>
                                     <td>@if ($Datos["PlantaAgua"][1]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                 </tr>
                                 <tr>
                                     <th class="sicut-th">Bomba 3</th>
                                     <td>@if ($Datos["PlantaAgua"][2]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                 </tr>
                                 <tr>
                                     <th class="sicut-th">Bomba 4</th>
                                     <td>@if ($Datos["PlantaAgua"][3]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                 </tr>
                                 <tr>
                                     <th class="sicut-th">Nivel Bajo TK-100</th>
                                     <td>@if ($Datos["PlantaAgua"][4]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                 </tr>
                                 <tr>
                                     <th class="sicut-th">Nivel Alto TK-100</th>
                                     <td>@if ($Datos["PlantaAgua"][5]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                 </tr>
                                 <tr>
                                     <th class="sicut-th">Nivel Bajo TK-101</th>
                                     <td>@if ($Datos["PlantaAgua"][6]->mt_value==1) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                 </tr>
                                 <tr>
                                     <th class="sicut-th">Nivel Alto TK-101</th>
                                     <td>@if ($Datos["PlantaAgua"][7]->mt_value==1) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                 </tr>
                             </tbody>
                         </table>
                       </div>
                     </div>

                     <div class="col-md-4">
                       <div class="body table-responsive">
                           <table class="table sicut-table-bordered sicut-modal-table1">
                             <thead>
                                 </thead><caption scope="row" class="sicut-tabla-titulo">Dinamometro</caption>
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
                                     <td>@if ($Datos["Dinamometro"][4]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                 </tr>
                                  <tr>
                                     <th class="sicut-th">Bomba 606</th>
                                     <td>@if ($Datos["Dinamometro"][5]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                 </tr>
                                  <tr>
                                     <th class="sicut-th">Bomba 607</th>
                                     <td>@if ($Datos["Dinamometro"][6]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                 </tr>
                                  <tr>
                                     <th class="sicut-th">Bomba 608</th>
                                     <td>@if ($Datos["Dinamometro"][7]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                 </tr>
                                 <tr>
                                     <th class="sicut-th">Inundación sala 1</th>
                                     <td>@if ($Datos["Dinamometro"][8]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                 </tr>
                                 <tr>
                                     <th class="sicut-th">Inundación sala 2</th>
                                     <td>@if ($Datos["Dinamometro"][9]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                 </tr>
                             </tbody>
                         </table>
                       </div>
                     </div>



                     <div class="col-md-12" style="margin-top: 20px">
                       <div class="body table-responsive">
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
                             <tbody>
                              @php $k=0; @endphp
                              @for ($i = 0; $i < 15; $i++)
                                <tr>
                                    <td>{{ date_format(date_create($Datos["PlantaAgua15"][$k]->mt_time), 'H:i:s')}}</td>
                                     <td><i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i></td>
                                     <td><i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i></td>
                                     <td><i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i></td>
                                     <td><i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i></td>
                                     @php $f=$k+8; @endphp
                                     @for ($k = $k; $k < $f; $k++)
                                       @if ($k<120)
                                           @if ($Datos["PlantaAgua15"][$k]->mt_name=="PlantaAgua--Consumo.NivelBajoTK101" || $Datos["PlantaAgua15"][$k]->mt_name=="PlantaAgua--Consumo.NivelBajoTK100" || $Datos["PlantaAgua15"][$k]->mt_name=="PlantaAgua--Consumo.FallaBomba1001")
                                               <td>@if ($Datos["PlantaAgua15"][$k]->mt_value==1) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                            @else
                                                <td>@if ($Datos["PlantaAgua15"][$k]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                           @endif
                                       @endif
                                     @endfor
                                     <td>@if ($Datos["Dinamometro15"][$i]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                     <td>@if ($Datos["Dinamometro15"][$i]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                     <td>@if ($Datos["Dinamometro15"][$i]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                     <td>@if ($Datos["Dinamometro15"][$i]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                     <td>@if ($Datos["Dinamometro15"][$i]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                     <td>@if ($Datos["Dinamometro15"][$i]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                     <td>@if ($Datos["Dinamometro15"][$i]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                     <td>@if ($Datos["Dinamometro15"][$i]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                     <td>@if ($Datos["Dinamometro15"][$i]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
                                     <td>@if ($Datos["Dinamometro15"][$i]->mt_value==0) <i class="material-icons"  style="color: green;font-size: 15px;">check_circle</i>  @else <i class="material-icons" style="color: red;font-size: 15px;"> error</i> @endif</td>
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
            
</script>