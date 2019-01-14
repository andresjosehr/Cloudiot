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
                                    <div class="col-md-3">
                                    	<h4 align="left" style="color:black;padding-left: 3%;"></h4>
                                    </div>
                                    <div class="col-md-3">
																			<button class="btn btn-primary btn-block" style="width: 60%;">Bomba 1</button>
																			<button class="btn btn-primary btn-block" style="width: 60%;">Bomba 2</button>
																			<button class="btn btn-primary btn-block" style="width: 60%;">Bomba 3</button>
																			<button class="btn btn-primary btn-block" style="width: 60%;">Bomba 4</button>
																			<button class="btn btn-primary btn-block" style="width: 60%;">Bomba 5</button>
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

            <script>
                $( ".display-modal" ).click();
                      for (var i = 0; i <= 1; i++) {
                      var ctx = document.getElementById("myChart"+i).getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: [],
                            datasets: [{
                                label: '',
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
                    $(".loader-insta").css("display", "none");
            </script>


<script  src="rpm/js/index.js"></script>