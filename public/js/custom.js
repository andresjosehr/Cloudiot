/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/custom/SicutIgnis.js":
/*!*******************************************!*\
  !*** ./resources/js/custom/SicutIgnis.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.SicutScriptDefault = function () {
  $(".display-modal").click();
  $(".loader-insta").css("display", "none");
};

window.GraficosIgnisArriba = function (id, mt_value1, mt_time1, mt_value2, mt_time2, min_dato, max_dato, label1, label2, loading) {
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
      }, {
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
  $("#sicut-loading" + loading).css("display", "none");
};

window.GraficosIgnisAbajo = function (id, mt_value1, mt_time1, mt_value2, mt_value3, mt_value4, min_dato, max_dato, label1, label2, label3, label4, loading, oculto) {
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
      }, {
        label: label2,
        data: mt_value2,
        backgroundColor: 'rgba(66, 134, 244, 0.2)',
        borderColor: 'rgba(66, 134, 244, 1)',
        borderWidth: 1,
        radius: 0
      }, {
        label: label3,
        data: mt_value3,
        backgroundColor: 'rgba(242, 255, 0, 0.2)',
        borderColor: 'rgba(242, 255, 0, 1)',
        borderWidth: 1,
        radius: 0,
        hidden: oculto
      }, {
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
  $("#sicut-loading" + loading).css("display", "none");
};

window.GraficoIgnisArribaDerecha = function (id, mt_value1, mt_time1, mt_value2, mt_time2, min_dato_a, max_dato_a, min_dato_b, max_dato_b, label1, label2, loading) {
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
      }, {
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
        xAxes: [{
          ticks: {
            display: false,
            maxTicksLimit: 10
          }
        }]
      }
    }
  });
  $("#sicut-loading" + loading).css("display", "none");
};

window.SicutPieChart = function () {
  var ctx = document.getElementById("sicut-pie-chart").getContext('2d');
  var pieChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ["Dato 1", "Dato 2", "Dato 3"],
      datasets: [{
        data: [133.3, 86.2, 52.2],
        backgroundColor: ["#FF6384", "#63FF84", "#84FF63"]
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
};

window.PotGenerada = function () {
  var ctx = document.getElementById("sicut-myChart3").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'],
        borderColor: ['rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'],
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
            beginAtZero: true
          }
        }]
      }
    }
  });
};

window.GraficarTodo = function (url) {
  $("#SicutContenedor6").load(url + "/GraficoSigutIgnis6", {
    dato: "Epa5"
  });
  $("#SicutContenedor7").load(url + "/GraficoSigutIgnis7", {
    dato: "Epa5"
  });
  $("#SicutContenedor1").load(url + "/GraficoSigutIgnis1", {
    dato: "Epa"
  });
  $("#SicutContenedor2").load(url + "/GraficoSigutIgnis2", {
    dato: "Epa2"
  });
  $("#SicutContenedor3").load(url + "/GraficoSigutIgnis3", {
    dato: "Epa3"
  });
  $("#SicutContenedor4").load(url + "/GraficoSigutIgnis4", {
    dato: "Epa4"
  });
  $("#SicutContenedor5").load(url + "/GraficoSigutIgnis5", {
    dato: "Epa5"
  });
};

/***/ }),

