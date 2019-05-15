
<div id="FlujoDiarioGrafico"></div>

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

  

   var ctx = document.getElementById("FlujoDiarioGrafico").getContext('2d');
   var myChart = new Chart(ctx, {
     type: 'bar',
     data: {
         labels: [1, 1],
         datasets: [{
             data: [2, 2],
             backgroundColor: 'rgba(255, 99, 132, 0.8)',
             borderColor: 'rgba(255,99,132,1)',
             borderWidth: 1
         }]
     },
     options: {

      title: {
            display: true,
            text: titulo
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

</script>