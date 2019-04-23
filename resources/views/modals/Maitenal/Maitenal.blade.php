<button type="button" class="btn btn-default waves-effect m-r-20 display-modal" data-toggle="modal" data-target="#largeModal" style="display: none"></button>

   <!-- Large Size -->
            <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document" style="width: 95%;margin-top: 2%;">
                    <div class="modal-content">
                        <div class="modal-header">
                          <div class="row">
                            <div class="col-md-2">
                              <h4 class="modal-title nombre-instalacion" id="largeModalLabel" >El Maitenal</h4>
                            </div>
                            <div class="col-md-3">
                              <h4 class="modal-title nombre-instalacion" id="largeModalLabel">Ultima Mendicion</h4> 
                            </div>
                          </div>
                        </div>
                        <hr style=" color: black">  
                        <div class="modal-body table-custom">
                            <div class="row" align="center">
                                    <div class="col-md-4">
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
						                                        </td>
						                                    </tr>
						                                    <tr>
						                                        <td>01-10</td>
						                                        <td>50</td>
						                                        <td>1.245</td>
						                                        <td>
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
						                                        </td>
						                                    </tr>
						                                </tbody>
						                            </table>
						                        	</div>
                                    </div>
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
									<div class="bombas-cargando" style="padding-top: 76px;">
                                 <div class="row">
                                    <div class="col-md-4">
                                       Bomba 1
                                    </div>
                                    <div class="col-md-1">
                                       <button type="button" class="btncasc0 btn btn-circle waves-effect waves-circle waves-float vina-circle-custom bg-green">
                                       <i class="material-icons bomba0-op-btn">check</i>
                                       </button>
                                       <br>
                                    </div>
                                    <div class="col-md-3">
                                       <span class="badge bomba0-op bg-red">No Op.</span>
                                    </div>
                                    <div class="col-md-3">
                                       <button type="button" class="vina-btn-bomba-error0 btn waves-effect vina-btn_error_custom bg-green">
                                       <span class="vina-custom-error texto-error0">Sin Error</span>
                                       </button>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-4">
                                       Bomba 2
                                    </div>
                                    <div class="col-md-1">
                                       <button type="button" class="btncasc1 btn btn-circle waves-effect waves-circle waves-float vina-circle-custom bg-green">
                                       <i class="material-icons bomba1-op-btn">check</i>
                                       </button>
                                       <br>
                                    </div>
                                    <div class="col-md-3">
                                       <span class="badge bomba1-op bg-red">No Op.</span>
                                    </div>
                                    <div class="col-md-3">
                                       <button type="button" class="vina-btn-bomba-error1 btn waves-effect vina-btn_error_custom bg-green">
                                       <span class="vina-custom-error texto-error1">Sin Error</span>
                                       </button>
                                    </div>
                                 </div>
                              </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                	<canvas id="myChart" height="80"></canvas>
                                </div>
                          </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
			<script>
			var ctx = document.getElementById('myChart').getContext('2d');
			var myChart = new Chart(ctx, {
			    type: 'line',
			    data: {
			        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
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
			                'rgba(255, 99, 132, 1)',
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
			                    beginAtZero: true
			                }
			            }]
			        }
			    }
			});
			</script>

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
            </script>

