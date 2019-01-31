    function RPM(valor) {
        
          var rango_ph = [];
          rango_ph[0]="0";
          rango_ph[1]="2.8";
          rango_ph[2]="5.6";
          rango_ph[3]="8.4";
          rango_ph[4]="11.2";
          rango_ph[5]="14";
        var gauge = new RadialGauge({
            renderTo: 'gauge',
            width: 200,
            height: 200,
            units: "PH",
            value: valor,
            minValue: 0,
            startAngle: 90,
            ticksAngle: 180,
            valueBox: false,
            maxValue: 100,
            majorTicks: rango_ph,
            minorTicks: 2,
            strokeTicks: true,
            highlights: [
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


}

