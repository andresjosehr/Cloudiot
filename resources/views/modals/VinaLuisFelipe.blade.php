
<button type="button" class="btn btn-default waves-effect m-r-20 display-modal vina-modal" data-toggle="modal" data-target="#largeModal"></button>
<!-- Large Size -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-lg vina-modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <p id="contenedorLFE"></p>
            <div class="row">
               <div class="col-md-4">
                  <h4 class="modal-title vina-nombre-instalacion" id="largeModalLabel" >{{ $Instalacion->nombre }}</h4>
               </div>
               <div class="col-md-4">
                  <h4 class="modal-title vina-nombre-instalacion" id="largeModalLabel">Última Mendición {{ $UltimaMedicion->mt_time }}</h4>
               </div>
            </div>
         </div>
         <div class="body">
         </div>
         <hr class="vina-hr">
         <div class="modal-body vina-table-custom">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
               <li role="presentation" class="active"><a href="#home" data-toggle="tab">Panel de control</a></li>
               <li role="presentation"><a href="#flujos" data-toggle="tab">Vista de Flujos</a></li>
               <li role="presentation" id="GraficarPHDiario"><a href="#PHDiarios" data-toggle="tab">Vista de PH diarios</a></li>
               <li role="presentation" id="parametros"><a href="#profile" data-toggle="tab">Parametros de Configuracion</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <div role="tabpanel" class="tab-pane fade in active" id="home">
                  <div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="row">
                              <div class="col-md-6 vina-listar-bombas" id="ListarBombas">
                                 <h4 align="left" class="vina-title-table">Flujos</h4>
                                 <div class="body table-responsive">
                                    <table class="table vina-table table-striped">
                                       <thead>
                                          <tr>
                                             <th class="vina-th1">Fecha
                                 </div>
                                 </th>
                                 <th class="vina-th1">Min&nbsp;Op.</th>
                                 <th class="vina-th1">m3</th>
                                 <th class="vina-th1">Bombas</th>
                                 </tr>
                                 </thead>
                                 @if ($ImprimirBombas==true)
                                    <tbody align="center">
                                       @php
                                       $i=0;
                                       @endphp
                                       @foreach ($Bombas as $Bomba)
                                       <tr>
                                          <td><?php echo date_format(date_create($Bomba["FechaInicio"]), 'm-d H:i'); ?></td>
                                          <td>{{ $Bomba["MinutosOperativa"] }}</td>
                                          <td>{{ $Bomba["Flujo"] }}</td>
                                          <td>
                                          @if ($Bomba["NumeroDeBomba"][1]==1)
                                             <i class="material-icons vina-btn-bomba">add_circle</i>
                                          @endif
                                          @if ($Bomba["NumeroDeBomba"][1]==0)
                                             <i class="material-icons vina-btn-bomba vina-bomb-desc">add_circle</i>
                                          @endif
                                          @if ($Bomba["NumeroDeBomba"][2]==1)
                                             <i class="material-icons vina-btn-bomba">add_circle</i>
                                          @endif
                                          @if ($Bomba["NumeroDeBomba"][2]==0)
                                             <i class="material-icons vina-btn-bomba vina-bomb-desc">add_circle</i>
                                          @endif
                                          @if ($Bomba["NumeroDeBomba"][3]==1)
                                             <i class="material-icons vina-btn-bomba">add_circle</i>
                                          @endif
                                          @if ($Bomba["NumeroDeBomba"][3]==0)
                                             <i class="material-icons vina-btn-bomba vina-bomb-desc">add_circle</i>
                                          @endif
                                          </td>
                                       </tr>
                                       @php
                                       $i++;
                                       @endphp
                                       @endforeach
                                    </tbody>
                                 @endif
                                 </table>
                                 @if ($ImprimirBombas==false)
                                    <div>
                                       <p>Sin datos de Bombas activas en las ultimas 3 horas</p>
                                       <p>Haga click para obetener datos en una fecha de mayor rango</p>
                                    </div>
                                 @endif
                              </div>
                           </div>
                           <div class="col-md-6">
                              <h4 align="left" class="vina-alarmas-title">Alarmas</h4>
                              <div class="body table-responsive">
                                 <table class="table table-striped">
                                    <thead>
                                       <tr>
                                          <th>Fecha / Hora</th>
                                          <th>Obs</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @for ($i = 0; $i < 10 ; $i++)
                                          <tr>
                                             <td></td>
                                             <td></td>
                                          </tr>
                                       @endfor
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                           <div class="col-md-6" align="center">
                              <div class="vina-loading-bomba"></div>
                              <div class="vina-cargando  bombas-cargando">
                                 <div class="row">
                                    <div class="col-md-4">
                                       Bomba 1
                                    </div>
                                    <div class="col-md-1">
                                       <button type="button" class="btncasc0 btn bg-green btn-circle waves-effect waves-circle waves-float vina-circle-custom">
                                       <i class="material-icons bomba0-op-btn">check</i>
                                       </button>
                                       <br>
                                    </div>
                                    <div class="col-md-3">
                                       <span class="badge bg-red bomba0-op">No Op.</span>
                                    </div>
                                    <div class="col-md-3">
                                       <button type="button" class="vina-btn-bomba-error0 btn bg-red waves-effect vina-btn_error_custom">
                                       <span class="vina-custom-error texto-error0">Error</span>
                                       </button>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-4">
                                       Bomba 2
                                    </div>
                                    <div class="col-md-1">
                                       <button type="button" class="btncasc1 btn bg-red btn-circle waves-effect waves-circle waves-float vina-circle-custom">
                                       <i class="material-icons bomba1-op-btn">error_outline</i>
                                       </button>
                                       <br>
                                    </div>
                                    <div class="col-md-3">
                                       <span class="badge bg-green bomba1-op">Operativa</span>
                                    </div>
                                    <div class="col-md-3">
                                       <button type="button" class="vina-btn-bomba-error1 btn bg-red waves-effect vina-btn_error_custom">
                                       <span class="vina-custom-error texto-error1">Error</span>
                                       </button>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-4">
                                       Bomba 3
                                    </div>
                                    <div class="col-md-1">
                                       <button type="button" class="btncasc2 btn bg-green btn-circle waves-effect waves-circle waves-float vina-circle-custom">
                                       <i class="material-icons bomba2-op-btn">check</i>
                                       </button>
                                       <br>
                                    </div>
                                    <div class="col-md-3">
                                       <span class="badge bg-red bomba2-op">No Op.</span>
                                    </div>
                                    <div class="col-md-3">
                                       <button type="button" class="vina-btn-bomba-error2 btn bg-red waves-effect vina-btn_error_custom">
                                       <span class="vina-custom-error texto-error2">Error</span>
                                       </button>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-4">
                                       Bomba 4
                                    </div>
                                    <div class="col-md-1">
                                       <button type="button" class="btncasc3 btn bg-red btn-circle waves-effect waves-circle waves-float vina-circle-custom">
                                       <i class="material-icons bomba3-op-btn">error_outline</i>
                                       </button>
                                       <br>
                                    </div>
                                    <div class="col-md-3">
                                       <span class="badge bg-green bomba3-op">Operativa</span>
                                    </div>
                                    <div class="col-md-3">
                                       <button type="button" class="vina-btn-bomba-error3 btn bg-red waves-effect vina-btn_error_custom">
                                       <span class="vina-custom-error texto-error3">Error</span>
                                       </button>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-4">
                                       Bomba 5
                                    </div>
                                    <div class="col-md-1">
                                       <button type="button" class="btncasc4 btn bg-red btn-circle waves-effect waves-circle waves-float vina-circle-custom">
                                       <i class="material-icons bomba4-op-btn">error_outline</i>
                                       </button>
                                       <br>
                                    </div>
                                    <div class="col-md-3">
                                       <span class="badge bg-green bomba4-op">Operativa</span>
                                    </div>
                                    <div class="col-md-3">
                                       <button type="button" class="vina-btn-bomba-error4 btn bg-red waves-effect vina-btn_error_custom">
                                       <span class="vina-custom-error texto-error4">Error</span>
                                       </button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <canvas id="myChart0" height="50"></canvas>
                     </div>
                     <div class="col-md-6">
                        <div class="row">
                           <div class="col-md-4">
                              <div class="row">
                                 <p align="center"><b>PH</b></p>
                                 <div class="col-md-12" id="rpm-0">
                                    <div class="vina-loading"></div>
                                    <b class="vina-vertical">Entrada</b>
                                    <div>
                                       <img src="images/rpm.png" class="img-rpm-lfe">
                                       <canvas id="gauge0"></canvas>
                                    </div>
                                 </div>
                                 <div class="col-md-12 chart-lfe" id="chart-lfe1">
                                    <div class="vina-loading"></div>
                                    <img class="vina-cargando  img-chart-lfe" src="images/chart.png" class="img-rpm-lfe">
                                    <canvas id="myChart1" height="140"></canvas>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="row">
                                 <p><b align="center">ORP</b></p>
                                 <div class="col-md-12" id="rpm-1">
                                    <div class="vina-loading"></div>
                                    <div>
                                       <img src="images/rpm.png" class="img-rpm-lfe">
                                       <canvas id="gauge1"></canvas>
                                    </div>
                                 </div>
                                 <div class="col-md-12 chart-lfe" id="chart-lfe2">
                                    <div class="vina-loading"></div>
                                    <img class="vina-cargando  img-chart-lfe" src="images/chart.png" class="img-rpm-lfe">
                                    <canvas id="myChart2" height="140"></canvas>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="row">
                                 <p align="center"><b>Conductividad</b></p>
                                 <div class="col-md-12" id="rpm-2">
                                    <div class="vina-loading"></div>
                                    <div>
                                       <img src="images/rpm.png" class="img-rpm-lfe">
                                       <canvas id="gauge2"></canvas>
                                    </div>
                                 </div>
                                 <div class="col-md-12 chart-lfe" id="chart-lfe3">
                                    <div class="vina-loading"></div>
                                    <img class="vina-cargando  img-chart-lfe" src="images/chart.png" class="img-rpm-lfe">
                                    <canvas id="myChart3" height="140"></canvas>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row vina-row-rpm">
                           <div class="col-md-4">
                              <div class="row">
                                 <div class="col-md-12" id="rpm-3">
                                    <b class="vina-vertical">Salida</b>
                                    <div class="vina-loading"></div>
                                    <div>
                                       <img src="images/rpm.png" class="img-rpm-lfe">
                                       <canvas id="gauge3"></canvas>
                                    </div>
                                 </div>
                                 <div class="col-md-12 chart-lfe" id="chart-lfe4">
                                    <div class="vina-loading"></div>
                                    <img class="vina-cargando  img-chart-lfe" src="images/chart.png" class="img-rpm-lfe">
                                    <canvas id="myChart4" height="140"></canvas>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="row">
                                 <div class="col-md-12" id="rpm-4">
                                    <div class="vina-loading"></div>
                                    <div>
                                       <img src="images/rpm.png" class="img-rpm-lfe">
                                       <canvas id="gauge4"></canvas>
                                    </div>
                                 </div>
                                 <div class="col-md-12 chart-lfe" id="chart-lfe5">
                                    <div class="vina-loading"></div>
                                    <img class="vina-cargando  img-chart-lfe" src="images/chart.png" class="img-rpm-lfe">
                                    <canvas id="myChart5" height="140"></canvas>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="row">
                                 <div class="col-md-12" id="rpm-5">
                                    <div class="vina-loading"></div>
                                    <div>
                                       <img src="images/rpm.png" class="img-rpm-lfe">
                                       <canvas id="gauge5"></canvas>
                                    </div>
                                 </div>
                                 <div class="col-md-12 chart-lfe" id="chart-lfe6">
                                    <div class="vina-loading"></div>
                                    <img class="vina-cargando  img-chart-lfe" src="images/chart.png" class="img-rpm-lfe">
                                    <canvas id="myChart6" height="140"></canvas>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="profile">
               <div id='parametros-ejecucion'></div>
               <p>
               <div class="row clearfix">
                  <div class="col-md-2">
                     Tiempo de Riego
                  </div>
                  <div class="col-md-6 vina-parametro-unidad">
                     <div id="Riego" @if ($Usuario->rol==3)
                                       disabled='true'
                                    @endif class="noUi-target noUi-ltr noUi-horizontal"></div>
                     <div class='vina-parametro-info'>
                        <-----<b id="RiegoValor"></b><b> Minutos</b>----->
                     </div>
                  </div>
                  <div class="col-md-4">
                     @if ($Usuario->rol!=3)
                     <button onclick="RegistarRiego()" class="btn btn-primary btn-block boton1 vina-btn-parametro">Registrar</button>
                     @endif
                     <div class="vina-vina-loadingg vina-vina-loadingg1"></div>
                  </div>
               </div>
               <div class="row clearfix">
                  <div class="col-md-2">
                     Tiempo de Reposo
                  </div>
                  <div class="col-md-6 vina-parametro-unidad">
                     <div id="Reposo" @if ($Usuario->rol==3)
                        disabled='true'
                     @endif class="noUi-target noUi-ltr noUi-horizontal"></div>
                     <div class='vina-parametro-info'>
                        <-----<b id="ReposoValor"></b><b> Minutos</b>----->
                     </div>
                  </div>
                  <div class="col-md-4">
                     @if ($Usuario->rol!=3)
                     <button onclick="RegistarReposo()" class="btn btn-primary btn-block boton2 vina-btn-parametro">Registrar</button>
                     @endif
                     <div class="vina-vina-loadingg vina-vina-loadingg2"></div>
                  </div>
               </div>
               <div class="row clearfix">
                  <div class="col-md-2">
                     Rango de PH
                  </div>
                  <div class="col-md-6 vina-parametro-unidad">
                     <div id="slider" @if ($Usuario->rol==3)
                        disabled='true'
                     @endif class="noUi-target noUi-ltr noUi-horizontal"></div>
                     <div class='vina-parametro-info'>
                        <b id="BajoPH"></b><----------><b id="AltoPH"></b>
                     </div>
                  </div>
                  <div class="col-md-4">
                     @if ($Usuario->rol!=3)
                     <button onclick="RegistarRangoPH()" class="btn btn-primary btn-block boton3 vina-btn-parametro">Registrar</button>
                     @endif
                     <div class="vina-vina-loadingg vina-vina-loadingg3"></div>
                  </div>
               </div>
               </p>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="PHDiarios">
               <div id="PHDiarioContenedor"></div>
               <div class="row">
                <div id="contenedorLFE2"></div>
                  <div class="col-md-2">
                      <p class="modal-title" id="defaultModalLabel">Flujos</p>
                  </div>
                  <div class="col-md-3">
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                       <div class="form-line">
                           <input type="text" id="fecha_ph_inicio" class="datetimepicker form-control" placeholder="Fecha Inicio">
                       </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                       <div class="form-line">
                           <input type="text" id="fecha_ph_fin" class="datetimepicker form-control" placeholder="Fecha Fin">
                       </div>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <button onclick="GraficarphPersonalizado();" type="button" class="btn btn-primary waves-effect">→</button>
                  </div>
              </div>
               <div class="vina-vina-loadingPH"></div>
               <div id="ph-bar-chart-div">
                  <canvas id="ph-bar-chart" width="400" height="70"></canvas>
               </div>
               <div class="BotonExportarPHDiarios vina-BotonExportarPHDiarios">
                  <a onclick="DescargarExcelPHDiarios()" class="btn btn-primary" >Exportar datos a Excel</a>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="flujos">
               <div id="contenedorFlujos"></div>
              <div class="row">
                <div id="contenedorLFE2"></div>
                  <div class="col-md-2">
                      <p class="modal-title" id="defaultModalLabel">Flujos</p>
                  </div>
                  <div class="col-md-3">
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                       <div class="form-line">
                           <input type="text" id="fecha_flujo_inicio" class="datetimepicker form-control" placeholder="Fecha Inicio">
                       </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                       <div class="form-line">
                           <input type="text" id="fecha_flujo_fin" class="datetimepicker form-control" placeholder="Fecha Fin">
                       </div>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <button onclick="GraficarFlujoPersonalizado();" type="button" class="btn btn-primary waves-effect">→</button>
                  </div>
              </div>
              <div class="col-md-12">
               <div id="flujo-bar-chart-div">
                <canvas id="flujo-bar-chart" width="400" height="70"></canvas>
               </div>
                <div class="vina-DescargarExcelFlujosDiarios-padre">
                  <a onclick="DescargarExcelFlujosDiarios()" class="btn btn-primary" >Exportar datos a Excel</a>
                </div>
              </div>
            </div>
         </div>
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar ventana</button>
      </div>
   </div>
