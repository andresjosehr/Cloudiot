   <button type="button" class="btn btn-default waves-effect m-r-20 display-modal sitcut-btn-modal" data-toggle="modal" data-target="#largeModal"></button>
  
         <!-- Large Size -->
            <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg sicut-modal" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                          <div class="row">
                            <div class="col-md-2">
                              <h4 class="modal-title sicut-nombre-instalacion" id="largeModalLabel" >{{ $Instalacion->nombre }}</h4>
                            </div>
                            <div class="col-md-3">
                              <h4 class="modal-title sicut-nombre-instalacion" id="largeModalLabel" >Ultima dato: {{ $Datos["UltimaMedicion"] }}</h4> 
                            </div>
                            <div class="col-md-3">
                              <div class="form-line">
                                <input type="text" class="datetimepicker form-control" placeholder="Please choose date & time...">
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-line">
                                <input type="text" class="datetimepicker form-control" placeholder="Please choose date & time...">
                              </div>
                            </div>
                            <div class="col-md-1">
                              <button type="button" class="btn btn-primary waves-effect">→</button>
                            </div>
                          </div>
                        </div>
                        <hr class="sicut-hr">  
                        <div class="modal-body">
                          <div id="SicutContenedor1"></div>
                          <div id="SicutContenedor2"></div>
                          <div id="SicutContenedor3"></div>
                          <div id="SicutContenedor4"></div>
                          <div id="SicutContenedor5"></div>
                            <div class="row" align="center">
                                    <div class="col-md-3">
                                      <div class="body table-responsive">
                                          <table class="table sicut-table-bordered sicut-modal-table1">
                                            <thead>
                                                <caption scope="row" class="sicut-tabla-titulo">Energia Activa</caption>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th class="sicut-th">Inyectada</th>
                                                    <td>{{ $Datos["EnergiaActivaInyectada"] }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="sicut-th">Retirada</th>
                                                    <td>{{ $Datos["EnergiaActivaRetirada"] }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                      </div>
                                    </div>
                                    <div class="col-md-3">
                                      <div class="body table-responsive">
                                          <table class="table sicut-table-bordered sicut-modal-table1">
                                            <thead>
                                                <caption scope="row" class="sicut-tabla-titulo">Energia Reactiva</caption>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th class="sicut-th">Inyectada</th>
                                                    <td>{{ $Datos["EnergíaReactivaInyectada"] }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="sicut-th">Retirada</th>
                                                    <td>{{ $Datos["EnergíaReactivaRetirada"] }}</td>
                                                </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                      <div class="body table-responsive">
                                          <table class="table sicut-table-bordered sicut-modal-table1">
                                            <thead>
                                                <caption scope="row" class="sicut-tabla-titulo">Potencia Ractiva</caption>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th class="sicut-th">Inyectada</th>
                                                    <td>No definido</td>
                                                </tr>
                                                <tr>
                                                    <th class="sicut-th">Retirada</th>
                                                    <td>No definido</td>
                                                </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                      <div class="body table-responsive">
                                          <table class="table sicut-table-bordered sicut-modal-table1">
                                            <thead>
                                                <caption scope="row" class="sicut-tabla-titulo">Potencia Aparente</caption>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th class="sicut-th">Inyectada</th>
                                                    <td>No definido</td>
                                                </tr>
                                                <tr>
                                                    <th class="sicut-th">Retirada</th>
                                                    <td>No definido</td>
                                                </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3" align="center">
                                  <canvas id="myChart0" height="100"></canvas>
                                  <div class="sicut-loading" id="sicut-loading1"></div>
                                </div>
                                <div class="col-md-3" align="center">
                                  <canvas id="myChart1" height="100"></canvas>
                                  <div class="sicut-loading" id="sicut-loading2"></div>
                                </div>
                                <div class="col-md-3" align="center">
                                  <canvas id="myChart2" height="100"></canvas>
                                </div>
                                <div class="col-md-3" align="center">
                                  <canvas id="myChart3" height="100"></canvas>
                                </div>
                          </div>
                            <div class="row sicut-row2" align="center">
                              <div class="col-md-4">
                                <div class="body table-responsive">
                                    <table class="table sicut-table-bordered sicut-modal-table1">
                                      <thead>
                                          <caption scope="row" class="sicut-tabla-titulo">Voltaje de Lineas</caption>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <th class="sicut-th">VL ab</th>
                                              <td>{{ $Datos["VoltajeDeLineaAB"] }}</td>
                                          </tr>
                                          <tr>
                                              <th class="sicut-th">VL bc</th>
                                              <td>{{ $Datos["VoltajeDeLineaBC"] }}</td>
                                          </tr>
                                          <tr>
                                              <th class="sicut-th">VL ca</th>
                                              <td>{{ $Datos["VoltajeDeLineaCA"] }}</td>
                                          </tr>
                                          <tr>
                                              <th class="sicut-th">Promedio</th>
                                              <td>{{ $Datos["VoltajeDeLineaPromedio"] }}</td>
                                          </tr>
                                      </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="body table-responsive">
                                    <table class="table sicut-table-bordered sicut-modal-table1">
                                      <thead>
                                          <caption scope="row" class="sicut-tabla-titulo">Voltaje de Fases</caption>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <th class="sicut-th">Voltaje A</th>
                                              <td>{{ $Datos["VoltajeA"] }}</td>
                                          </tr>
                                          <tr>
                                              <th class="sicut-th">Voltaje B</th>
                                              <td>{{ $Datos["VoltajeB"] }}</td>
                                          </tr>
                                          <tr>
                                              <th class="sicut-th">Voltaje C</th>
                                              <td>{{ $Datos["VoltajeC"] }}</td>
                                          </tr>
                                          <tr>
                                              <th class="sicut-th">Promedio</th>
                                              <td>{{ $Datos["VoltajePromedio"] }}</td>
                                          </tr>
                                      </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="body table-responsive">
                                    <table class="table sicut-table-bordered sicut-modal-table1">
                                      <thead>
                                          <caption scope="row" class="sicut-tabla-titulo">Factor de potencia</caption>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <th class="sicut-th">F. Potencia A</th>
                                              <td>{{ $Datos["FactorPotenciaA"] }}</td>
                                          </tr>
                                          <tr>
                                              <th class="sicut-th">F. Potencia B</th>
                                              <td>{{ $Datos["FactorPotenciaB"] }}</td>
                                          </tr>
                                          <tr>
                                              <th class="sicut-th">F. Potencia C</th>
                                              <td>{{ $Datos["FactorPotenciaC"] }}</td>
                                          </tr>
                                          <tr>
                                              <th class="sicut-th">Total</th>
                                              <td>{{ $Datos["FactorPotenciaTotal"] }}</td>
                                          </tr>
                                      </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="row" align="center" class="sicut-row-chart-2">
                          <div class="col-md-4">
                            <canvas id="myChart4"  height="100"></canvas>
                              <div class="sicut-loading" id="sicut-loading3"></div>
                            </div>
                            <div class="col-md-4">
                            <canvas id="myChart5"  height="100"></canvas>
                              <div class="sicut-loading" id="sicut-loading4"></div>
                            </div>
                            <div class="col-md-4">
                            <canvas id="myChart6"  height="100"></canvas>
                              {{-- <div class="sicut-loading" id="sicut-loading5"></div> --}}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
  <script>

    var url_ = "<?php echo Request::root() ?>";

    SicutScriptDefault();
    GraficarTodo(url_);

  // GraficosIgnisArriba("myChart0");
  // GraficosIgnisArriba("myChart1");
  // GraficosIgnisArriba("myChart2");
  // GraficosIgnisArriba("myChart3");
  
  // GraficosIgnisAbajo("myChart4");
  // GraficosIgnisAbajo("myChart5");
  // GraficosIgnisAbajo("myChart6");
  </script>