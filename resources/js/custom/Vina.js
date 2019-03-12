



window.VinaRPM=function(tipo, valor, id, gaugecanvas, rango, dato, valor_real) {

    if (dato=="Normal") {
        var colores= [
                {
                  "from": 0,
                  "to": 100,
                  "color": "#fff"
                }
            ];
    } else{

        var colores= [
                {
                  "from": 0,
                  "to": 35.71,
                  "color": "rgba(200, 50, 50, .75)"
                },
                {
                  "from": 35.71,
                  "to": 57.14,
                  "color": "rgba(100, 255, 100, .2)"
                },
                {
                    "from": 57.14,
                    "to": 100,
                    "color": "rgba(200, 50, 50, .75)"
                }
            ];

    }

        $("p").css("display", "block");

        var gauge = new RadialGauge({
            renderTo: id,
            width: 120,
            height: 120,
            units: valor_real,
            fontUnitsSize: 50,
            value: valor,
            minValue: 0,
            startAngle: 90,
            ticksAngle: 180,
            valueBox: false,
            maxValue: 100,
            majorTicks: rango,
            minorTicks: 4,
            strokeTicks: true,
            highlights: colores,
            colorPlate: "#fff",
            borderShadowWidth: 0,
            borders: false,
            needleType: "arrow",
            needleWidth: 5,
            needleCircleSize: 2,
            needleCircleOuter: true,
            needleCircleInner: false,
            animationDuration: 1500,
            animationRule: "linear"
        }).draw();

        $("#"+gaugecanvas+" canvas").css("display", "block");
        $("#"+gaugecanvas+" img").css("display", "none");
        $("#"+gaugecanvas+" .vina-loading").css("display", "none");
}


