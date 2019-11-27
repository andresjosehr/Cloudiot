window.WelkoGraficarNivel=function(Datos){

	Datos=JSON.parse(Datos);
	console.log(Datos);

	var i=0;
	var mt_value=[];
	var mt_time=[];
	Datos.map(function(key){
		// console.log(Datos[key]);

		mt_value[i]=(key.mt_value*100)/20000;
		mt_time[i]=key.mt_time;

		i++;
	});
	console.log(mt_value);
	console.log(mt_time);


	var ctx = document.getElementById("WelkoNivel").getContext('2d');
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
                        	title: {
					            display: true,
					            text: "Nivel (%)"
					        },
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

                    $("#WelkoNivel-loader").hide();
}