$( ".display-modal" ).click();
$(".loader-insta").css("display", "none");

function GraficosIgnisArriba(id) {

                
                    var ctx = document.getElementById(id).getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: [1, 2, 3, 4, 5, 6],
                            datasets: [{
                                label: '',
                                data: [12, 19, 3, 5, 2, 3],
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: '',
                                data: [8, 5, 1, 10, 6, 8],
                                backgroundColor: 'rgba(66, 134, 244, 0.2)',
                                borderColor: 'rgba(66, 134, 244, 1)',
                                borderWidth: 1,
                                radius: 0
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





function GraficosIgnisAbajo(id) {

                
                    var ctx = document.getElementById(id).getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: [1, 2, 3, 4, 5, 6],
                            datasets: [{
                                label: '',
                                data: [12, 19, 3, 5, 2, 3],
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: '',
                                data: [8, 5, 1, 10, 6, 8],
                                backgroundColor: 'rgba(66, 134, 244, 0.2)',
                                borderColor: 'rgba(66, 134, 244, 1)',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: '',
                                data: [1, 7, 15, 9, 1, 4],
                                backgroundColor: 'rgba(242, 255, 0, 0.2)',
                                borderColor: 'rgba(242, 255, 0, 1)',
                                borderWidth: 1,
                                radius: 0
                            },
                            {
                                label: '',
                                data: [3, 1, 8, 5, 10, 15],
                                backgroundColor: 'rgba(8, 255, 0, 0.2)',
                                borderColor: 'rgba(8, 255, 0, 1)',
                                borderWidth: 1,
                                radius: 0
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
                    