
window.SicutScriptDefault = function() {
    $( ".display-modal" ).click();
    $(".loader-insta").css("display", "none");
}

window.GraficosIgnisArriba=function(id, mt_value1, mt_time1, mt_value2, mt_time2, min_dato, max_dato, label1, label2, loading) {

                
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

                    $("#sicut-loading"+loading).css("display", "none");

}





window.GraficosIgnisAbajo = function(id, mt_value1, mt_time1, mt_value2, mt_value3, mt_value4, min_dato, max_dato, label1, label2, label3, label4, loading, oculto) {

                    console.log(min_dato);
                    console.log(max_dato);
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
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1,
                                radius: 0
                            },
                            {   label: label2,
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
            display: false
         },
         title: {
            display: true,
            text: 'Potencia Generada'
        }
      }
    });

}

window.PotGenerada = function (){
  var ctx = document.getElementById("sicut-myChart3").getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
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
        legend: {
            display: false
         },
         title: {
            display: true,
            text: 'Potencia Generada'
        },
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

window.GraficarTodo=function(url){

    $("#SicutContenedor6").load(url+"/GraficoSigutIgnis6", {dato: "Epa5"});
    $("#SicutContenedor7").load(url+"/GraficoSigutIgnis7", {dato: "Epa5"});
    $("#SicutContenedor1").load(url+"/GraficoSigutIgnis1", {dato: "Epa"});
    $("#SicutContenedor2").load(url+"/GraficoSigutIgnis2", {dato: "Epa2"});
    $("#SicutContenedor3").load(url+"/GraficoSigutIgnis3", {dato: "Epa3"});
    $("#SicutContenedor4").load(url+"/GraficoSigutIgnis4", {dato: "Epa4"});
    $("#SicutContenedor5").load(url+"/GraficoSigutIgnis5", {dato: "Epa5"});
}
                    