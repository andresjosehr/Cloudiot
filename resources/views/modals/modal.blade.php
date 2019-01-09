   <button type="button" class="btn btn-default waves-effect m-r-20 display-modal" data-toggle="modal" data-target="#largeModal" style="display: none"></button>

   <!-- Large Size -->
            <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document" style="width: 75%;">
                    <div class="modal-content">
                        <div class="modal-header">
                          <div class="row">
                            <div class="col-md-5">
                              <h4 class="modal-title nombre-instalacion" id="largeModalLabel" >{{ $Instalacion->nombre }}</h4>
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
                              <button type="button" class="btn btn-primary waves-effect">-></button>
                            </div>
                          </div>
                        </div>
                        <hr style=" color: black">  
                        <div class="modal-body">
                            <div class="row" align="center">
                                <div class="col-md-1"></div>
                                    <div class="col-md-2">
                                      <div class="body table-responsive">
                                          <table class="table table-bordered modal-table1" style="border: #5a5a5a">
                                            <thead>
                                                <caption scope="row" class="tabla-titulo">Energia Activa</caption>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th style="font-weight: 300;">Inyectada</th>
                                                    <td>{{ $Datos["EnergiaActivaInyectada"] }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="font-weight: 300;">Retirada</th>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                      </div>
                                    </div>
                                    <div class="col-md-2">
                                      <div class="body table-responsive">
                                          <table class="table table-bordered modal-table1" style="border: #5a5a5a">
                                            <thead>
                                                <caption scope="row" class="tabla-titulo">Energia Reactiva</caption>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th style="font-weight: 300;">Inyectada</th>
                                                    <td>{{ $Datos["EnergíaReactivaInyectada"] }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="font-weight: 300;">Retirada</th>
                                                    <td>{{ $Datos["EnergíaReactivaRetirada"] }}</td>
                                                </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                      <div class="body table-responsive">
                                          <table class="table table-bordered modal-table1" style="border: #5a5a5a">
                                            <thead>
                                                <caption scope="row" class="tabla-titulo">Potencia Activa</caption>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th style="font-weight: 300;">Inyectada</th>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th style="font-weight: 300;">Retirada</th>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                      <div class="body table-responsive">
                                          <table class="table table-bordered modal-table1" style="border: #5a5a5a">
                                            <thead>
                                                <caption scope="row" class="tabla-titulo">Potencia Ractiva</caption>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th style="font-weight: 300;">Inyectada</th>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th style="font-weight: 300;">Retirada</th>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                      <div class="body table-responsive">
                                          <table class="table table-bordered modal-table1" style="border: #5a5a5a">
                                            <thead>
                                                <caption scope="row" class="tabla-titulo">Potencia Aparente</caption>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th style="font-weight: 300;">Inyectada</th>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th style="font-weight: 300;">Retirada</th>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                    </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="row">
                            <div class="col-md-1"></div>
                                <div class="col-md-2" align="center"><canvas id="myChart0" height="150"></canvas></div>
                                <div class="col-md-2" align="center"><canvas id="myChart1" height="150"></canvas></div>
                                <div class="col-md-2" align="center"><canvas id="myChart2" height="150"></canvas></div>
                                <div class="col-md-2" align="center"><canvas id="myChart3" height="150"></canvas></div>
                                <div class="col-md-2" align="center"><canvas id="myChart4" height="150"></canvas></div>
                              <div class="col-md-1"></div>
                          </div>
                            <div class="row" align="center" style="padding-top: 30px">
                              <div class="col-md-3">
                                <div class="body table-responsive">
                                    <table class="table table-bordered modal-table1" style="border: #5a5a5a">
                                      <thead>
                                          <caption scope="row" class="tabla-titulo">Corrientes</caption>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <th style="font-weight: 300;">Fase A</th>
                                              <td>{{ $Datos["FaseA"] }}</td>
                                          </tr>
                                          <tr>
                                              <th style="font-weight: 300;">Fase B</th>
                                              <td>{{ $Datos["FaseB"] }}</td>
                                          </tr>
                                          <tr>
                                              <th style="font-weight: 300;">Fase C</th>
                                              <td>{{ $Datos["FaseC"] }}</td>
                                          </tr>
                                          <tr>
                                              <th style="font-weight: 300;">Promedio</th>
                                              <td></td>
                                          </tr>
                                      </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="body table-responsive">
                                    <table class="table table-bordered modal-table1" style="border: #5a5a5a">
                                      <thead>
                                          <caption scope="row" class="tabla-titulo">Voltaje de Lineas</caption>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <th style="font-weight: 300;">VL ab</th>
                                              <td>{{ $Datos["VoltajeDeLineaAB"] }}</td>
                                          </tr>
                                          <tr>
                                              <th style="font-weight: 300;">VL bc</th>
                                              <td>{{ $Datos["VoltajeDeLineaBC"] }}</td>
                                          </tr>
                                          <tr>
                                              <th style="font-weight: 300;">VL ca</th>
                                              <td>{{ $Datos["VoltajeDeLineaCA"] }}</td>
                                          </tr>
                                          <tr>
                                              <th style="font-weight: 300;">Promedio</th>
                                              <td>{{ $Datos["VoltajeDeLineaPromedio"] }}</td>
                                          </tr>
                                      </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="body table-responsive">
                                    <table class="table table-bordered modal-table1" style="border: #5a5a5a">
                                      <thead>
                                          <caption scope="row" class="tabla-titulo">Voltaje de Fases</caption>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <th style="font-weight: 300;">Voltaje A</th>
                                              <td>{{ $Datos["VoltajeA"] }}</td>
                                          </tr>
                                          <tr>
                                              <th style="font-weight: 300;">Voltaje B</th>
                                              <td>{{ $Datos["VoltajeB"] }}</td>
                                          </tr>
                                          <tr>
                                              <th style="font-weight: 300;">Voltaje C</th>
                                              <td>{{ $Datos["VoltajeC"] }}</td>
                                          </tr>
                                          <tr>
                                              <th style="font-weight: 300;">Promedio</th>
                                              <td>{{ $Datos["VoltajePromedio"] }}</td>
                                          </tr>
                                      </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="body table-responsive">
                                    <table class="table table-bordered modal-table1" style="border: #5a5a5a">
                                      <thead>
                                          <caption scope="row" class="tabla-titulo">Factor de potencia</caption>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <th style="font-weight: 300;">F. Potencia A</th>
                                              <td>{{ $Datos["FactorPotenciaA"] }}</td>
                                          </tr>
                                          <tr>
                                              <th style="font-weight: 300;">F. Potencia B</th>
                                              <td>{{ $Datos["FactorPotenciaB"] }}</td>
                                          </tr>
                                          <tr>
                                              <th style="font-weight: 300;">F. Potencia C</th>
                                              <td>{{ $Datos["FactorPotenciaC"] }}</td>
                                          </tr>
                                          <tr>
                                              <th style="font-weight: 300;">Total</th>
                                              <td>{{ $Datos["FactorPotenciaTotal"] }}</td>
                                          </tr>
                                      </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="row" align="center" style="margin-right: 20px;margin-left: 20px;">
                          <div class="col-md-3"><canvas id="myChart5"  height="150"></div>
                          <div class="col-md-3"><canvas id="myChart6"  height="150"></div>
                          <div class="col-md-3"><canvas id="myChart7"  height="150"></div>
                          <div class="col-md-3"><canvas id="myChart8"  height="150"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <style>

                .tabla-titulo{
                  background: #d4d4d4;
                  border: 1px solid #4e4e4e;
                  border-bottom: 0;
                  text-align: center; 
                  font-weight: 600; 
                  color: black;
                  padding-top: 4px;
                  padding-bottom: 4px;
                }
                .nombre-instalacion{
                    text-align: left;
                }
                .modal-table1 tbody tr th{
                  padding: 0px !important;
                  text-align: center;
                }
                .modal-table1 tbody tr td{
                  text-align: center;
                  padding: 0px !important;
                }
                .table-bordered tbody tr td, .table-bordered tbody tr th {
                  border-color: #4e4e4e;
                }
            </style>

            <script>
                $( ".display-modal" ).click();
                      for (var i = 0; i <= 8; i++) {
                      var ctx = document.getElementById("myChart"+i).getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                            datasets: [{
                                label: '# of Votes',
                                data: [12, 19, 3, 5, 2, 3],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    }
                                }]
                            }
                        }
                    });
                    }
            </script>