
<button type="button" class="btn btn-default waves-effect m-r-20 display-modal vina-modal" data-toggle="modal" data-target="#largeModal"></button>
<!-- Large Size -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-lg vina-modal-dialog" role="document">
      <div class="modal-content">
         <p id="contenedorLFE1"></p>
         <p id="contenedorLFE2"></p>
         <p id="contenedorLFE3"></p>
         <p id="contenedorLFE4"></p>
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
               <li role="presentation" id="GraficarORPDiario"><a href="#ORPDiarios" data-toggle="tab">Vista de ORP diarios</a></li>
               <li role="presentation" id="GraficarConductividadDiario"><a href="#ConductividadDiarios" data-toggle="tab">Vista de Conductividad Diarios</a></li>
               @if ($Rol!=5)
               <li role="presentation" id="parametros"><a href="#profile" data-toggle="tab">Parametros de Configuracion</a></li>
               @endif
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
                     <div id="Riego" @if ($Rol==2) disabled='true' @endif class="noUi-target noUi-ltr noUi-horizontal"></div>
                     <div class='vina-parametro-info'>
                        <-----<b id="RiegoValor"></b><b> Minutos</b>----->
                     </div>
                  </div>
                  <div class="col-md-4">
                     @if ($Rol==1)
                     <button onclick="RegistarRiego('<?php echo Request::root() ?>/InsertarParametroRiego')" class="btn btn-primary btn-block boton1 vina-btn-parametro">Registrar</button>
                     @endif
                     <div class="vina-vina-loadingg vina-loadingg1"></div>
                  </div>
               </div>
               <div class="row clearfix">
                  <div class="col-md-2">
                     Tiempo de Reposo
                  </div>
                  <div class="col-md-6 vina-parametro-unidad">
                     <div id="Reposo" @if ($Rol==2) disabled='true' @endif class="noUi-target noUi-ltr noUi-horizontal"></div>
                     <div class='vina-parametro-info'>
                        <-----<b id="ReposoValor"></b><b> Minutos</b>-----> 
                     </div>
                  </div>
                  <div class="col-md-4">
                     @if ($Rol==1)
                     <button onclick='RegistarReposo("<?php echo Request::root() ?>/InsertarParametroReposo")' class="btn btn-primary btn-block boton2 vina-btn-parametro">Registrar</button>
                     @endif
                     <div class="vina-vina-loadingg vina-loadingg2"></div>
                  </div>
               </div>
               <div class="row clearfix">
                  <div class="col-md-2">
                     Rango de PH
                  </div>
                  <div class="col-md-6 vina-parametro-unidad">
                     <div id="slider" @if ($Rol==2) disabled='true' @endif class="noUi-target noUi-ltr noUi-horizontal"></div>
                     <div class='vina-parametro-info'>
                        <b id="BajoPH"></b><----------><b id="AltoPH"></b>
                     </div>
                  </div>
                  <div class="col-md-4">
                     @if ($Rol==1)
                     <button onclick="RegistarRangoPH('<?php echo Request::root() ?>/InsertarParametroRangoPH')" class="btn btn-primary btn-block boton3 vina-btn-parametro">Registrar</button>
                     @endif
                     <div class="vina-vina-loadingg vina-loadingg3"></div>
                  </div>
               </div>
               </p>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="PHDiarios">
               <div id="PHDiarioContenedor"></div>
               <div class="row">
                <div id="contenedorLFE2"></div>
                  <div class="col-md-2">
                      {{-- <p class="modal-title" id="defaultModalLabel">Flujos</p> --}}
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
                    <button onclick="GraficarphPersonalizado('<?php echo Request::root() ?>/CalculosLuisFelipe8');" type="button" class="btn btn-primary waves-effect">→</button>
                  </div>
              </div>
               <div class="vina-vina-loadingPH"></div>
               <div id="ph-bar-chart-div">
                  <canvas id="ph-bar-chart" width="400" height="70"></canvas>
               </div>
               <div class="BotonExportarPHDiarios vina-BotonExportarPHDiarios">
                  <a onclick="DescargarExcelPH()" class="btn btn-primary" >Exportar datos a Excel</a>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane fade" id="ORPDiarios">
               <div id="ORPDiarioContenedor"></div>
               <div class="row">
                <div id="contenedorLFE2"></div>
                  <div class="col-md-2">
                  </div>
                  <div class="col-md-3">
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                       <div class="form-line">
                           <input type="text" id="fecha_orp_inicio" class="datetimepicker form-control" placeholder="Fecha Inicio">
                       </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                       <div class="form-line">
                           <input type="text" id="fecha_orp_fin" class="datetimepicker form-control" placeholder="Fecha Fin">
                       </div>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <button onclick="GraficarORPPersonalizado('<?php echo Request::root() ?>/CalculosLuisFelipe10');" type="button" class="btn btn-primary waves-effect">→</button>
                  </div>
              </div>
               <div class="vina-loadingORP"></div>
               <div id="orp-bar-chart-div">
                  <canvas id="orp-bar-chart" width="400" height="70"></canvas>
               </div>
               <div class="BotonExportarORPDiarios vina-BotonExportarORPDiarios">
                  <a onclick="DescargarExcelORP()" class="btn btn-primary" >Exportar datos a Excel</a>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane fade" id="ConductividadDiarios">
               <div id="ConductividadDiarioContenedor"></div>
               <div class="row">
                <div id="contenedorLFE2"></div>
                  <div class="col-md-2">
                  </div>
                  <div class="col-md-3">
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                       <div class="form-line">
                           <input type="text" id="fecha_conductividad_inicio" class="datetimepicker form-control" placeholder="Fecha Inicio">
                       </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                       <div class="form-line">
                           <input type="text" id="fecha_conductividad_fin" class="datetimepicker form-control" placeholder="Fecha Fin">
                       </div>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <button onclick="GraficarConductividadPersonalizado('<?php echo Request::root() ?>/CalculosLuisFelipe12');" type="button" class="btn btn-primary waves-effect">→</button>
                  </div>
              </div>
               <div class="vina-loadingConductividad"></div>
               <div id="conductividad-bar-chart-div">
                  <canvas id="conductividad-bar-chart" width="400" height="70"></canvas>
               </div>
               <div class="BotonExportarConductividadDiarios vina-BotonExportarConductividadDiarios">
                  <a onclick="DescargarExcelConductividad()" class="btn btn-primary" >Exportar datos a Excel</a>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane fade" id="flujos">
               <div id="contenedorFlujos"></div>
              <div class="row">
                <div id="contenedorLFE2"></div>
                  <div class="col-md-2">
                      {{-- <p class="modal-title" id="defaultModalLabel">Flujos</p> --}}
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
                    <button onclick="GraficarFlujoPersonalizado('<?php echo Request::root() ?>/CalculosLuisFelipe4');" type="button" class="btn btn-primary waves-effect">→</button>
                  </div>
              </div>
              <div class="col-md-12">
               <div id="flujo-bar-chart-div">
                <canvas id="flujo-bar-chart" width="400" height="70"></canvas>
               </div>
                <div class="vina-DescargarExcelFlujosDiarios-padre">
                  <a onclick="DescargarExcelFlujos()" class="btn btn-primary" >Exportar datos a Excel</a>
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

