<button type="button" class="btn btn-default waves-effect m-r-20 display-modal" data-toggle="modal" data-target="#largeModal" style="display: none"></button>

   <!-- Large Size -->
            <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document" style="width: 95%;margin-top: 2%;">
                    <div class="modal-content">
                        <div class="modal-header">
                          <div class="row">
                            <div class="col-md-2">
                              <p id="contenedorLFE"></p>
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
                             <div class="row">
                               <div class="col-md-6">
                                 <div class="row">
                                   <div class="col-md-6">    
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
                                   <div class="col-md-6">
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
                                   <div class="col-md-12">
                                     <div class="col-md-8" align="center">
                                      <div class="loading-bomba"></div>
                                      <div class="cargando bombas-cargando">
                                        <div class="row">
                                           <div class="col-md-3">
                                             Bomba 1
                                           </div>
                                          <div class="col-md-1">
                                            <button type="button" class="btncasc0 btn bg-green btn-circle waves-effect waves-circle waves-float circle-custom">
                                                <i class="material-icons bomba0-op-btn">check</i>
                                            </button>
                                            <br>
                                          </div>
                                          <div class="col-md-3">
                                            <span class="badge bg-red bomba0-op">No Operativa</span>
                                          </div>
                                          <div class="col-md-3">
                                            <button type="button" class="btn-bomba-error0 btn bg-red waves-effect btn_error_custom">
                                                <span class="custom-error texto-error0">Error</span>
                                            </button>
                                          </div>
                                        </div>
                                        <div class="row">
                                           <div class="col-md-3">
                                             Bomba 2
                                           </div>
                                          <div class="col-md-1">

                                            <button type="button" class="btncasc1 btn bg-red btn-circle waves-effect waves-circle waves-float circle-custom">
                                                <i class="material-icons bomba1-op-btn">error_outline</i>
                                            </button>
                                            <br>
                                          </div>
                                          <div class="col-md-3">
                                            <span class="badge bg-green bomba1-op">Operativa</span>
                                          </div>
                                          <div class="col-md-3">
                                            <button type="button" class="btn-bomba-error1 btn bg-red waves-effect btn_error_custom">
                                                <span class="custom-error texto-error1">Error</span>
                                            </button>
                                          </div>
                                        </div>
                                        <div class="row">
                                           <div class="col-md-3">
                                             Bomba 3
                                           </div>
                                          <div class="col-md-1">
                                            <button type="button" class="btncasc2 btn bg-green btn-circle waves-effect waves-circle waves-float circle-custom">
                                                <i class="material-icons bomba2-op-btn">check</i>
                                            </button>
                                            <br>
                                          </div>
                                          <div class="col-md-3">
                                            <span class="badge bg-red bomba2-op">No Operativa</span>
                                          </div>
                                          <div class="col-md-3">
                                            <button type="button" class="btn-bomba-error2 btn bg-red waves-effect btn_error_custom">
                                                <span class="custom-error texto-error2">Error</span>
                                            </button>
                                          </div>
                                        </div>
                                        <div class="row">
                                           <div class="col-md-3">
                                             Bomba 4
                                           </div>
                                          <div class="col-md-1">
                                            <button type="button" class="btncasc3 btn bg-red btn-circle waves-effect waves-circle waves-float circle-custom">
                                                <i class="material-icons bomba3-op-btn">error_outline</i>
                                            </button>
                                            <br>
                                          </div>
                                          <div class="col-md-3">
                                            <span class="badge bg-green bomba3-op">Operativa</span>
                                          </div>
                                          <div class="col-md-3">
                                            <button type="button" class="btn-bomba-error3 btn bg-red waves-effect btn_error_custom">
                                                <span class="custom-error texto-error3">Error</span>
                                            </button>
                                          </div>
                                        </div>
                                        <div class="row">
                                           <div class="col-md-3">
                                             Bomba 5
                                           </div>
                                          <div class="col-md-1">
                                            <button type="button" class="btncasc4 btn bg-red btn-circle waves-effect waves-circle waves-float circle-custom">
                                                <i class="material-icons bomba4-op-btn">error_outline</i>
                                            </button>
                                            <br>
                                          </div>
                                          <div class="col-md-3">
                                            <span class="badge bg-green bomba4-op">Operativa</span>
                                          </div>
                                          <div class="col-md-3">
                                            <button type="button" class="btn-bomba-error4 btn bg-red waves-effect btn_error_custom">
                                                <span class="custom-error texto-error4">Error</span>
                                            </button>
                                          </div>
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
                                        <div class="loading"></div>
                                        <b class="vertical">Entrada</b>
                                        <div>
                                          <img src="images/rpm.png" class="img-rpm-lfe">
                                          <canvas id="gauge0"></canvas>
                                        </div>
                                      </div>
                                      <div class="col-md-12 chart-lfe" id="chart-lfe1">
                                        <div class="loading"></div>
                                        <img class="cargando img-chart-lfe" src="images/chart.png" class="img-rpm-lfe">
                                        <canvas id="myChart1" height="140"></canvas>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="row">
                                      <p><b align="center">ORP</b></p>
                                      <div class="col-md-12" id="rpm-1">
                                        <div class="loading"></div>
                                        <div>
                                          <img src="images/rpm.png" class="img-rpm-lfe">
                                          <canvas id="gauge1"></canvas>
                                        </div>
                                      </div>
                                      <div class="col-md-12 chart-lfe" id="chart-lfe2">
                                        <div class="loading"></div>
                                        <img class="cargando img-chart-lfe" src="images/chart.png" class="img-rpm-lfe">
                                        <canvas id="myChart2" height="140"></canvas>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="row">
                                      <p align="center"><b>Conductividad</b></p>
                                      <div class="col-md-12" id="rpm-2">
                                        <div class="loading"></div>
                                        <div>
                                          <img src="images/rpm.png" class="img-rpm-lfe">
                                          <canvas id="gauge2"></canvas>
                                        </div>
                                      </div>
                                      <div class="col-md-12 chart-lfe" id="chart-lfe3">
                                        <div class="loading"></div>
                                        <img class="cargando img-chart-lfe" src="images/chart.png" class="img-rpm-lfe">
                                        <canvas id="myChart3" height="140"></canvas>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-4">
                                    <div class="row">
                                      <div class="col-md-12" id="rpm-3">
                                        <b class="vertical">Salida</b>
                                        <div class="loading"></div>
                                        <div>
                                          <img src="images/rpm.png" class="img-rpm-lfe">
                                          <canvas id="gauge3"></canvas>
                                        </div>
                                      </div>
                                      <div class="col-md-12 chart-lfe" id="chart-lfe4">
                                        <div class="loading"></div>
                                        <img class="cargando img-chart-lfe" src="images/chart.png" class="img-rpm-lfe">
                                        <canvas id="myChart4" height="140"></canvas>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="row">
                                      <div class="col-md-12" id="rpm-4">
                                        <div class="loading"></div>
                                        <div>
                                          <img src="images/rpm.png" class="img-rpm-lfe">
                                          <canvas id="gauge4"></canvas>
                                        </div>
                                      </div>
                                      <div class="col-md-12 chart-lfe" id="chart-lfe5">
                                        <div class="loading"></div>
                                        <img class="cargando img-chart-lfe" src="images/chart.png" class="img-rpm-lfe">
                                        <canvas id="myChart5" height="140"></canvas>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="row">
                                      <div class="col-md-12" id="rpm-5">
                                        <div class="loading"></div>
                                        <div>
                                          <img src="images/rpm.png" class="img-rpm-lfe">
                                          <canvas id="gauge5"></canvas>
                                        </div>
                                      </div>
                                      <div class="col-md-12 chart-lfe" id="chart-lfe6">
                                        <div class="loading"></div>
                                        <img class="cargando img-chart-lfe" src="images/chart.png" class="img-rpm-lfe">
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
            .img-chart-lfe{
              width: 95%;
            }
            .cargando{
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

            
            .btn_error_custom{
              padding: 2px 12px;
            }

            .ico_error_custom{
              font-size: 15px;
            }

            .custom-error{
                  font-size: 10px;
            }
            
            .circle-custom{
              width: 20px;
              height: 20px;
            }
            .circle-custom i{
              font-size: 13px !important;
              left: -6.5px !important;
              top: -2px !important;
            }
              
            .vertical {
                writing-mode: vertical-lr;
                transform: rotate(180deg);
                position: absolute;
            }

            .chart-lfe{
              margin-top: -30px;
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

                  .loading{
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
                          animation:loading 1.2s linear infinite;
                          -webkit-animation:loading 1.2s linear infinite;
                          z-index: 1;
                        }
                  .loading-bomba{
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
                          animation:loading 1.2s linear infinite;
                          -webkit-animation:loading 1.2s linear infinite;
                          z-index: 1;
                        }
                        @keyframes loading{
                          0%{transform:rotate(0deg)}
                          100%{transform:rotate(360deg)}
                        }
                        @-webkit-keyframes loading{
                          0%{-webkit-transform:rotate(0deg)}
                          100%{-webkit-transform:rotate(360deg)}
                        }


            </style>




<script  src="instalaciones/VinaLuisFelipe.js"></script>

<script>


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

</script>