/***/ "./resources/js/custom/Vina.js":
/*!*************************************!*\
  !*** ./resources/js/custom/Vina.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.VinaRPM = function (tipo, valor, id, gaugecanvas, rango, dato, valor_real) {
  if (dato == "Normal") {
    var colores = [{
      "from": 0,
      "to": 100,
      "color": "#fff"
    }];
  } else {
    var colores = [{
      "from": 0,
      "to": 35.71,
      "color": "rgba(200, 50, 50, .75)"
    }, {
      "from": 35.71,
      "to": 57.14,
      "color": "rgba(100, 255, 100, .2)"
    }, {
      "from": 57.14,
      "to": 100,
      "color": "rgba(200, 50, 50, .75)"
    }];
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
  $("#" + gaugecanvas + " canvas").css("display", "block");
  $("#" + gaugecanvas + " img").css("display", "none");
  $("#" + gaugecanvas + " .vina-loading").css("display", "none");
};

window.VinaGraficos = function (divcanvas, chartcanvas, mt_value, mt_time) {
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
            beginAtZero: true
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
  $("#" + divcanvas + " .vina-loading").css("display", "none");
  $("#" + divcanvas + " img").css("display", "none");
  $("#" + chartcanvas).css("display", "block");
};

window.VinaBombas = function (Operativa, ErrorBomba) {
  for (var i = 0; i <= 4; i++) {
    $(".bomba" + i + "-op").removeClass("bg-green");
    $(".bomba" + i + "-op").removeClass("bg-red");
    $(".vina-btn-bomba-error" + i).removeClass("bg-red");
    $(".btncasc" + i).removeClass("bg-green");
    $(".btncasc" + i).removeClass("bg-red");
    $(".bomba" + i + "-op").empty();
    $(".bomba" + i + "-op-btn").empty();
    $(".texto-error" + i).empty();

    if (Operativa[i] == "Operativa") {
      $(".bomba" + i + "-op").addClass("bg-green");
      $(".bomba" + i + "-op").text("Op.");
      $(".bomba" + i + "-op-btn").text("error_outline");
      $(".btncasc" + i).addClass("bg-red");
    } else {
      $(".bomba" + i + "-op").addClass("bg-red");
      $(".bomba" + i + "-op").text("No Op.");
      $(".bomba" + i + "-op-btn").text("check");
      $(".btncasc" + i).addClass("bg-green");
    }

    if (ErrorBomba[i] == "Error") {
      $(".vina-btn-bomba-error" + i).addClass("bg-red");
      $(".texto-error" + i).text("Error");
    } else {
      $(".vina-btn-bomba-error" + i).addClass("bg-green");
      $(".texto-error" + i).text("Sin Error");
    }
  }

  $(".bombas-cargando").removeClass("vina-cargando");
  $(".vina-loading-bomba").css("display", "none");
};

window.VinaScriptDefault = function (url_, instalacion_info) {
  $("#contenedorLFE").load(url_, {
    instalacion: instalacion_info
  });
  $(".vina-modal").click();
  $(".loader-insta").css("display", "none");
  $('#fecha_flujo_inicio').bootstrapMaterialDatePicker({
    format: 'YYYY-MM-DD',
    lang: 'fr',
    weekStart: 1,
    cancelText: 'ANNULER',
    nowButton: true,
    switchOnClick: true,
    time: false
  });
  $('#fecha_flujo_fin').bootstrapMaterialDatePicker({
    format: 'YYYY-MM-DD',
    lang: 'fr',
    weekStart: 1,
    cancelText: 'ANNULER',
    nowButton: true,
    switchOnClick: true,
    time: false
  });
  $('#fecha_ph_inicio').bootstrapMaterialDatePicker({
    format: 'YYYY-MM-DD',
    lang: 'fr',
    weekStart: 1,
    cancelText: 'ANNULER',
    nowButton: true,
    switchOnClick: true,
    time: false
  });
  $('#fecha_ph_fin').bootstrapMaterialDatePicker({
    format: 'YYYY-MM-DD',
    lang: 'fr',
    weekStart: 1,
    cancelText: 'ANNULER',
    nowButton: true,
    switchOnClick: true,
    time: false
  });
  $('#datetime').bootstrapMaterialDatePicker({
    format: 'DD/MM/YYYY HH:mm',
    lang: 'fr',
    weekStart: 1,
    cancelText: 'ANNULER',
    nowButton: true,
    switchOnClick: true
  });
};

window.GraficarphPersonalizado = function (url_) {
  var fecha_ph_inicio = document.getElementById("fecha_ph_inicio").value;
  var fecha_ph_fin = document.getElementById("fecha_ph_fin").value;
  $(".loader-insta").css("display", "block");
  var url = url_;
  $("#PHDiarioContenedor").load(url, {
    FechaInicio: fecha_ph_inicio,
    FechaFin: fecha_ph_fin
  });
};

window.GraficarFlujoPersonalizado = function (url_) {
  $(".loader-insta").css("display", "block");
  var FechaInicio = document.getElementById('fecha_flujo_inicio').value;
  var FechaFin = document.getElementById('fecha_flujo_fin').value;
  var url = url_;
  $("#contenedorFlujos").load(url, {
    FechaInicio: FechaInicio,
    FechaFin: FechaFin
  });
};

window.GraficarPHDiario = function (url_) {
  if (document.getElementById("ph-bar-chart").height == 70) {
    var url = url_;
    $("#PHDiarioContenedor").load(url, {
      dato: "Epa"
    });
  }
};

window.ListarBombas = function () {
  $(".loader-insta").css("display", "block");
  var url = "<?php echo Request::root() ?>/CalculosLuisFelipe5";
  $("#contenedorLFE").load(url, {
    dato: "Epa"
  });
};

window.GraficarFlujo = function (mt_time, mt_value) {
  var ctx = document.getElementById("flujo-bar-chart").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: mt_time,
      datasets: [{
        data: mt_value,
        backgroundColor: 'rgba(255, 99, 132, 0.8)',
        borderColor: 'rgba(255,99,132,1)',
        borderWidth: 1
      }]
    },
    options: {
      legend: {
        display: false
      },
      "animation": {
        "duration": 1,
        "onComplete": function onComplete() {
          var chartInstance = this.chart,
              ctx = chartInstance.ctx;
          ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
          ctx.textAlign = 'center';
          ctx.textBaseline = 'bottom';
          this.data.datasets.forEach(function (dataset, i) {
            var meta = chartInstance.controller.getDatasetMeta(i);
            meta.data.forEach(function (bar, index) {
              var data = dataset.data[index];
              ctx.fillText(data, bar._model.x, bar._model.y - 5);
            });
          });
        }
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            padding: 100
          }
        }],
        xAxes: [{
          padding: 50,
          lineHeight: 3,
          ticks: {
            padding: 50,
            lineHeight: 3
          }
        }]
      }
    }
  });
};

window.GraficarPHDiarioJS = function (mt_time, mt_value) {
  var ctx = document.getElementById("ph-bar-chart").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: mt_time,
      datasets: [{
        data: mt_value,
        backgroundColor: 'rgba(255, 99, 132, 0.8)',
        borderColor: 'rgba(255,99,132,1)',
        borderWidth: 1
      }]
    },
    options: {
      legend: {
        display: false
      },
      "animation": {
        "duration": 1,
        "onComplete": function onComplete() {
          var chartInstance = this.chart,
              ctx = chartInstance.ctx;
          ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
          ctx.textAlign = 'center';
          ctx.textBaseline = 'bottom';
          this.data.datasets.forEach(function (dataset, i) {
            var meta = chartInstance.controller.getDatasetMeta(i);
            meta.data.forEach(function (bar, index) {
              var data = dataset.data[index];
              ctx.fillText(data, bar._model.x, bar._model.y - 5);
            });
          });
        }
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            padding: 100
          }
        }],
        xAxes: [{
          padding: 50,
          lineHeight: 3,
          ticks: {
            padding: 50,
            lineHeight: 3
          }
        }]
      }
    }
  });
  var mt_time_ph = mt_time;
  var mt_value_ph = mt_value;
  $(".vina-vina-loadingPH").css("display", "none");
  $(".BotonExportarPHDiarios").css("display", "block");
};

window.CompilarRango = function (alto, bajo, tiemporiego, tiemporeposo) {
  var slider = document.getElementById('slider');
  noUiSlider.create(slider, {
    start: [bajo, alto],
    step: 0.1,
    connect: true,
    range: {
      'min': 0,
      'max': 14
    },
    format: wNumb({
      decimals: 1
    })
  });
  var nodes = [document.getElementById("BajoPH"), // 0
  document.getElementById('AltoPH') // 1
  ]; // Display the slider value and how far the handle moved
  // from the left edge of the slider.

  slider.noUiSlider.on('update', function (values, handle, unencoded, isTap, positions) {
    nodes[handle].innerHTML = values[handle];
  });
  var riego = document.getElementById('Riego');
  noUiSlider.create(riego, {
    start: tiemporiego,
    // Disable animation on value-setting,
    // so the sliders respond immediately.
    animate: false,
    step: 1,
    decimals: 0,
    range: {
      min: 0,
      max: 100
    },
    format: wNumb({
      decimals: 0,
      thousand: '.'
    })
  });
  riego.noUiSlider.on('update', function (values, handle) {
    document.getElementById('RiegoValor').innerHTML = values[handle];
  });
  var reposo = document.getElementById('Reposo');
  noUiSlider.create(reposo, {
    start: tiemporeposo,
    // Disable animation on value-setting,
    // so the sliders respond immediately.
    animate: false,
    step: 1,
    decimals: 0,
    range: {
      min: 0,
      max: 100
    },
    format: wNumb({
      decimals: 0,
      thousand: '.'
    })
  });
  reposo.noUiSlider.on('update', function (values, handle) {
    document.getElementById('ReposoValor').innerHTML = values[handle];
  });
  $(".noUi-handle").addClass("vina-noUi-handle");
  $(".noUi-connect").addClass("vina-noUi-connect");
};

window.RegistarRangoPH = function (url_) {
  $(".boton3").css("display", "none");
  $(".vina-vina-loadingg3").css("display", "block");
  var RangoPH_Inicio = $("#BajoPH").text();
  var RangoPH_Fin = $("#AltoPH").text();
  var url = url_;
  $("#parametros-ejecucion").load(url, {
    RangoPH_Ini: RangoPH_Inicio,
    RangoPH_Fini: RangoPH_Fin
  });
};

window.RegistarRiego = function (url_) {
  $(".boton1").css("display", "none");
  $(".vina-vina-loadingg1").css("display", "block");
  var MinutosRiego = $("#RiegoValor").text();
  var url = url_;
  $("#parametros-ejecucion").load(url, {
    Riego: MinutosRiego
  });
};

window.RegistarReposo = function (url_) {
  $(".boton2").css("display", "none");
  $(".vina-vina-loadingg2").css("display", "block");
  var MinutosReposo = $("#ReposoValor").text();
  var url = url_;
  $("#parametros-ejecucion").load(url, {
    Reposo: MinutosReposo
  });
};

/***/ }),

