<div class="col-md-6" id="MostrarBombas">
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

                        <script>
                           VinaScriptDefault("<?php echo Request::root() ?>/CalculosLuisFelipe");
                        </script>