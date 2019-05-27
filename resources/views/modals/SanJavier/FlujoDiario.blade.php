
<div id="contenedorFlujos"></div>
                    <div class="row">
                        <div id="contenedorLFE2"></div>
                        <div class="col-md-2">
                            {{--
                            <p class="modal-title" id="defaultModalLabel">Flujos</p> --}}
                        </div>
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="fecha_flujo_inicio" class="datetimepicker form-control" placeholder="Fecha Inicio">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="fecha_flujo_fin" class="datetimepicker form-control" placeholder="Fecha Fin">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button onclick="GraficarFlujoPersonalizadoJavier('<?php echo Request::root() ?>/GraficarFlujoPersonalizadoJavier');" type="button" class="btn btn-primary waves-effect">→</button>
                        </div>
                    </div>

                    <canvas id="FlujoDiarioGrafico" width="400" height="70"></canvas>

                    <div align="center" style="margin-top: 50px;">
                      <button class="btn btn-primary" onclick="window.open('{{Request::root()}}/DescargarExcelFlujoJavier?mt_value='+window.mt_value+'&mt_time='+window.mt_time+'&tipo=JavierFlujoDiario', '_blank');">Descargar Excel</button>
                    </div>

<script>



           var i=0;
           var mt_time = [];
           var mt_value = [];

           var mt_time_flujos = [];
           var mt_value_flujos = [];
          <?php for($i=0; $i<count($GraficoBarras); $i++){ ?>

             mt_time[i]='<?php echo date_format(date_create($GraficoBarras[$i]['mt_time']), 'm-j') ?>';
             mt_value[i]='<?php echo $GraficoBarras[$i]['mt_value'] ?>';

             mt_time_flujos[i] = "<?php echo $GraficoBarras[$i]['mt_time'] ?>";
             mt_value_flujos = mt_value;
             i++;


          <?php } ?>

  

   var ctx =  $("#FlujoDiarioGrafico")[0]; 
   var ctx = ctx.getContext('2d');
   var myChart = new Chart(ctx, {
     type: 'bar',
     data: {
         labels: mt_time,
         datasets: [{
             data: mt_value_flujos,
             backgroundColor: 'rgba(255, 99, 132, 0.8)',
             borderColor: 'rgba(255,99,132,1)',
             borderWidth: 1
         }]
     },
     options: {

      title: {
            display: true,
            text: "Flujo diario"
        },
      legend: {
         display: false
      },
      scales: {
             yAxes: [{
                 ticks: {
                     beginAtZero: false,
                     min: 160,
                     max: 0,
                     steps: 20
                 }
             }]
         },
      "animation": {
         "duration": 1,
         "onComplete": function() {
           var chartInstance = this.chart,
             ctx = chartInstance.ctx;

           ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
           ctx.textAlign = 'center';
           ctx.textBaseline = 'bottom';

           this.data.datasets.forEach(function(dataset, i) {
             var meta = chartInstance.controller.getDatasetMeta(i);
             meta.data.forEach(function(bar, index) {
               var data = dataset.data[index];
               ctx.fillText(data, bar._model.x, bar._model.y - 5);
             });
           });
         }
      },
         scales: {
             yAxes: [{
                 ticks: {
                     beginAtZero:true,
                     padding: 100
                 }
             }], xAxes: [{
                     padding: 50,
                     lineHeight: 3,
                 ticks: {
                     padding: 50,
                     lineHeight: 3
                 }
             }]
         }
     }
   });



      $('#fecha_flujo_inicio, #fecha_flujo_fin').bootstrapMaterialDatePicker
    ({
      format: 'YYYY-MM-DD',
      lang: 'fr',
      weekStart: 1, 
      cancelText : 'ANNULER',
      nowButton : true,
      switchOnClick : true,
      time: false
    });


    window.GraficarFlujoPersonalizadoJavier = function(url_) {

      $(".loader-insta").css("display", "block");
      var FechaInicio = document.getElementById('fecha_flujo_inicio').value;
      var FechaFin = document.getElementById('fecha_flujo_fin').value;
      var url = url_;
       $("#JavierFlujoDiario").load(url, {FechaInicio: FechaInicio, FechaFin: FechaFin});
   }


   $(".loader-insta").css("display", "none")

</script>