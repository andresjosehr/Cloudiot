<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">{{ $Titulo }}</h4>
                        </div>
                        <div class="modal-body">
                            <canvas id="ChartSubModal" height="50"></canvas>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>

            <button style="display: none" type="button" class="btn btn-default waves-effect m-r-20 submodal" data-toggle="modal" data-target="#defaultModal" id="defaultModal">MODAL </button>

            <script>
                function ChartSubModal(mt_time, mt_value) {
                    var ctx = document.getElementById("ChartSubModal").getContext('2d');
                        var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: [],
                            datasets: [{
                                label: '',
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

                ChartSubModal("<?php $mt_time; ?>", "<?php $mt_value; ?>");


                $(".submodal").click();
                $(".loader-insta").css("display", "none");
            </script>