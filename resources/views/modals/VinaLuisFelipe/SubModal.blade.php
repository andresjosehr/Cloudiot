

<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document" style="width: 70%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="row">
                              <div id="contenedorLFE2"></div>
                                <div class="col-md-2">
                                    <p class="modal-title" id="defaultModalLabel">{{ $Titulo }}</p>
                                </div>
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                     <div class="form-line">
                                         <input type="text" id="datetimesubmodal" class="datetimepicker form-control" placeholder="Fecha Inicio">
                                     </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                     <div class="form-line">
                                         <input type="text" id="datetimesubmodal2" class="datetimepicker form-control" placeholder="Fecha Fin">
                                     </div>
                                  </div>
                                </div>
                                <div class="col-md-1">
                                  <button onclick="RecogerFecha();" type="button" class="btn btn-primary waves-effect">→</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <canvas id="ChartSubModal" height="50"></canvas>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>

            <button style="display: none" type="button" class="btn btn-default waves-effect m-r-20 submodal" data-toggle="modal" data-target="#defaultModal" id="defaultModal">MODAL </button>

            <script>

              let mt_name='<?php echo $mt_name; ?>';

              function RecogerFecha() {
                $(".loader-insta").css("display", "block");
                var FechaInicio = document.getElementById('datetimesubmodal').value;
                var FechaFin = document.getElementById('datetimesubmodal2').value;

                var url = "<?php echo Request::root() ?>/CalculosLuisFelipe3";  
                $("#contenedorLFE2").load(url, {FechaInicio: FechaInicio, FechaFin: FechaFin, mt_name: mt_name});

              }

              $('#datetimesubmodal').bootstrapMaterialDatePicker
                ({
                  format: 'YYYY-MM-DD HH:mm',
                  lang: 'fr',
                  weekStart: 1, 
                  cancelText : 'ANNULER',
                  nowButton : true,
                  switchOnClick : true
                });

                $('#datetimesubmodal2').bootstrapMaterialDatePicker
                ({
                  format: 'YYYY-MM-DD HH:mm',
                  lang: 'fr',
                  weekStart: 1, 
                  cancelText : 'ANNULER',
                  nowButton : true,
                  switchOnClick : true
                });
                function ChartSubModal(mt_time, mt_value) {
                    var ctx = document.getElementById("ChartSubModal").getContext('2d');
                        var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: [],
                            datasets: [{
                                label: '',
                                data: mt_value,
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
                        $(".loader-insta").css("display", "none");
                }

                ChartSubModal("<?php $mt_time; ?>", "<?php $mt_value; ?>");


                $(".submodal").click();
                $(".loader-insta").css("display", "none");
            </script>