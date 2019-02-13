

function RPM(tipo, valor, id, gaugecanvas, rango, dato, valor_real) {

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


function Graficos(divcanvas, chartcanvas, mt_value, mt_time) {


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

function Bombas(Operativa, ErrorBomba) {

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


                 $( ".vina-modal" ).click();
                 $(".loader-insta").css("display", "none");