/***/ "./resources/js/custom/home.js":
/*!*************************************!*\
  !*** ./resources/js/custom/home.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

window.RenderizarMapa = function (latitud, longitud, id, controlador, urlroot, tabla_instalacion_asociada_, rol_) {
  (function () {
    function Marcador(lon, lat, id, controlador, rol_) {
      var vectorSource = new ol.source.Vector({//create empty vector
      }); //create a bunch of icons and add to source vector

      var iconFeature = new ol.Feature({
        geometry: new ol.geom.Point([lon, lat]),
        name: id,
        controlador: controlador,
        rol: rol_,
        population: 4000,
        rainfall: 500
      });
      vectorSource.addFeature(iconFeature); //create the style

      var iconStyle = new ol.style.Style({
        image: new ol.style.Icon(
        /** @type {olx.style.IconOptions} */
        {
          anchor: [0.5, 46],
          anchorXUnits: 'fraction',
          anchorYUnits: 'pixels',
          cursor: "pointer",
          opacity: 0.75,
          src: 'images/marcador.png',
          id: "1"
        })
      }); //add the feature vector to the layer vector, and apply a style to whole layer

      var vectorLayer = new ol.layer.Vector({
        source: vectorSource,
        style: iconStyle
      });
      return vectorLayer;
    }

    var Instalaciones = [];

    for (var i = 0; i < longitud.length; i++) {
      Instalaciones[i] = Marcador(longitud[i], latitud[i], id[i], controlador[i], rol_[i]);
    }

    var map = new ol.Map({
      layers: [new ol.layer.Tile({
        source: new ol.source.OSM()
      })],
      target: document.getElementById('map'),
      view: new ol.View({
        center: [-71.148302, -34.078780],
        zoom: 8,
        projection: 'EPSG:4326'
      })
    });

    for (var i = 0; i < Instalaciones.length; i++) {
      map.addLayer(Instalaciones[i]);
    }

    map.on("pointermove", function (evt) {
      var hit = map.forEachFeatureAtPixel(evt.pixel, function (feature, layer) {
        return true;
      });

      if (hit) {
        map.getTarget().style.cursor = 'pointer';
      } else {
        map.getTarget().style.cursor = '';
      }
    }); // var lonlat = new OpenLayers.LonLat(-71.148302, -33.578780);
    // map.panTo(lonlat);

    map.on("click", function (e) {
      map.forEachFeatureAtPixel(e.pixel, function (feature, layer) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $(".loader-insta").css("display", "block");
        var id = feature.values_.name;
        var controlador = feature.values_.controlador;
        var rol = feature.values_.rol;
        var url = urlroot + controlador;
        var datos = $('#consulta-form').serialize();
        $("#contenedor").load(url, {
          id: id,
          tabla_asociada: tabla_instalacion_asociada,
          rol: rol
        });
      });
    });
  })();

  var tabla_instalacion_asociada = tabla_instalacion_asociada_;
};

