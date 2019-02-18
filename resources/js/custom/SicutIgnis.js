
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





window.GraficosIgnisAbajo = function(id, mt_value1, mt_time1, mt_value2, mt_value3, mt_value4, min_dato, max_dato, label1, label2, label3, label4, loading) {

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
                                radius: 0
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

window.GraficarTodo=function(url){

    $("#SicutContenedor1").load(url+"/GraficoSigutIgnis1", {dato: "Epa"});
    $("#SicutContenedor2").load(url+"/GraficoSigutIgnis2", {dato: "Epa2"});
    $("#SicutContenedor3").load(url+"/GraficoSigutIgnis3", {dato: "Epa3"});
    $("#SicutContenedor4").load(url+"/GraficoSigutIgnis4", {dato: "Epa4"});
    $("#SicutContenedor5").load(url+"/GraficoSigutIgnis5", {dato: "Epa5"});
}
                    