<script  src="instalaciones/VinaLuisFelipe.js"></script>
<script>

      VinaScriptDefault("<?php echo Request::root() ?>/CalculosLuisFelipe", <?php echo json_encode($Instalacion); ?>);
      GraficarPHDiario("<?php echo Request::root() ?>/CalculosLuisFelipe7");
      GraficarORPDiario("<?php echo Request::root() ?>/CalculosLuisFelipe9");
      GraficarConductividadDiario("<?php echo Request::root() ?>/CalculosLuisFelipe11");

   $("#ListarBombas").click(function() {
       ListarBombas("<?php echo Request::root() ?>/CalculosLuisFelipe5");
   });

   var i=0;
   var mt_time = [];
   var mt_value = [];

   var mt_time_flujos = [];
   var mt_value_flujos = [];
   @foreach ($GraficoBarras as $Barra)
     mt_time[i]='{{ date_format(date_create($Barra->mt_time), 'm-j') }}';
     mt_value[i]='{{$Barra->mt_value}}';

     mt_time_flujos[i] = "{{$Barra->mt_time}}";
     mt_value_flujos = mt_value;
     i++;
   @endforeach

   GraficarFlujo(mt_time, mt_value);

   function DescargarExcelFlujos() {
       window.open('<?php echo Request::root() ?>/ExcelFlujosDiarios?mt_time='+mt_time_flujos+'&mt_value='+mt_value_flujos+"&n1=Flujo&n2=.", '_blank' )
   }

   @foreach ($Parametros as $Parametro)
    @if($Parametro->mt_name=="Biofiltro02--Consumo.LimitePH_Bajo")
      var vina_param_bajo="<?php echo $Parametro->mt_value/100 ?>";
     @endif 
     @if($Parametro->mt_name=="Biofiltro02--Consumo.LimitePH_Alto")
       var vina_param_alto="<?php echo $Parametro->mt_value/100 ?>";
      @endif
      @if($Parametro->mt_name=="Biofiltro02--Consumo.TiempoRiego")
       var TiempoRiego="<?php echo $Parametro->mt_value ?>";
      @endif 
      @if($Parametro->mt_name=="Biofiltro02--Consumo.TiempoReposo")
       var TiempoReposo="<?php echo $Parametro->mt_value ?>";
      @endif  
   @endforeach

   $("#parametros").click(function () {
     CompilarRango(vina_param_alto, vina_param_bajo, TiempoRiego, TiempoReposo);
   });

   
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
   
</script>