$(document).ready(function () {
  $(".content").addClass("mapa-content");
  $("canvas").addClass("mapa-canvas");
});

window.AsignarIDHome = function () {
  $("body").addClass("HomePage");
};

window.CentrarMapa = function (longitud, latitud) {
  map.setView(new ol.View({
    center: [-71.148302, -34.078780],
    zoom: 15,
    projection: 'EPSG:4326'
  }));
};

/***/ }),

/***/ "./resources/sass/general.scss":
/*!*************************************!*\
  !*** ./resources/sass/general.scss ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*******************************************************************************************************************************************!*\
  !*** multi ./resources/js/custom/home.js ./resources/js/custom/SicutIgnis.js ./resources/js/custom/Vina.js ./resources/sass/general.scss ***!
  \*******************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\xampp\htdocs\Interline\Cloudiot\resources\js\custom\home.js */"./resources/js/custom/home.js");
__webpack_require__(/*! C:\xampp\htdocs\Interline\Cloudiot\resources\js\custom\SicutIgnis.js */"./resources/js/custom/SicutIgnis.js");
__webpack_require__(/*! C:\xampp\htdocs\Interline\Cloudiot\resources\js\custom\Vina.js */"./resources/js/custom/Vina.js");
module.exports = __webpack_require__(/*! C:\xampp\htdocs\Interline\Cloudiot\resources\sass\general.scss */"./resources/sass/general.scss");


/***/ })

/******/ });