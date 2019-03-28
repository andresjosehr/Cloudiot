<div class="modal fade" id="defaultModalpar" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document" style="width: 70%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="row">
                              <div id="contenedorLFE2"></div>
                                <div class="col-md-2">
                                    <p class="modal-title" id="defaultModalLabel"></p>
                                </div>
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                     <div class="form-line">
                                         <input type="text" id="datetimesubmodalSicut" class="datetimepicker form-control" placeholder="Fecha Inicio">
                                     </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                     <div class="form-line">
                                         <input type="text" id="datetimesubmodal2Sicut" class="datetimepicker form-control" placeholder="Fecha Fin">
                                     </div>
                                  </div>
                                </div>
                                <div class="col-md-1">
                                  <button onclick="GraficPer();" type="button" class="btn btn-primary waves-effect">→</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <canvas id="myChart0" height="50"></canvas>
                        </div>
                        <div class="modal-footer">
                          <form id="TheFormSubModal" method="post" action="<?php echo Request::root() ?>/ExportarSicutExcel" target="TheWindow">
                             @csrf 
                             <div align="center">
                                <button type="submit" class="btn btn-primary" id="SicutExportarExcelIndi">Exportar a Excel</button>
                              </div>
                              <button type="button" class="btn btn-primary" onclick="$('#defaultModalpar').modal('toggle');">Cerrar</button>
                          </form>
                        </div>
                    </div>
                </div>
            </div>

            <button style="display: none" type="button" class="btn btn-default waves-effect m-r-20 submodal" data-toggle="modal" data-target="#defaultModalpar" id="defaultModal">MODAL </button>

            <script>

                $('#datetimesubmodalSicut').bootstrapMaterialDatePicker
                 ({
                   format: 'YYYY-MM-DD',
                   lang: 'es',
                   weekStart: 1, 
                   cancelText : 'ANNULER',
                   nowButton : true,
                   switchOnClick : true,
                   time: false
                 });

                 $('#datetimesubmodal2Sicut').bootstrapMaterialDatePicker
                 ({
                   format: 'YYYY-MM-DD',
                   lang: 'es',
                   weekStart: 1, 
                   cancelText : 'ANNULER',
                   nowButton : true,
                   switchOnClick : true,
                   time: false
                 });


              function GrafDef(id, mt_value1, mt_time1, mt_value2, mt_time2, min_dato, max_dato, label1, label2) {

                
                    var ctx = document.getElementById(id).getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: mt_time1,
                            datasets: [{
                                yAxisID: 'A',
                                label: label1,
                                data: mt_value1,
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1,
                                radius: 0
                            },
                            {   
                                yAxisID: 'B',
                                label: label2,
                                data: mt_value2,
                                backgroundColor: 'rgba(66, 134, 244, 0.2)',
                                borderColor: 'rgba(66, 134, 244, 1)',
                                borderWidth: 1,
                                radius: 0
                            }]
                        },
                        options: {
                            legend: {
                                display: true
                             },
                            tooltips: {
                                enabled: true,
                                intersect: false
                            },
                            scales: {
                                yAxes: [{
                                    id: 'A',
                                    position: 'left'
                                  }, {
                                    id: 'B',
                                    position: 'right'
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


                   function GrafDef2(id, mt_value1, mt_time1, mt_value2, mt_value3, mt_value4, min_dato, max_dato, label1, label2, label3, label4, loading, oculto) {

                   var ctx = document.getElementById(id).getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: mt_time1,
                            datasets: [{
                                label: label1,
                                data: mt_value1,
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: label2,
                                data: mt_value2,
                                backgroundColor: 'rgba(66, 134, 244, 0.2)',
                                borderColor: 'rgba(66, 134, 244, 1)',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: label3,
                                data: mt_value3,
                                backgroundColor: 'rgba(242, 255, 0, 0.2)',
                                borderColor: 'rgba(242, 255, 0, 1)',
                                borderWidth: 1,
                                radius: 0,
                                hidden: oculto
                            },
                            {
                                label: label4,
                                data: mt_value4,
                                backgroundColor: 'rgba(8, 255, 0, 0.2)',
                                borderColor: 'rgba(8, 255, 0, 1)',
                                borderWidth: 1,
                                radius: 0
                            }]
                        },
                        options: {
                            legend: {
                                display: true
                             },
                            tooltips: {
                                enabled: true,
                                intersect: false
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: false,
                                        min: min_dato,
                                        max: max_dato
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

                  if (Grac==1) {
                      GrafDef("myChart0", mt_value_def1, mt_time_def1, mt_value_def2, mt_time_def1, MinDato, MaxDato, "Inyectada", "Retirada");
                      SubirDatos1();
                  } else{
                    GrafDef2("myChart0",mt_value_def1, mt_time_def1, mt_value_def2, mt_value_def3, mt_value_def4, MinDato, MaxDato, "A", "B", "C", "Promedio", 4, false);
                    SubirDatos2();
                  }


                function GraficPer() {
                  if ($("#datetimesubmodalSicut").val()>$("#datetimesubmodal2Sicut").val() || $("#datetimesubmodalSicut").val()==0 || $("#datetimesubmodal2Sicut").val()==0) {
                      alert("Debes Escoger una feca valida");
                      val++;
                    } else{
                      var Horas = ((restaFechas($("#datetimesubmodalSicut").val(), $("#datetimesubmodal2Sicut").val()))+1)*24;
                    
                       $("#SicutSubModalContenedor").load("<?php echo Request::root() ?>/GraficoSigutIgnis"+grafper, {
                           HorasTotales: Horas,
                           Inicio: $("#datetimesubmodalSicut").val(),
                           Final: $("#datetimesubmodal2Sicut").val(),
                           Modal: true
                         });
                       $(".loader-insta").css("display", "block");
                       $('#defaultModalpar').modal('toggle');
                    }
                }


                $(".submodal").click();
                $(".loader-insta").css("display", "none");








      function SubirDatos1(){
          $( "#TheFormSubModal" ).append( "<input type='hidden' name='mt_time' value='"+mt_time_def1+"'>" );
          $( "#TheFormSubModal" ).append( "<input type='hidden' name='mt_value_1' value='"+mt_value_def1+"'>" );
          $( "#TheFormSubModal" ).append( "<input type='hidden' name='mt_value_2' value='"+mt_value_def2+"'>" );

          $( "#TheFormSubModal" ).append( "<input type='hidden' name='nombre_1' value='"+nombre_1+"'>" );
          $( "#TheFormSubModal" ).append( "<input type='hidden' name='nombre_2' value='"+nombre_2+"'>" );
          $( "#TheFormSubModal" ).append( "<input type='hidden' name='nombre_3' value='"+nombre_3+"'>" );
          $( "#TheFormSubModal" ).append( "<input type='hidden' name='tipo' value='1'>" );
      } 

      function SubirDatos2(){
          $( "#TheFormSubModal" ).append( "<input type='hidden' name='mt_time' value='"+mt_time_def1+"'>" );
          $( "#TheFormSubModal" ).append( "<input type='hidden' name='mt_value_1' value='"+mt_value_def1+"'>" );
          $( "#TheFormSubModal" ).append( "<input type='hidden' name='mt_value_2' value='"+mt_value_def2+"'>" );
          $( "#TheFormSubModal" ).append( "<input type='hidden' name='mt_value_3' value='"+mt_value_def3+"'>" );
          $( "#TheFormSubModal" ).append( "<input type='hidden' name='mt_value_4' value='"+mt_value_def4+"'>" );

          $( "#TheFormSubModal" ).append( "<input type='hidden' name='nombre_1' value='"+nombre_1+"'>" );
          $( "#TheFormSubModal" ).append( "<input type='hidden' name='nombre_2' value='"+nombre_2+"'>" );
          $( "#TheFormSubModal" ).append( "<input type='hidden' name='nombre_3' value='"+nombre_3+"'>" );
          $( "#TheFormSubModal" ).append( "<input type='hidden' name='nombre_4' value='"+nombre_4+"'>" );
          $( "#TheFormSubModal" ).append( "<input type='hidden' name='nombre_5' value='"+nombre_5+"'>" );
          $( "#TheFormSubModal" ).append( "<input type='hidden' name='tipo' value='2'>" );
      } 

    </script>