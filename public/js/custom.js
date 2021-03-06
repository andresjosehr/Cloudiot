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

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./custom/home.js */ "./resources/js/custom/home.js");

__webpack_require__(/*! ./custom/RegistrarUsuarios.js */ "./resources/js/custom/RegistrarUsuarios.js");

__webpack_require__(/*! ./custom/SicutIgnis.js */ "./resources/js/custom/SicutIgnis.js");

__webpack_require__(/*! ./custom/Vina.js */ "./resources/js/custom/Vina.js");

__webpack_require__(/*! ./custom/ajax.js */ "./resources/js/custom/ajax.js");

/***/ }),

/***/ "./resources/js/custom/RegistrarUsuarios.js":
/*!**************************************************!*\
  !*** ./resources/js/custom/RegistrarUsuarios.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.RegistrarUsuario = function (url) {
  var repetido = false;
  $('table tr #email_temp').each(function () {
    if ($(this).text() == $("#email_user").val()) {
      repetido = true;
    }
  });

  if (repetido == false) {
    if ($("#email_user").val() == "") {
      swal("Error", "Deber introducir un correo", "warning");
    } else {
      emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

      if (emailRegex.test($("#email_user").val())) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $("#reg_usuario").load(url, {
          email: $("#email_user").val(),
          instalaciones: $("#instalaciones_asignadas").val()
        });
      } else {
        swal("Error", "Debes introducir un correo electronico valido", "waning");
      }
    }
  } else {
    swal("Error", "Este email ya se encuentra registrado en el sistema", "warning");
  }
};

window.EliminarUserTemp = function (email, key, url) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $("#reg_usuario").load(url, {
    email: email,
    key: key
  });
};

/***/ }),

/***/ "./resources/js/custom/SicutIgnis.js":
/*!*******************************************!*\
  !*** ./resources/js/custom/SicutIgnis.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.SicutScriptDefault = function () {
  $(".display-modal").click();
  $(".loader-insta").css("display", "none");
  $('#datetimesubmodal').bootstrapMaterialDatePicker({
    format: 'DD-MM-YYYY',
    lang: 'es',
    weekStart: 1,
    cancelText: 'ANNULER',
    nowButton: true,
    switchOnClick: true,
    time: false
  });
  $('#datetimesubmodal2').bootstrapMaterialDatePicker({
    format: 'DD-MM-YYYY',
    lang: 'es',
    weekStart: 1,
    cancelText: 'ANNULER',
    nowButton: true,
    switchOnClick: true,
    time: false
  });
};

window.GraficosIgnisArriba = function (id, mt_value1, mt_time1, mt_value2, mt_time2, min_dato, max_dato, label1, label2, loading, Colores) {
  var ctx = document.getElementById(id).getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: mt_time1,
      datasets: [{
        label: label1,
        data: mt_value1,
        backgroundColor: Colores[0],
        borderColor: Colores[1],
        fill: false,
        borderWidth: 1,
        radius: 0
      }, {
        label: label2,
        data: mt_value2,
        backgroundColor: Colores[2],
        borderColor: Colores[3],
        fill: false,
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

window.GraficosPotenciaINY = function (id, mt_value1, mt_time1, mt_value2, mt_time2, min_dato, max_dato, label1, label2, loading) {
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
        fill: false,
        radius: 0 // ,{   
        //     label: label2,
        //     data: mt_value2,
        //     backgroundColor: 'rgba(66, 134, 244, 0.2)',
        //     borderColor: 'rgba(66, 134, 244, 1)',
        //     borderWidth: 1,
        //     radius: 0
        // }

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

window.GraficosIgnisAbajo = function (id, mt_value1, mt_time1, mt_value2, mt_value3, mt_value4, min_dato, max_dato, label1, label2, label3, label4, loading, oculto) {
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
        fill: false,
        radius: 0
      }, {
        label: label2,
        data: mt_value2,
        backgroundColor: 'rgba(66, 134, 244, 0.2)',
        borderColor: 'rgba(66, 134, 244, 1)',
        borderWidth: 1,
        fill: false,
        radius: 0
      }, {
        label: label3,
        data: mt_value3,
        backgroundColor: 'rgba(242, 255, 0, 0.2)',
        borderColor: 'rgba(242, 255, 0, 1)',
        borderWidth: 1,
        fill: false,
        radius: 0,
        hidden: oculto
      }, {
        label: label4,
        data: mt_value4,
        backgroundColor: 'rgba(8, 255, 0, 0.2)',
        borderColor: 'rgba(8, 255, 0, 1)',
        borderWidth: 1,
        fill: false,
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
        backgroundColor: 'rgba(66, 134, 244, 0.2)',
        borderColor: 'rgba(66, 134, 244, 1)',
        borderWidth: 1,
        fill: false,
        radius: 0
      }, {
        label: label2,
        data: mt_value2,
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 1,
        fill: false,
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
        display: true
      },
      title: {
        display: true,
        text: 'Potencia Generada'
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
};

window.PotGenerada = function (mt_time, mt_value1, mt_value2, Colores) {
  var ctx = document.getElementById("sicut-myChart3").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: mt_time,
      datasets: [{
        label: 'Inyectada',
        data: mt_value1,
        backgroundColor: Colores[0],
        borderColor: Colores[1],
        borderWidth: 1,
        radius: 0,
        fill: false
      }, {
        label: 'Retirada',
        data: mt_value2,
        backgroundColor: Colores[2],
        borderColor: Colores[3],
        borderWidth: 1,
        fill: false,
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
      title: {
        display: false
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
};

window.GraficarDefaultIgnis = function (url, param) {
  $(".loader-insta").css("display", "block");
  $("#SicutSubModalContenedor").load(url + "/GraficoSigutIgnis" + param, {
    HorasTotales: "48",
    Modal: true
  });
};

window.GraficarTodo = function (url) {
  $("#SicutContenedor5").load(url + "/GraficoSigutIgnis5", {
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
};

window.GraficarGra5 = function (mt_time_, EnergiaActivaInyectada_, EnergiaActivaRetirada_, EnergiaReactivaInyectada_, EnergiaReactivaRetirada_) {
  $("#SicutContenedor5").load("/GraficoSigutIgnis5", {
    mt_time: mt_time_,
    EnergiaActivaInyectada: EnergiaActivaInyectada_,
    EnergiaActivaRetirada: EnergiaActivaRetirada_,
    EnergiaReactivaInyectada: EnergiaReactivaInyectada_,
    EnergiaReactivaRetirada: EnergiaReactivaRetirada_
  });
};

/***/ }),

