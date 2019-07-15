
window.SicutScriptDefault = function() {
    $( ".display-modal" ).click();
    $(".loader-insta").css("display", "none");


    $('#datetimesubmodal').bootstrapMaterialDatePicker
         ({
           format: 'DD-MM-YYYY',
           lang: 'es',
           weekStart: 1, 
           cancelText : 'ANNULER',
           nowButton : true,
           switchOnClick : true,
           time: false
         });

         $('#datetimesubmodal2').bootstrapMaterialDatePicker
         ({
           format: 'DD-MM-YYYY',
           lang: 'es',
           weekStart: 1, 
           cancelText : 'ANNULER',
           nowButton : true,
           switchOnClick : true,
           time: false
         });
}
window.GraficosIgnisArriba=function(id, mt_value1, mt_time1, mt_value2, mt_time2, min_dato, max_dato, label1, label2, loading, Colores) {

                
                    var ctx = document.getElementById(id).getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: mt_time1,
                            datasets: [{
                                label: label1,
                                data: mt_value1,
                                backgroundColor: Colores[0],
                                borderColor:     Colores[1],
                                fill: false,
                                borderWidth: 1,
                                radius: 0
                            },
                            {   
                                label: label2,
                                data: mt_value2,
                                backgroundColor: Colores[2],
                                borderColor:     Colores[3],
                                fill: false,
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
                                xAxes: [{
                                    ticks: {
                                        display: false, 
                                        maxTicksLimit: 10
                                    }
                                }]
                            }
                        }
                    });

                    $("#sicut-loading"+loading).css("display", "none");

}




window.GraficosPotenciaINY=function(id, mt_value1, mt_time1, mt_value2, mt_time2, min_dato, max_dato, label1, label2, loading) {

                
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
                                fill: false,
                                radius: 0
                            }
                            // ,{   
                            //     label: label2,
                            //     data: mt_value2,
                            //     backgroundColor: 'rgba(66, 134, 244, 0.2)',
                            //     borderColor: 'rgba(66, 134, 244, 1)',
                            //     borderWidth: 1,
                            //     radius: 0
                            // }
                            ]
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
                                xAxes: [{
                                    ticks: {
                                        display: false, 
                                        maxTicksLimit: 10
                                    }
                                }]
                            }
                        }
                    });

                    $("#sicut-loading"+loading).css("display", "none");

}





window.GraficosIgnisAbajo = function(id, mt_value1, mt_time1, mt_value2, mt_value3, mt_value4, min_dato, max_dato, label1, label2, label3, label4, loading, oculto) {

                  
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
                                fill: false,
                                radius: 0
                            },
                            {
                                label: label2,
                                data: mt_value2,
                                backgroundColor: 'rgba(66, 134, 244, 0.2)',
                                borderColor: 'rgba(66, 134, 244, 1)',
                                borderWidth: 1,
                                fill: false,
                                radius: 0
                            },
                            {
                                label: label3,
                                data: mt_value3,
                                backgroundColor: 'rgba(242, 255, 0, 0.2)',
                                borderColor: 'rgba(242, 255, 0, 1)',
                                borderWidth: 1,
                                fill: false,
                                radius: 0,
                                hidden: oculto
                            },
                            {
                                label: label4,
                                data: mt_value4,
                                backgroundColor: 'rgba(8, 255, 0, 0.2)',
                                borderColor: 'rgba(8, 255, 0, 1)',
                                borderWidth: 1,
                                fill: false,
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

                    $("#sicut-loading"+loading).css("display", "none");

}


window.GraficoIgnisArribaDerecha=function(id, mt_value1, mt_time1, mt_value2, mt_time2, min_dato_a, max_dato_a, min_dato_b, max_dato_b, label1, label2, loading) {
                
                    var ctx = document.getElementById(id).getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: mt_time1,
                            datasets: [{
                                label: label1,
                                data: mt_value1,
                                backgroundColor: 'rgba(66, 134, 244, 0.2)',
                                borderColor:     'rgba(66, 134, 244, 1)',
                                borderWidth: 1,
                                fill: false,
                                radius: 0
                            },
                            {   label: label2,
                                data: mt_value2,
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor:     'rgba(255, 99, 132, 1)',
                                borderWidth: 1,
                                fill: false,
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
                                xAxes: [{
                                    ticks: {
                                        display: false, 
                                        maxTicksLimit: 10
                                    }
                                }]
                            }
                        }
                    });

                    $("#sicut-loading"+loading).css("display", "none");

}
window.SicutPieChart = function(){

    var ctx = document.getElementById("sicut-pie-chart").getContext('2d');

    var pieChart = new Chart(ctx, {
      type: 'pie',
      data: {
            labels: [
                "Dato 1",
                "Dato 2",
                "Dato 3"
            ],
            datasets: [
                {
                    data: [133.3, 86.2, 52.2],
                    backgroundColor: [
                        "#FF6384",
                        "#63FF84",
                        "#84FF63"
                    ]
                }]
        },
        options: {
        legend: {
            display: true
         },
         title: {
            display: true,
            text: 'Potencia Generada'
        },
        tooltips: {
                enabled: true,
                intersect: false
            },
        scales: {
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


window.PotGenerada = function (mt_time, mt_value1, mt_value2, Colores){
  var ctx = document.getElementById("sicut-myChart3").getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: mt_time,
          datasets: [{
              label: 'Inyectada',
              data: mt_value1,
              backgroundColor: Colores[0],
              borderColor:     Colores[1],
              borderWidth: 1,
              radius: 0,
              fill: false,
          }
          ,{
              label: 'Retirada',
              data: mt_value2,
              backgroundColor: Colores[2],
              borderColor:     Colores[3],
              borderWidth: 1,
              fill: false,
              radius: 0
          }
          ]
      },
      options: {
                            legend: {
                                display: true
                             },
                            tooltips: {
                                enabled: true,
                                intersect: false
                            },
                            title: {
                                      display: false,
                                  },
                            scales: {
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

window.GraficarDefaultIgnis=function(url, param){
  $(".loader-insta").css("display", "block");
  $("#SicutSubModalContenedor").load(url+"/GraficoSigutIgnis"+param, {
    HorasTotales: "48",
    Modal: true
  });
}
window.GraficarTodo=function(url){

    $("#SicutContenedor5").load(url+"/GraficoSigutIgnis5", {dato: "Epa5"});
    $("#SicutContenedor7").load(url+"/GraficoSigutIgnis7", {dato: "Epa5"});
    $("#SicutContenedor1").load(url+"/GraficoSigutIgnis1", {dato: "Epa"});
    $("#SicutContenedor2").load(url+"/GraficoSigutIgnis2", {dato: "Epa2"});
    $("#SicutContenedor3").load(url+"/GraficoSigutIgnis3", {dato: "Epa3"});
    $("#SicutContenedor4").load(url+"/GraficoSigutIgnis4", {dato: "Epa4"});
}

window.GraficarGra5 = function(mt_time_, EnergiaActivaInyectada_, EnergiaActivaRetirada_, EnergiaReactivaInyectada_, EnergiaReactivaRetirada_) {
  
  
  
  
  $("#SicutContenedor5").load("/GraficoSigutIgnis5", {
    mt_time: mt_time_,
    EnergiaActivaInyectada: EnergiaActivaInyectada_,
    EnergiaActivaRetirada: EnergiaActivaRetirada_,
    EnergiaReactivaInyectada: EnergiaReactivaInyectada_,
    EnergiaReactivaRetirada: EnergiaReactivaRetirada_
  });
}
                    