</div>
</div>
<style>
   .vina-vina-loadingg{
   width: 35px;
   height: 35px;
   border-radius:150px;
   border:6px solid #797979;
   border-top-color:rgba(0,0,0,0.3);
   box-sizing:border-box;
   position:absolute;
   top: 72px;
   left: 64%;
   margin-top:-80px;
   margin-left:-80px;
   animation:vina-loading 1.2s linear infinite;
   -webkit-animation:vina-loading 1.2s linear infinite;
   z-index: 1;
   display: none;
   }

   .vina-vina-loadingPH{
   width: 35px;
   height: 35px;
   border-radius:150px;
   border:6px solid #797979;
   border-top-color:rgba(0,0,0,0.3);
   box-sizing:border-box;
   position:absolute;
   top: 90%;
   left: 50%;
   animation:vina-loading 1.2s linear infinite;
   -webkit-animation:vina-loading 1.2s linear infinite;
   z-index: 1;
   }
   @keyframes vina-loading{
   0%{transform:rotate(0deg)}
   100%{transform:rotate(360deg)}
   }
   @-webkit-keyframes vina-loading{
   0%{-webkit-transform:rotate(0deg)}
   100%{-webkit-transform:rotate(360deg)}
   }
   .btncasc3, .btncasc4{
   display: none;
   }
   .img-chart-lfe{
   width: 95%;
   }
   .vina-cargando{
   filter: blur(4px);
   }
   #rpm-0 canvas, #rpm-1 canvas, #rpm-2 canvas, #rpm-3 canvas, #rpm-4 canvas, #rpm-5 canvas, #myChart1, #myChart2, #myChart3, #myChart4, #myChart5, #myChart6{
   display: none;
   }
   #gauge0, #gauge1, #gauge2, #gauge3, #gauge4, #gauge5{
   cursor: pointer;
   }
   .img-rpm-lfe{
   margin-bottom: -12px;
   }
   .vina-btn_error_custom{
   padding: 2px 12px;
   }
   .vina-ico_error_custom{
   font-size: 15px;
   }
   .vina-custom-error{
   font-size: 10px;
   }
   .vina-circle-custom{
   width: 20px;
   height: 20px;
   }
   .vina-circle-custom i{
   font-size: 13px !important;
   left: -6.5px !important;
   top: -2px !important;
   }
   .vina-vertical {
   writing-mode: vina-vertical-lr;
   transform: rotate(180deg);
   position: absolute;
   }
   .chart-lfe{
   margin-top: -30px;
   }
   .vina-btn-bomba{
   color: #2b982b;
   font-size: 13px;
   }
   .vina-boton-bombas{
   width: 9px;
   height: 16px;
   }           
   .vina-tabla-titulo{
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
   .vina-nombre-instalacion{
   text-align: left;
   }
   .vina-modal-table1 tbody tr th{
   padding-top: 0px !important;
   padding-bottom: 0px !important;
   padding-right: 0px !important;
   padding-left: 10px !important;
   text-align: left;
   }
   .vina-modal-table1 tbody tr td{
   text-align: center;
   padding: 0px !important;
   }
   .vina-table-bordered tbody tr td, .vina-table-bordered tbody tr th {
   font-size: 13px;
   border-color: #cccccc;
   }

   .vina-table tbody tr td, .vina-table tbody tr th {
   padding: 5px;
   }
   .vina-table-custom table{
   font-size: 13px;
   }
   .vina-loading{
   width: 35px;
   height: 35px;
   border-radius:150px;
   border:6px solid #797979;
   border-top-color:rgba(0,0,0,0.3);
   box-sizing:border-box;
   position:absolute;
   top: 99%;
   left: 76%;
   margin-top:-80px;
   margin-left:-80px;
   animation:vina-loading 1.2s linear infinite;
   -webkit-animation:vina-loading 1.2s linear infinite;
   z-index: 1;
   }
   .vina-loading-bomba{
   width: 35px;
   height: 35px;
   border-radius:150px;
   border:6px solid #797979;
   border-top-color:rgba(0,0,0,0.3);
   box-sizing:border-box;
   position:absolute;
   top: 89%;
   left: 54%;
   margin-top:-80px;
   margin-left:-80px;
   animation:vina-loading 1.2s linear infinite;
   -webkit-animation:vina-loading 1.2s linear infinite;
   z-index: 1;
   }
   @keyframes vina-loading{
   0%{transform:rotate(0deg)}
   100%{transform:rotate(360deg)}
   }
   @-webkit-keyframes vina-loading{
   0%{-webkit-transform:rotate(0deg)}
   100%{-webkit-transform:rotate(360deg)}
   }
</style>
<script  src="instalaciones/VinaLuisFelipe.js"></script>
<script>

   $.ajaxSetup({
       headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });

   function GraficarphPersonalizado() {
     var fecha_ph_inicio = document.getElementById("fecha_ph_inicio").value;
     var fecha_ph_fin = document.getElementById("fecha_ph_fin").value;
     $(".loader-insta").css("display", "block");
     var url = "<?php echo Request::root() ?>/CalculosLuisFelipe8";
     $("#PHDiarioContenedor").load(url, {FechaInicio: fecha_ph_inicio, FechaFin: fecha_ph_fin});
   }


   $("#GraficarPHDiario").click(function() {
      if (document.getElementById("ph-bar-chart").height==70) {
         var url = "<?php echo Request::root() ?>/CalculosLuisFelipe7";
         $("#PHDiarioContenedor").load(url, {dato: "Epa"});
      }
   });

   $("#ListarBombas").click(function() {
      $(".loader-insta").css("display", "block");
      var url = "<?php echo Request::root() ?>/CalculosLuisFelipe5";
      $("#contenedorLFE").load(url, {dato: "Epa"});
   });

   function GraficarFlujoPersonalizado() {

      $(".loader-insta").css("display", "block");

      var FechaInicio = document.getElementById('fecha_flujo_inicio').value;
      var FechaFin = document.getElementById('fecha_flujo_fin').value;

      var url = "<?php echo Request::root() ?>/CalculosLuisFelipe4";
       $("#contenedorFlujos").load(url, {FechaInicio: FechaInicio, FechaFin: FechaFin});
   }
   

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

    $('#fecha_ph_inicio').bootstrapMaterialDatePicker
    ({
      format: 'YYYY-MM-DD',
      lang: 'fr',
      weekStart: 1, 
      cancelText : 'ANNULER',
      nowButton : true,
      switchOnClick : true,
      time: false
    });

    $('#fecha_ph_fin').bootstrapMaterialDatePicker
    ({
      format: 'YYYY-MM-DD',
      lang: 'fr',
      weekStart: 1, 
      cancelText : 'ANNULER',
      nowButton : true,
      switchOnClick : true,
      time: false
    });



   var i=0;
   var mt_time = [];
   var mt_value = [];

   var mt_time_flujos = [];
   var mt_value_flujos = [];
   var labels= [];
   @foreach ($GraficoBarras as $Barra)
     mt_time[i]='{{ date_format(date_create($Barra->mt_time), 'm-j') }}';
     mt_value[i]='{{$Barra->mt_value}}';

     mt_time_flujos[i] = "{{$Barra->mt_time}}";
     mt_value_flujos = mt_value;
     i++;
   @endforeach

   GraficarFlujo(mt_time, mt_value);

   function DescargarExcelFlujosDiarios() {
       window.open('<?php echo Request::root() ?>/ExcelFlujosDiarios?mt_time='+mt_time_flujos+'&mt_value='+mt_value_flujos, '_blank' )
   }


function GraficarFlujo(mt_time, mt_value) {
   var ctx = document.getElementById("flujo-bar-chart").getContext('2d');
   var myChart = new Chart(ctx, {
     type: 'bar',
     data: {
         labels: mt_time,
         datasets: [{
             data: mt_value,
             backgroundColor: 'rgba(255, 99, 132, 0.8)',
             borderColor: 'rgba(255,99,132,1)',
             borderWidth: 1
         }]
     },
     options: {
      legend: {
         display: false
      },
      "animation": {
         "duration": 1,
         "onComplete": function() {
           var chartInstance = this.chart,
             ctx = chartInstance.ctx;

           ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
           ctx.textAlign = 'center';
           ctx.textBaseline = 'bottom';

           this.data.datasets.forEach(function(dataset, i) {
             var meta = chartInstance.controller.getDatasetMeta(i);
             meta.data.forEach(function(bar, index) {
               var data = dataset.data[index];
               ctx.fillText(data, bar._model.x, bar._model.y - 5);
             });
           });
         }
      },
         scales: {
             yAxes: [{
                 ticks: {
                     beginAtZero:true,
                     padding: 100
                 }
             }], xAxes: [{
                     padding: 50,
                     lineHeight: 3,
                 ticks: {
                     padding: 50,
                     lineHeight: 3
                 }
             }]
         }
     }
   });
}


function GraficarPHDiarioJS(mt_time, mt_value) {
         var ctx = document.getElementById("ph-bar-chart").getContext('2d');
         var myChart = new Chart(ctx, {
           type: 'bar',
           data: {
               labels: mt_time,
               datasets: [{
                   data: mt_value,
                   backgroundColor: 'rgba(255, 99, 132, 0.8)',
                   borderColor: 'rgba(255,99,132,1)',
                   borderWidth: 1
               }]
           },
           options: {
            legend: {
               display: false
            },
            "animation": {
               "duration": 1,
               "onComplete": function() {
                 var chartInstance = this.chart,
                   ctx = chartInstance.ctx;

                 ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                 ctx.textAlign = 'center';
                 ctx.textBaseline = 'bottom';

                 this.data.datasets.forEach(function(dataset, i) {
                   var meta = chartInstance.controller.getDatasetMeta(i);
                   meta.data.forEach(function(bar, index) {
                     var data = dataset.data[index];
                     ctx.fillText(data, bar._model.x, bar._model.y - 5);
                   });
                 });
               }
            },
               scales: {
                   yAxes: [{
                       ticks: {
                           beginAtZero:true,
                           padding: 100
                       }
                   }], xAxes: [{
                           padding: 50,
                           lineHeight: 3,
                       ticks: {
                           padding: 50,
                           lineHeight: 3
                       }
                   }]
               }
           }
         });

       let mt_time_ph=mt_time;
       let mt_value_ph=mt_value;

      $(".vina-vina-loadingPH").css("display", "none");
      $(".BotonExportarPHDiarios").css("display", "block");
}



   $("#parametros").click(function () {
     CompilarRango();
   });
   
   
   
       function RegistarRiego() {
         $(".boton1").css("display", "none");
         $(".vina-vina-loadingg1").css("display", "block");
        var MinutosRiego = $("#RiegoValor").text();
   
   
                 var url = "<?php echo Request::root() ?>/InsertarParametroRiego";
                 $("#parametros-ejecucion").load(url, {Riego: MinutosRiego});
   
   
       }
   
       function RegistarReposo() {
         $(".boton2").css("display", "none");
         $(".vina-vina-loadingg2").css("display", "block");
        var MinutosReposo = $("#ReposoValor").text();
   
   
        var url = "<?php echo Request::root() ?>/InsertarParametroReposo";
        $("#parametros-ejecucion").load(url, {Reposo: MinutosReposo});
   
   
       }
   
   
       function RegistarRangoPH() {
   
         $(".boton3").css("display", "none");
         $(".vina-vina-loadingg3").css("display", "block");
   
        var RangoPH_Inicio = $("#BajoPH").text();
        var RangoPH_Fin = $("#AltoPH").text();
         var url = "<?php echo Request::root() ?>/InsertarParametroRangoPH";
         $("#parametros-ejecucion").load(url, {RangoPH_Ini: RangoPH_Inicio, RangoPH_Fini: RangoPH_Fin});
   
       }
   
   
   function CompilarRango() {
   
         var slider = document.getElementById('slider');
      
             noUiSlider.create(slider, {
                 start: [@foreach ($Parametros as $Parametro) @if($Parametro->mt_name=="Biofiltro02--Consumo.LimitePH_Bajo") "<?php echo $Parametro->mt_value/100 ?>" @endif  @endforeach, @foreach ($Parametros as $Parametro) @if($Parametro->mt_name=="Biofiltro02--Consumo.LimitePH_Alto") "<?php echo $Parametro->mt_value/100 ?>" @endif  @endforeach],
                 step: 0.1,
                 connect: true,
                 range: {
                     'min': 0,
                     'max': 14
                 },
                 format: wNumb({
                     decimals: 1
                 })
             });
   
             var nodes = [
                 document.getElementById("BajoPH"), // 0
                 document.getElementById('AltoPH')  // 1
             ];
   
             // Display the slider value and how far the handle moved
             // from the left edge of the slider.
             slider.noUiSlider.on('update', function (values, handle, unencoded, isTap, positions) {
                 nodes[handle].innerHTML = values[handle];
             });


   
             var riego = document.getElementById('Riego');
   
             noUiSlider.create(riego, {
                 start: @foreach ($Parametros as $Parametro) @if($Parametro->mt_name=="Biofiltro02--Consumo.TiempoRiego") "<?php echo $Parametro->mt_value ?>" @endif  @endforeach,
   
                 // Disable animation on value-setting,
                 // so the sliders respond immediately.
                 animate: false,
                 step: 1,
                 decimals: 0,
                 range: {
                     min: 0,
                     max: 100
                 },
                 format: wNumb({
                     decimals: 0,
                     thousand: '.',
                 })
             });
   
             riego.noUiSlider.on('update', function (values, handle) {
                document.getElementById('RiegoValor').innerHTML = values[handle];
             });
   
   
             var reposo = document.getElementById('Reposo');
   
             noUiSlider.create(reposo, {
                 start: @foreach ($Parametros as $Parametro) @if($Parametro->mt_name=="Biofiltro02--Consumo.TiempoReposo") "<?php echo $Parametro->mt_value ?>" @endif  @endforeach,
   
                 // Disable animation on value-setting,
                 // so the sliders respond immediately.
                 animate: false,
                 step: 1,
                 decimals: 0,
                 range: {
                     min: 0,
                     max: 100
                 },
                 format: wNumb({
                     decimals: 0,
                     thousand: '.',
                 })
             });
   
             reposo.noUiSlider.on('update', function (values, handle) {
                document.getElementById('ReposoValor').innerHTML = values[handle];
             });
   }  
   
   
   
   
   var instalacion_info=<?php echo json_encode($Instalacion); ?>;
   
   var url = "<?php echo Request::root() ?>/CalculosLuisFelipe";  
   
    $("#contenedorLFE").load(url, {instalacion: instalacion_info});
   
   
   
   
   
     $("#gauge0").click(function() {
       var url = "<?php echo Request::root() ?>/CalculosLuisFelipe2";
       $("#contenedorLFE").load(url, {dato: "0"});
       $(".loader-insta").css("display", "block");
     });
   
     $("#gauge1").click(function() {
       var url = "<?php echo Request::root() ?>/CalculosLuisFelipe2";
       $("#contenedorLFE").load(url, {dato: "1"});
       $(".loader-insta").css("display", "block");
     });
   
     $("#gauge2").click(function() {
       var url = "<?php echo Request::root() ?>/CalculosLuisFelipe2";
       $("#contenedorLFE").load(url, {dato: "2"});
       $(".loader-insta").css("display", "block");
     });
   
     $("#gauge3").click(function() {
       var url = "<?php echo Request::root() ?>/CalculosLuisFelipe2";
       $("#contenedorLFE").load(url, {dato: "3"});
       $(".loader-insta").css("display", "block");
     });
   
     $("#gauge4").click(function() {
       var url = "<?php echo Request::root() ?>/CalculosLuisFelipe2";
       $("#contenedorLFE").load(url, {dato: "4"});
       $(".loader-insta").css("display", "block");
     });
   
     $("#gauge5").click(function() {
       var url = "<?php echo Request::root() ?>/CalculosLuisFelipe2";
       $("#contenedorLFE").load(url, {dato: "5"});
       $(".loader-insta").css("display", "block");
     });
   
   
     $('#datetime').bootstrapMaterialDatePicker
         ({
           format: 'DD/MM/YYYY HH:mm',
           lang: 'fr',
           weekStart: 1, 
           cancelText : 'ANNULER',
           nowButton : true,
           switchOnClick : true
         });
   
</script>