for (var i = 0; i <= 5; i++) {

var gauge = new RadialGauge({
    renderTo: 'gauge'+i,
    width: 150,
    height: 150,
    units: "Flujos",
    value: 35,
    minValue: 0,
    startAngle: 90,
    ticksAngle: 180,
    valueBox: false,
    maxValue: 100,
    majorTicks: [
        "0",
        "20",
        "40",
        "60",
        "80",
        "100",
    ],
    minorTicks: 2,
    strokeTicks: true,
    highlights: [
        {
          "from": 0,
          "to": 30,
          "color": "rgba(100, 255, 100, .2)"
        },
        {
          "from": 30,
          "to": 70,
          "color": "rgba(220, 200, 0, .75)"
        },
        {
            "from": 70,
            "to": 100,
            "color": "rgba(200, 50, 50, .75)"
        }
    ],
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


setInterval(function() {
  
  // update the above chart...
  var value = 50;
  gauge.value = value;
  
  // Update the declarative chart...
  document.getElementById("gauge-a"+i).setAttribute("data-value", value);
}, 1800);

}


$( ".display-modal" ).click();

                      for (var i = 0; i <= 6; i++) {
                      var ctx = document.getElementById("myChart"+i).getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: [],
                            datasets: [{
                                label: '',
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
                    $(".loader-insta").css("display", "none");