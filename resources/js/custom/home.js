$.ajaxSetup({
       headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
});



window.RenderizarMapa=function(latitud, longitud, id, controlador, urlroot, tabla_instalacion_asociada_) {

(function(){

  function Marcador(lon, lat, id, controlador) {
    var vectorSource = new ol.source.Vector({
      //create empty vector
    });

      //create a bunch of icons and add to source vector
        
        var iconFeature = new ol.Feature({
          geometry: new  
          ol.geom.Point([lon, lat]),
          name: id,
          controlador: controlador,
          population: 4000,
          rainfall: 500
        });

          vectorSource.addFeature(iconFeature);

    //create the style
    var iconStyle = new ol.style.Style({
      image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
        anchor: [0.5, 46],
        anchorXUnits: 'fraction',
        anchorYUnits: 'pixels',
        cursor: "pointer",
        opacity: 0.75,
        src: 'images/marcador.png',
        id: "1"
      }))
    });

      //add the feature vector to the layer vector, and apply a style to whole layer
      var vectorLayer = new ol.layer.Vector({
        source: vectorSource,
        style: iconStyle
      });

      return vectorLayer

    }

    var Instalaciones = [];
    for (var i = 0 ; i < longitud.length ; i++) {
      Instalaciones[i]=Marcador(longitud[i], latitud[i], id[i], controlador[i]);

    }


    

    var map = new ol.Map({
      layers: [new ol.layer.Tile({ source: new ol.source.OSM() })],
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
        var hit = map.forEachFeatureAtPixel(evt.pixel, function(feature, layer) {
            return true;
        }); 
        if (hit) {
            map.getTarget().style.cursor = 'pointer';
        } else {
            map.getTarget().style.cursor = '';
        }
    });

        map.on("click", function(e) {
            map.forEachFeatureAtPixel(e.pixel, function (feature, layer) {

                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                $(".loader-insta").css("display", "block");
                var id             = feature.values_.name;
                var controlador    = feature.values_.controlador;
                var url            = urlroot+controlador;
                var datos          = $('#consulta-form').serialize();

                $("#contenedor").load(url, {id: id, tabla_asociada: tabla_instalacion_asociada});


            })
        });

  })();

  var tabla_instalacion_asociada = tabla_instalacion_asociada_;

}
$( document ).ready(function() {
  $( ".content" ).addClass( "mapa-content" );
  $( "canvas" ).addClass( "mapa-canvas" );
});

window.AsignarIDHome=function(){

  $("body").addClass("HomePage");

}
