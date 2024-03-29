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
						                                        </td>
						                                    </tr>
						                                    <tr>
						                                        <td>01-10</td>
						                                        <td>50</td>
						                                        <td>1.245</td>
						                                        <td>
							                                        <i class="material-icons btn-bomba">add_circle</i>
										                              	</td>
						                                    </tr>
						                                    <tr>
						                                        <td>01-10</td>
						                                        <td>50</td>
						                                        <td>1.245</td>
						                                        <td>
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
                                    <div class="col-md-3">
                                    	<h4 align="left" style="color:black;padding-left: 3%;"></h4>
                                    </div>
                                    <div class="col-md-3">
																			<button class="btn btn-primary btn-block" style="width: 60%;">Bomba 1</button>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6" align="center"><canvas id="myChart0" height="70"></canvas></div>
                                <div class="col-md-3" align="center"><canvas id="gauge"></canvas></div>
                                <div class="col-md-3" align="center"><canvas id="myChart1" height="140"></canvas></div>
                          </div>
                        </div>

                        <div class="modal-footer">
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
                      var Titulo = [];
                      Titulo[0]="Flujos";
                      Titulo[1]="PH";


                function Graficar(mt_time, mt_value, titulo, id) {
                      var ctx = document.getElementById(id).getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels:  mt_time,
                            datasets: [{
                                radius: 0,
                                label: "",
                                data: mt_value,
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255,99,132,1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                          tooltips: {
                                enabled: true,
                                intersect: false
                            },
                          title: {
                              display: true,
                              text: titulo
                          },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        display: false, 
                                        maxTicksLimit: 10
                                    }
                                }]
                            }
                        }
                    });
                    }


                     var mt_value = '<?php echo json_encode($Datos["Flujo"]["mt_value"]); ?>';
                     mt_value=JSON.parse(mt_value);
                     var mt_value = Object.values(mt_value).map(n => n.toString())

                     var mt_time = '<?php echo json_encode($Datos["Flujo"]["mt_time"]); ?>';
                     mt_time=JSON.parse(mt_time);
                     var mt_time = Object.values(mt_time).map(n => n.toString())

                      Graficar(mt_time, mt_value, "Flujos", "myChart0");


                      var mt_value = '<?php echo json_encode($Datos["PH"]["mt_value"]); ?>';
                     mt_value=JSON.parse(mt_value);
                     var mt_value = Object.values(mt_value).map(n => n.toString())

                     var mt_time = '<?php echo json_encode($Datos["PH"]["mt_time"]); ?>';
                     mt_time=JSON.parse(mt_time);
                     var mt_time = Object.values(mt_time).map(n => n.toString())

                      Graficar(mt_time, mt_value, "PH", "myChart1");

                    $(".loader-insta").css("display", "none");


                    var PH=("<?php echo end($Datos["PH"]["mt_value"]); ?>"*10)/14;
                    PH=PH*10;

                    RPM(PH)
            </script>