/***/ "./resources/js/custom/Vina.js":
/*!*************************************!*\
  !*** ./resources/js/custom/Vina.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

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

window.VinaScriptDefault = function (url_) {
  $("#contenedorLFE").load(url_, {
    instalacion: "epa"
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
  $('#fecha_orp_inicio').bootstrapMaterialDatePicker({
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
  $('#fecha_conductividad_inicio').bootstrapMaterialDatePicker({
    format: 'YYYY-MM-DD',
    lang: 'fr',
    weekStart: 1,
    cancelText: 'ANNULER',
    nowButton: true,
    switchOnClick: true,
    time: false
  });
  $('#fecha_conductividad_fin').bootstrapMaterialDatePicker({
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

window.MostrarEntrada1 = function (url_, info) {
  $("#MostrarRelojes").load(url_, {
    instalacion: info
  });
};

window.MostrarEntrada2 = function (url_, info) {
  $("#MostrarRelojes").load(url_, {
    instalacion: info
  });
};

window.MostrarEntrada3 = function (url_, info) {
  $("#MostrarRelojes").load(url_, {
    instalacion: info
  });
};

window.MostrarSalida1 = function (url_, info) {
  $("#MostrarRelojes").load(url_, {
    instalacion: info
  });
};

window.MostrarSalida2 = function (url_, info) {
  $("#MostrarRelojes").load(url_, {
    instalacion: info
  });
};

window.MostrarSalida3 = function (url_, info) {
  $("#MostrarRelojes").load(url_, {
    instalacion: info
  });
};

window.MostrarRelojes = function (url_, info) {
  $("#MostrarRelojes").load(url_, {
    instalacion: info
  });
};

window.MostrarBombas = function (url_) {
  $("#MostrarBombas").load(url_, {
    dato: "ejemplo"
  });
};

window.ConsultarParametros = function (url_) {
  $("#parametros-index").load(url_, {
    dato: "ejemplo"
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

window.GraficarFlujos = function (url_) {
  var url = url_;
  $("#contenedorFlujos").load(url, {
    FechaInicio: "Prueba"
  });
};

window.GraficarORPPersonalizado = function (url_) {
  var fecha_orp_inicio = document.getElementById("fecha_orp_inicio").value;
  var fecha_orp_fin = document.getElementById("fecha_orp_fin").value;
  $(".loader-insta").css("display", "block");
  var url = url_;
  $("#ORPDiarioContenedor").load(url, {
    FechaInicio: fecha_orp_inicio,
    FechaFin: fecha_orp_fin
  });
};

window.GraficarConductividadPersonalizado = function (url_) {
  var fecha_conductividad_inicio = document.getElementById("fecha_conductividad_inicio").value;
  var fecha_conductividad_fin = document.getElementById("fecha_conductividad_fin").value;
  $(".loader-insta").css("display", "block");
  var url = url_;
  $("#ConductividadDiarioContenedor").load(url, {
    FechaInicio: fecha_conductividad_inicio,
    FechaFin: fecha_conductividad_fin
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

window.GraficarORPDiario = function (url_) {
  if (document.getElementById("orp-bar-chart").height == 70) {
    var url = url_;
    $("#ORPDiarioContenedor").load(url, {
      dato: "Epa"
    });
  }
};

window.GraficarConductividadDiario = function (url_) {
  if (document.getElementById("conductividad-bar-chart").height == 70) {
    var url = url_;
    $("#ConductividadDiarioContenedor").load(url, {
      dato: "Epa"
    });
  }
};

window.ListarBombas = function (url_) {
  $(".loader-insta").css("display", "block");
  var url = url_;
  $("#contenedorLFE").load(url, {
    dato: "Epa"
  });
};

window.GraficarFlujo = function (mt_time, mt_value, id, titulo, intra) {
  $("#flujo-bar-chart-div" + intra).empty();
  $("#flujo-bar-chart-div" + intra).html('<canvas id="flujo-bar-chart' + intra + '" width="400" height="40"></canvas>');
  var ctx = document.getElementById("flujo-bar-chart" + intra).getContext('2d');
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
    options: _defineProperty({
      title: {
        display: true,
        text: titulo
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: false,
            min: 160,
            max: 0,
            steps: 20
          }
        }]
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
      }
    }, "scales", {
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
    })
  });
};

window.GraficarPHDiarioJS = function (mt_time, mt_value, mt_value_salida) {
  var ctx = document.getElementById("ph-bar-chart").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: mt_time,
      datasets: [{
        label: 'PH Entrada',
        data: mt_value,
        backgroundColor: 'rgba(255, 99, 132, 0.8)',
        borderColor: 'rgba(255,99,132,1)',
        borderWidth: 1
      }, {
        label: 'PH Salida',
        data: mt_value_salida,
        backgroundColor: 'rgba(66, 134, 244, 0.8)',
        borderColor: 'rgba(66, 134, 244,1)',
        borderWidth: 1
      }]
    },
    options: {
      legend: {
        display: true
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

window.GraficarORPDiarioJS = function (mt_time, mt_value, mt_value_salida) {
  var ctx = document.getElementById("orp-bar-chart").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: mt_time,
      datasets: [{
        label: 'ORP Entrada',
        data: mt_value,
        backgroundColor: 'rgba(255, 99, 132, 0.8)',
        borderColor: 'rgba(255,99,132,1)',
        borderWidth: 1
      }, {
        label: 'ORP Salida',
        data: mt_value_salida,
        backgroundColor: 'rgba(66, 134, 244, 0.8)',
        borderColor: 'rgba(66, 134, 244,1)',
        borderWidth: 1
      }]
    },
    options: {
      legend: {
        display: true
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
  $(".vina-loadingORP").css("display", "none");
  $(".BotonExportarORPDiarios").css("display", "block");
};

window.GraficarConductividadDiarioJS = function (mt_time, mt_value, mt_value_salida, MaximoEntrada, MinimoEntrada, MaximoSalida, MinimoSalida) {
  var _ref;

  var ctx = document.getElementById("conductividad-bar-chart").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: mt_time,
      datasets: [{
        label: 'Conductividad Entrada',
        data: mt_value,
        stack: 'Entrada',
        backgroundColor: 'rgba(255, 99, 132, 0.3)',
        borderColor: 'rgba(255,99,132,5)',
        borderWidth: 1
      }, {
        label: "Plan",
        fill: false,
        data: MaximoEntrada,
        stack: 'Entrada',
        backgroundColor: 'rgba(0, 0, 0, 0)',
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 1
      }, {
        label: 'Conductividad Salida',
        data: mt_value_salida,
        stack: 'Salida',
        backgroundColor: 'rgba(66, 134, 244, 0.3)',
        borderColor: 'rgba(66, 134, 244,5)',
        borderWidth: 1
      }, (_ref = {
        label: "Plan",
        data: MaximoSalida,
        stack: 'Salida',
        fill: false,
        borderColor: "rgba(0,0,0,1)",
        backgroundColor: 'rgba(0, 0, 0, 0)'
      }, _defineProperty(_ref, "borderColor", 'rgba(66, 134, 244, 1)'), _defineProperty(_ref, "borderWidth", 1), _ref)]
    },
    options: {
      legend: {
        display: true,
        position: 'bottom'
      },
      scales: {
        yAxes: [{}],
        xAxes: [{
          padding: 50,
          lineHeight: 3,
          ticks: {
            padding: 50,
            lineHeight: 3
          }
        }]
      },
      elements: {
        rectangle: {}
      }
    }
  });
  $(".vina-loadingConductividad").css("display", "none");
  $(".BotonExportarConductividadDiarios").css("display", "block");
};

window.CompilarRango = function (alto, bajo, tiemporiego, tiemporeposo) {
  var slider = document.getElementById('slider');
  noUiSlider.create(slider, {
    start: [bajo, alto],
    step: 1,
    decimals: 0,
    connect: true,
    range: {
      'min': 0,
      'max': 1400
    },
    format: wNumb({
      decimals: 0
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
      max: 3599
    },
    format: wNumb({
      decimals: 0,
      thousand: '.'
    })
  });
  riego.noUiSlider.on('update', function (values, handle) {
    window.riego = values[handle];
    document.getElementById('RiegoValor').innerHTML = myTime(values[handle].toString().replace('.', ''));
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
      max: 3599
    },
    format: wNumb({
      decimals: 0,
      thousand: '.'
    })
  });
  reposo.noUiSlider.on('update', function (values, handle) {
    window.reposo = values[handle];
    document.getElementById('ReposoValor').innerHTML = myTime(values[handle].toString().replace('.', ''));
  });
  $(".noUi-handle").addClass("vina-noUi-handle");
  $(".noUi-connect").addClass("vina-noUi-connect");
};

window.myTime = function (time) {
  var hr = ~~(time / 3600);
  var min = ~~(time % 3600 / 60);
  var sec = time % 60;
  var sec_min = "";

  if (hr > 0) {
    sec_min += "" + hrs + ":" + (min < 10 ? "0" : "");
  }

  sec_min += "" + min + ":" + (sec < 10 ? "0" : "");
  sec_min += "" + sec;
  return sec_min;
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
  var MinutosRiego = window.riego;
  var url = url_;
  $("#parametros-ejecucion").load(url, {
    Riego: MinutosRiego
  });
};

window.RegistarReposo = function (url_) {
  $(".boton2").css("display", "none");
  $(".vina-vina-loadingg2").css("display", "block");
  var MinutosReposo = window.reposo;
  var url = url_;
  $("#parametros-ejecucion").load(url, {
    Reposo: MinutosReposo
  });
};

/***/ }),