window.VinaGraficos = function(divcanvas, chartcanvas, mt_value, mt_time) {


                      var ctx = document.getElementById(chartcanvas).getContext('2d');
                        var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: mt_time,
                            datasets: [{
                                label: '',
                                data: mt_value,
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255,99,132,1)',
                                borderWidth: 1,
                                radius: 0
                            }]
                        },
                        options: {
                            legend: {
                                display: false
                             },
                            tooltips: {
                                enabled: true,
                                intersect: false
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

                    $("#"+divcanvas+" .vina-loading").css("display", "none");
                    $("#"+divcanvas+" img").css("display", "none");
                    $("#"+chartcanvas).css("display", "block");
}

window.VinaBombas = function(Operativa, ErrorBomba) {

    for (var i = 0; i <= 4; i++) {

        $( ".bomba"+i+"-op" ).removeClass("bg-green");
        $( ".bomba"+i+"-op" ).removeClass("bg-red");
        $( ".vina-btn-bomba-error"+i ).removeClass("bg-red");
        $( ".btncasc"+i ).removeClass("bg-green");
        $( ".btncasc"+i ).removeClass("bg-red");
        $( ".bomba"+i+"-op" ).empty();
        $( ".bomba"+i+"-op-btn" ).empty(); 
        $( ".texto-error"+i ).empty();

        if (Operativa[i]=="Operativa") {
            $( ".bomba"+i+"-op" ).addClass("bg-green");
            $( ".bomba"+i+"-op" ).text("Op.");
            $( ".bomba"+i+"-op-btn" ).text("error_outline");
            $( ".btncasc"+i ).addClass("bg-red");
        } else{
            $( ".bomba"+i+"-op" ).addClass("bg-red");
            $( ".bomba"+i+"-op" ).text("No Op.");
            $( ".bomba"+i+"-op-btn" ).text("check");
            $( ".btncasc"+i ).addClass("bg-green");
        }

        if (ErrorBomba[i]=="Error") {
            $( ".vina-btn-bomba-error"+i ).addClass("bg-red");
            $( ".texto-error"+i ).text("Error");
        } else{
            $( ".vina-btn-bomba-error"+i ).addClass("bg-green");
            $( ".texto-error"+i ).text("Sin Error");
        }
        

    }

    $( ".bombas-cargando" ).removeClass("vina-cargando");

    $( ".vina-loading-bomba" ).css("display", "none");

    
}

window.VinaScriptDefault = function(url_, instalacion_info){

    $("#contenedorLFE").load(url_, {instalacion: instalacion_info});

    $( ".vina-modal" ).click();
    $(".loader-insta").css("display", "none");

    $('#fecha_flujo_inicio').bootstrapMaterialDatePicker
    ({
      format: 'YYYY-MM-DD',
      lang: 'fr',
      weekStart: 1, 
      cancelText : 'ANNULER',
      nowButton : true,
      switchOnClick : true,
      time: false
    });

    $('#fecha_flujo_fin').bootstrapMaterialDatePicker
    ({
      format: 'YYYY-MM-DD',
      lang: 'fr',
      weekStart: 1, 
      cancelText : 'ANNULER',
      nowButton : true,
      switchOnClick : true,
      time: false
    });

    $('#fecha_ph_inicio').bootstrapMaterialDatePicker
    ({
      format: 'YYYY-MM-DD',
      lang: 'fr',
      weekStart: 1, 
      cancelText : 'ANNULER',
      nowButton : true,
      switchOnClick : true,
      time: false
    });

    $('#fecha_ph_fin').bootstrapMaterialDatePicker
    ({
      format: 'YYYY-MM-DD',
      lang: 'fr',
      weekStart: 1, 
      cancelText : 'ANNULER',
      nowButton : true,
      switchOnClick : true,
      time: false
    });

    $('#fecha_orp_inicio').bootstrapMaterialDatePicker
    ({
      format: 'YYYY-MM-DD',
      lang: 'fr',
      weekStart: 1, 
      cancelText : 'ANNULER',
      nowButton : true,
      switchOnClick : true,
      time: false
    });


    $('#fecha_ph_fin').bootstrapMaterialDatePicker
    ({
      format: 'YYYY-MM-DD',
      lang: 'fr',
      weekStart: 1, 
      cancelText : 'ANNULER',
      nowButton : true,
      switchOnClick : true,
      time: false
    });

    $('#fecha_conductividad_inicio').bootstrapMaterialDatePicker
    ({
      format: 'YYYY-MM-DD',
      lang: 'fr',
      weekStart: 1, 
      cancelText : 'ANNULER',
      nowButton : true,
      switchOnClick : true,
      time: false
    });

    $('#fecha_conductividad_fin').bootstrapMaterialDatePicker
    ({
      format: 'YYYY-MM-DD',
      lang: 'fr',
      weekStart: 1, 
      cancelText : 'ANNULER',
      nowButton : true,
      switchOnClick : true,
      time: false
    });

    $('#datetime').bootstrapMaterialDatePicker
         ({
           format: 'DD/MM/YYYY HH:mm',
           lang: 'fr',
           weekStart: 1, 
           cancelText : 'ANNULER',
           nowButton : true,
           switchOnClick : true
         });

}

window.GraficarphPersonalizado = function(url_) {
     var fecha_ph_inicio = document.getElementById("fecha_ph_inicio").value;
     var fecha_ph_fin = document.getElementById("fecha_ph_fin").value;
     $(".loader-insta").css("display", "block");
     var url = url_;
     $("#PHDiarioContenedor").load(url, {FechaInicio: fecha_ph_inicio, FechaFin: fecha_ph_fin});
}


window.GraficarFlujoPersonalizado = function(url_) {

      $(".loader-insta").css("display", "block");
      var FechaInicio = document.getElementById('fecha_flujo_inicio').value;
      var FechaFin = document.getElementById('fecha_flujo_fin').value;
      var url = url_;
       $("#contenedorFlujos").load(url, {FechaInicio: FechaInicio, FechaFin: FechaFin});
   }

   window.GraficarFlujos = function(url_) {
        var url = url_;
       $("#contenedorFlujos").load(url, {FechaInicio: "Prueba"});
   }

   window.GraficarORPPersonalizado = function(url_) {
     var fecha_orp_inicio = document.getElementById("fecha_orp_inicio").value;
     var fecha_orp_fin = document.getElementById("fecha_orp_fin").value;
     $(".loader-insta").css("display", "block");
     var url = url_;
     $("#ORPDiarioContenedor").load(url, {FechaInicio: fecha_orp_inicio, FechaFin: fecha_orp_fin});
}


window.GraficarConductividadPersonalizado = function(url_) {
     var fecha_conductividad_inicio = document.getElementById("fecha_conductividad_inicio").value;
     var fecha_conductividad_fin = document.getElementById("fecha_conductividad_fin").value;
     $(".loader-insta").css("display", "block");
     var url = url_;
     $("#ConductividadDiarioContenedor").load(url, {FechaInicio: fecha_conductividad_inicio, FechaFin: fecha_conductividad_fin});
}



window.GraficarPHDiario = function (url_) {
    if (document.getElementById("ph-bar-chart").height==70) {
         var url = url_;
         $("#PHDiarioContenedor").load(url, {dato: "Epa"});
      }
}

window.GraficarORPDiario = function (url_) {
    if (document.getElementById("orp-bar-chart").height==70) {
         var url = url_;
         $("#ORPDiarioContenedor").load(url, {dato: "Epa"});
      }
}

window.GraficarConductividadDiario = function (url_) {
    if (document.getElementById("conductividad-bar-chart").height==70) {
         var url = url_;
         $("#ConductividadDiarioContenedor").load(url, {dato: "Epa"});
      }
}


window.ListarBombas=function(url_){

      $(".loader-insta").css("display", "block");
      var url = url_;
      $("#contenedorLFE").load(url, {dato: "Epa"});
}

window.GraficarFlujo = function (mt_time, mt_value, id, titulo, intra) {

$("#flujo-bar-chart-div"+intra).empty();
$("#flujo-bar-chart-div"+intra).html('<canvas id="flujo-bar-chart'+intra+'" width="400" height="40"></canvas>');


   var ctx = document.getElementById("flujo-bar-chart"+intra).getContext('2d');
   var myChart = new Chart(ctx, {
     type: 'bar',
     data: {
         labels: mt_time,
         datasets: [{
             data: mt_value,
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

}

window.GraficarPHDiarioJS = function(mt_time, mt_value, mt_value_salida) {
         var ctx = document.getElementById("ph-bar-chart").getContext('2d');
         var myChart = new Chart(ctx, {
           type: 'bar',
           data: {
               labels: mt_time,
               datasets: [{
                   label: 'PH Entrada',
                   data: mt_value,
                   backgroundColor: 'rgba(255, 99, 132, 0.8)',
                   borderColor: 'rgba(255,99,132,1)',
                   borderWidth: 1
               },
               {
                   label: 'PH Salida',
                   data: mt_value_salida,
                   backgroundColor: 'rgba(66, 134, 244, 0.8)',
                   borderColor: 'rgba(66, 134, 244,1)',
                   borderWidth: 1
               }]
           },
           options: {
            legend: {
               display: true
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

       let mt_time_ph=mt_time;
       let mt_value_ph=mt_value;

      $(".vina-vina-loadingPH").css("display", "none");
      $(".BotonExportarPHDiarios").css("display", "block");
}


window.GraficarORPDiarioJS = function(mt_time, mt_value, mt_value_salida) {


         var ctx = document.getElementById("orp-bar-chart").getContext('2d');
         var myChart = new Chart(ctx, {
           type: 'bar',
           data: {
               labels: mt_time,
               datasets: [{
                   label: 'ORP Entrada',
                   data: mt_value,
                   backgroundColor: 'rgba(255, 99, 132, 0.8)',
                   borderColor: 'rgba(255,99,132,1)',
                   borderWidth: 1
               },
               {
                   label: 'ORP Salida',
                   data: mt_value_salida,
                   backgroundColor: 'rgba(66, 134, 244, 0.8)',
                   borderColor: 'rgba(66, 134, 244,1)',
                   borderWidth: 1
               }]
           },
           options: {
            legend: {
               display: true
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

      $(".vina-loadingORP").css("display", "none");
      $(".BotonExportarORPDiarios").css("display", "block");
}

window.GraficarConductividadDiarioJS = function(mt_time, mt_value, mt_value_salida) {


         var ctx = document.getElementById("conductividad-bar-chart").getContext('2d');
         var myChart = new Chart(ctx, {
           type: 'bar',
           data: {
               labels: mt_time,
               datasets: [{
                   label: 'Conductividad Entrada',
                   data: mt_value,
                   backgroundColor: 'rgba(255, 99, 132, 0.8)',
                   borderColor: 'rgba(255,99,132,1)',
                   borderWidth: 1
               },
               {
                   label: 'Conductividad Salida',
                   data: mt_value_salida,
                   backgroundColor: 'rgba(66, 134, 244, 0.8)',
                   borderColor: 'rgba(66, 134, 244,1)',
                   borderWidth: 1
               }]
           },
           options: {
            legend: {
               display: true
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

      $(".vina-loadingConductividad").css("display", "none");
      $(".BotonExportarConductividadDiarios").css("display", "block");
}



window.CompilarRango = function(alto, bajo, tiemporiego, tiemporeposo) {
   
         var slider = document.getElementById('slider');
      
             noUiSlider.create(slider, {
                 start: [bajo, alto],
                 step: 0.1,
                 connect: true,
                 range: {
                     'min': 0,
                     'max': 14
                 },
                 format: wNumb({
                     decimals: 1
                 })
             });
   
             var nodes = [
                 document.getElementById("BajoPH"), // 0
                 document.getElementById('AltoPH')  // 1
             ];
   
             // Display the slider value and how far the handle moved
             // from the left edge of the slider.
             slider.noUiSlider.on('update', function (values, handle, unencoded, isTap, positions) {
                 nodes[handle].innerHTML = values[handle];
             });


   
             var riego = document.getElementById('Riego');
   
             noUiSlider.create(riego, {
                 start: tiemporiego,
   
                 // Disable animation on value-setting,
                 // so the sliders respond immediately.
                 animate: false,
                 step: 1,
                 decimals: 0,
                 range: {
                     min: 0,
                     max: 100
                 },
                 format: wNumb({
                     decimals: 0,
                     thousand: '.',
                 })
             });
   
             riego.noUiSlider.on('update', function (values, handle) {
                document.getElementById('RiegoValor').innerHTML = values[handle];
             });
   
   
             var reposo = document.getElementById('Reposo');
   
             noUiSlider.create(reposo, {
                 start: tiemporeposo,
   
                 // Disable animation on value-setting,
                 // so the sliders respond immediately.
                 animate: false,
                 step: 1,
                 decimals: 0,
                 range: {
                     min: 0,
                     max: 100
                 },
                 format: wNumb({
                     decimals: 0,
                     thousand: '.',
                 })
             });
   
             reposo.noUiSlider.on('update', function (values, handle) {
                document.getElementById('ReposoValor').innerHTML = values[handle];
             });

             $(".noUi-handle").addClass("vina-noUi-handle");
             $(".noUi-connect").addClass("vina-noUi-connect");
   }  


 window.RegistarRangoPH = function(url_) {
   
         $(".boton3").css("display", "none");
         $(".vina-vina-loadingg3").css("display", "block");
   
         var RangoPH_Inicio = $("#BajoPH").text();
         var RangoPH_Fin = $("#AltoPH").text();
         var url = url_;
         $("#parametros-ejecucion").load(url, {RangoPH_Ini: RangoPH_Inicio, RangoPH_Fini: RangoPH_Fin});
   
}


    window.RegistarRiego = function (url_) {
         $(".boton1").css("display", "none");
         $(".vina-vina-loadingg1").css("display", "block");
        var MinutosRiego = $("#RiegoValor").text(); 
         var url = url_;
         $("#parametros-ejecucion").load(url, {Riego: MinutosRiego});
    }
   
       window.RegistarReposo = function (url_) {
         $(".boton2").css("display", "none");
         $(".vina-vina-loadingg2").css("display", "block");
        var MinutosReposo = $("#ReposoValor").text();
        var url = url_;
        $("#parametros-ejecucion").load(url, {Reposo: MinutosReposo});
   
   
       }


