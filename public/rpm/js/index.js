var gauge = new RadialGauge({
    renderTo: 'gauge',
    width: 200,
    height: 200,
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
  document.getElementById("gauge-a").setAttribute("data-value", value);
}, 1800);