/***/ "./resources/js/custom/ajax.js":
/*!*************************************!*\
  !*** ./resources/js/custom/ajax.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.AjaxRequest = function (metodo, ruta, datos) {
  $(".loader-insta").show();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: metodo,
    url: ruta,
    data: datos,
    success: function success(result) {
      $(".loader-insta").hide();
      eval(result);
    },
    error: function error(e) {
      $(".loader-insta").hide();
      console.log("Error en la peticion");
      console.log(e);
    }
  });
};

window.AjaxFileRequest = function (metodo, ruta, idArchivo) {
  $(".loader").show();
  var file_data = $('#' + idArchivo).prop('files')[0];
  var form_data = new FormData();
  form_data.append('_method', metodo);
  form_data.append('file', file_data);
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    url: ruta,
    // point to server-side PHP script 
    dataType: 'text',
    // what to expect back from the PHP script, if anything
    cache: false,
    contentType: false,
    processData: false,
    data: form_data,
    type: "POST",
    success: function success(result) {
      $(".loader").hide();
      eval(result);
    },
    error: function error(e) {
      $(".loader").hide();
      console.log("Error en la peticion");
      console.log(e);
    }
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

window.RenderizarMapa = function (latitud, longitud, id, controlador, urlroot, tabla_instalacion_asociada_, rol_, lat_ini, lon_ini, zoom_) {
  function Marcador(lon, lat, id, controlador, rol_, imageDefault) {
    var vectorSource = new ol.source.Vector({//create empty vector
    }); //create a bunch of icons and add to source vector

    var iconFeature = new ol.Feature({
      geometry: new ol.geom.Point([lon, lat]),
      name: id,
      customID: id,
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
        opacity: 1,
        label: "Airport",
        src: imageDefault,
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
    Instalaciones[i] = Marcador(longitud[i], latitud[i], id[i], controlador[i], rol_[i], 'images/marc_negro.png');
  }

  var vista = new ol.View({
    center: [lon_ini, lat_ini],
    zoom: zoom_,
    projection: 'EPSG:4326'
  });
  var map = new ol.Map({
    layers: [new ol.layer.Tile({
      source: new ol.source.XYZ({
        attributions: ['Powered by Esri', 'Source: Esri, DigitalGlobe, GeoEye, Earthstar Geographics, CNES/Airbus DS, USDA, USGS, AeroGRID, IGN, and the GIS User Community'],
        attributionsCollapsible: false,
        url: 'https://services.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
        maxZoom: 23
      })
    })],
    target: document.getElementById('map'),
    view: vista
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
  });
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

  function FinningQuery() {
    $.ajax({
      type: 'POST',
      url: urlroot_ + "/FinningEstadoBombasMarcador",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function success(result) {
        map.getLayers().forEach(function (feature, layerin) {
          // map.removeLayer(map.getLayers());
          if (layerin == 0) {
            // map.removeLayer(feature);
            if (result.PlantaAgua == 0) {
              map.addLayer(Marcador(-70.388521, -23.597659, 9, "FinningController", 1, 'images/marc_verde.png'));
            }

            if (result.PlantaAgua == 1) {
              map.addLayer(Marcador(-70.388521, -23.597659, 9, "FinningController", 1, 'images/marc_amarillo.png'));
            }

            if (result.PlantaAgua == 2) {
              map.addLayer(Marcador(-70.388521, -23.597659, 9, "FinningController", 1, 'images/marc_rojo.png'));
            }

            if (result.Dinamometro[0].mt_value == 0) {
              map.addLayer(Marcador(-70.387544, -23.598190, 10, "FinningController", 1, 'images/marc_verde.png'));
            } else {
              map.addLayer(Marcador(-70.387544, -23.598190, 10, "FinningController", 1, 'images/marc_rojo.png'));
            }
          }
        });
      }
    });
  }

  FinningQuery();
  setInterval(function () {
    FinningQuery();
  }, 60000);
  var tabla_instalacion_asociada = tabla_instalacion_asociada_;
  return vista;
};

window.flyTo = function (vistamo, location, done) {
  var duration = 2000;
  var zoom = 10;
  var parts = 2;
  var called = false;

  function callback(complete) {
    --parts;

    if (called) {
      return;
    }

    if (parts === 0 || !complete) {
      called = true;
      done(complete);
    }
  }

  vistamo.animate({
    center: location,
    projection: 'EPSG:4326',
    duration: duration
  }, callback);
  vistamo.animate({
    zoom: zoom - 1,
    duration: duration / 2
  }, {
    zoom: zoom,
    duration: duration / 2
  }, callback);
};

$(document).ready(function () {
  $(".content").addClass("mapa-content");
  $("canvas").addClass("mapa-canvas");
});

window.AsignarIDHome = function () {
  $("body").addClass("HomePage");
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
/*!*****************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/general.scss ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\xampp\htdocs\Temporal\Interline\Cloudiot\resources\js\app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! C:\xampp\htdocs\Temporal\Interline\Cloudiot\resources\sass\general.scss */"./resources/sass/general.scss");


/***/ })

/******/ });