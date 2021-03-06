

<script>
	var mt_value='<?php echo json_encode($mt_value) ?>';
	var mt_time='<?php echo json_encode($mt_time) ?>';
	mt_value=JSON.parse(mt_value);
	mt_time=JSON.parse(mt_time);

	mt_value = Object.keys(mt_value).map(i => mt_value[i])
	mt_time = Object.keys(mt_time).map(i => mt_time[i])

			var ctx = document.getElementById('myChart').getContext('2d');
			var myChart = new Chart(ctx, {
			    type: 'line',
			    data: {
			        labels: mt_time,
			        datasets: [{
			            label: 'Flujo',
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
			                'rgba(255, 99, 132, 1)',
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
			</script>