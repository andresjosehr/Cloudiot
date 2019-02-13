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

window.GraficosIgnisArriba = function (id, mt_value1, mt_time1, mt_value2, mt_time2, label1, label2, loading) {
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
  $("#sicut-loading" + loading).css("display", "none");
};

window.GraficosIgnisAbajo = function (id, mt_value1, mt_time1, mt_value2, mt_value3, mt_value4, label1, label2, label3, label4, loading) {
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
        radius: 0
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
  $("#sicut-loading" + loading).css("display", "none");
};

window.GraficarTodo = function (url) {
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

window.RenderizarMapa = function (latitud, longitud, id, controlador, urlroot, tabla_instalacion_asociada_) {
  (function () {
    function Marcador(lon, lat, id, controlador) {
      var vectorSource = new ol.source.Vector({//create empty vector
      }); //create a bunch of icons and add to source vector

      var iconFeature = new ol.Feature({
        geometry: new ol.geom.Point([lon, lat]),
        name: id,
        controlador: controlador,
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
      Instalaciones[i] = Marcador(longitud[i], latitud[i], id[i], controlador[i]);
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
        var url = urlroot + controlador;
        var datos = $('#consulta-form').serialize();
        $("#contenedor").load(url, {
          id: id,
          tabla_asociada: tabla_instalacion_asociada
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
/*!*************************************************************************************************************!*\
  !*** multi ./resources/js/custom/home.js ./resources/js/custom/SicutIgnis.js ./resources/sass/general.scss ***!
  \*************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\xampp\htdocs\Interline\Cloudiot\resources\js\custom\home.js */"./resources/js/custom/home.js");
__webpack_require__(/*! C:\xampp\htdocs\Interline\Cloudiot\resources\js\custom\SicutIgnis.js */"./resources/js/custom/SicutIgnis.js");
module.exports = __webpack_require__(/*! C:\xampp\htdocs\Interline\Cloudiot\resources\sass\general.scss */"./resources/sass/general.scss");


/***/ })

/******/ });