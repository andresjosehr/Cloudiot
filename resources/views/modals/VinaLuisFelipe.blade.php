<button type="button" class="btn btn-default waves-effect m-r-20 display-modal" data-toggle="modal" data-target="#largeModal" style="display: none"></button>

   <!-- Large Size -->
            <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document" style="width: 95%;margin-top: 2%;">
                    <div class="modal-content">
                        <div class="modal-header">
                          <div class="row">
                            <div class="col-md-2">
                              <h4 class="modal-title nombre-instalacion" id="largeModalLabel" >{{ $Instalacion->nombre }}</h4>
                            </div>
                            <div class="col-md-3">
                              <h4 class="modal-title nombre-instalacion" id="largeModalLabel">Ultima Mendicion</h4> 
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
                        <hr style=" color: black">  
                        <div class="modal-body table-custom">
                            <div class="row" align="center">
                                    <div class="col-md-3">
                                    	<h4 align="left" style="color:black;padding-left: 3%;">Flujos</h4>
                                    	<div class="body table-responsive">
						                            <table class="table table-striped">
						                                <thead>
						                                    <tr>
						                                        <th style="text-align: center;">Fecha</div></th>
						                                        <th style="text-align: center;">Hrs&nbsp;Op.</th>
						                                        <th style="text-align: center;">m3</th>
						                                        <th style="text-align: center;">Bombas</th>
						                                    </tr>
						                                </thead>
						                                <tbody align="center">
						                                    <tr>
						                                        <td>01-10</td>
						                                        <td>50</td>
						                                        <td>1.245</td>
						                                        <td>
																										<i class="material-icons btn-bomba">add_circle</i>
																										<i class="material-icons btn-bomba">add_circle</i>
																										<i class="material-icons btn-bomba">add_circle</i>
						                                        </td>
						                                    </tr>
						                                    <tr>
						                                        <td>01-10</td>
						                                        <td>50</td>
						                                        <td>1.245</td>
						                                        <td>
							                                        <i class="material-icons btn-bomba">add_circle</i>
							                                        <i class="material-icons btn-bomba">add_circle</i>
							                                        <i class="material-icons btn-bomba">add_circle</i>
										                              	</td>
						                                    </tr>
						                                    <tr>
						                                        <td>01-10</td>
						                                        <td>50</td>
						                                        <td>1.245</td>
						                                        <td>
						                                        <i class="material-icons btn-bomba">add_circle</i>
						                                        <i class="material-icons btn-bomba">add_circle</i>
						                                        <i class="material-icons btn-bomba">add_circle</i>
						                                        </td>
						                                    </tr>
						                                </tbody>
						                            </table>
						                        	</div>
                                    </div>
                                    <div class="col-md-3">
                                    	<h4 align="left" style="color:black;padding-left: 3%;">Alarmas</h4>
                                    	<div class="body table-responsive">
						                            <table class="table table-striped">
						                                <thead>
						                                    <tr>
						                                        <th>Fecha / Hora</th>
						                                        <th>Litros</th>
						                                    </tr>
						                                </thead>
						                                <tbody>
						                                    <tr>
						                                        <td>Flujo Promedio</td>
						                                        <td>5000</td>
						                                    </tr>
						                                    <tr>
						                                        <td>Flujo minimo</td>
						                                        <td>5000</td>
						                                    </tr>
						                                    <tr>
						                                        <td>Flujo Maximo</td>
						                                        <td>5000</td>
						                                    </tr>
						                                </tbody>
						                            </table>
						                        	</div>
                                    </div>
                                    {{-- <div class="col-md-3">
																			<button class="btn btn-primary btn-block" style="width: 60%;">Bomba 1</button>
																			<button class="btn btn-primary btn-block" style="width: 60%;">Bomba 2</button>
																			<button class="btn btn-primary btn-block" style="width: 60%;">Bomba 3</button>
                                    </div> --}}
                                    <div class="col-md-6">
                                      <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                          <li role="presentation" class="active"><a href="#bomba1" data-toggle="tab">Bomba 1</a></li>
                                          <li role="presentation"><a href="#bomba2" data-toggle="tab">Bomba 2</a></li>
                                          <li role="presentation"><a href="#bomba3" data-toggle="tab">Bomba 3</a></li>
                                          <li role="presentation"><a href="#bomba4" data-toggle="tab">Bomba 4</a></li>
                                          <li role="presentation"><a href="#bomba5" data-toggle="tab">Bomba 5</a></li>
                                      </ul>
                                      <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="bomba1">
                                            <b>Bomba 1</b>
                                            <div class="row">
                                              <div class="col-md-4">
                                                <button type="button" class="btn bg-green btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">check</i>
                                                </button>
                                                <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">error_outline</i>
                                                </button>
                                                <br>
                                              </div>
                                              <div class="col-md-4">
                                                <span class="badge bg-red" style="margin-top: 12px;">No Operativa</span>
                                              </div>
                                              <div class="col-md-4">
                                                <button type="button" class="btn bg-red waves-effect">
                                                    <i class="material-icons">report_problem</i>
                                                    <span>Error</span>
                                                </button>
                                              </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="bomba2">
                                            <b>Profile Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                                                pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                                                sadipscing mel.
                                            </p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="bomba3">
                                            <b>Message Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                                                pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                                                sadipscing mel.
                                            </p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="bomba4">
                                            <b>Settings Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                                                pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                                                sadipscing mel.
                                            </p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="bomba5">
                                            <b>Message Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                                                pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                                                sadipscing mel.
                                            </p>
                                        </div>
                                      </div>
                                    </div>
                            </div>

                            <div class="row">

                              <div class="col-md-6">
                                <div class="row" style="height: 253px;">
                                  
                                </div>
                                <div class="row">
                                 <div class="col-md-12" align="center">
                                   <canvas id="myChart0" height="70"></canvas>
                                 </div>
                                </div>
                              </div>


                              <div class="col-md-6">
                                <div class="row">
                                  <div class="col-md-4">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <canvas id="gauge0"></canvas>
                                      </div>
                                      <div class="col-md-12 chart-lfe">
                                        <canvas id="myChart1" height="140"></canvas>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <canvas id="gauge1"></canvas>
                                      </div>
                                      <div class="col-md-12 chart-lfe">
                                        <canvas id="myChart2" height="140"></canvas>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <canvas id="gauge2"></canvas>
                                      </div>
                                      <div class="col-md-12 chart-lfe">
                                        <canvas id="myChart3" height="140"></canvas>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-4">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <canvas id="gauge3"></canvas>
                                      </div>
                                      <div class="col-md-12 chart-lfe">
                                        <canvas id="myChart4" height="140"></canvas>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <canvas id="gauge4"></canvas>
                                      </div>
                                      <div class="col-md-12 chart-lfe">
                                        <canvas id="myChart5" height="140"></canvas>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <canvas id="gauge5"></canvas>
                                      </div>
                                      <div class="col-md-12 chart-lfe">
                                        <canvas id="myChart6" height="140"></canvas>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <style>

            .chart-lfe{
              margin-top: -45px;
            }

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



<script  src="instalaciones/VinaLuisFelipe.js"></script>