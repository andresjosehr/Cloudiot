$.ajaxSetup({
       headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
});

window.RenderizarMapa=function(latitud, longitud, id, controlador, urlroot, tabla_instalacion_asociada_, rol_, lat_ini, lon_ini, zoom_) {


  function Marcador(lon, lat, id, controlador, rol_, imageDefault) {


      var vectorSource = new ol.source.Vector({
        //create empty vector
      });

      //create a bunch of icons and add to source vector
        
        var iconFeature = new ol.Feature({
          geometry: new  
          ol.geom.Point([lon, lat]),
          name: id,
          customID: id,
          controlador: controlador,
          rol: rol_,
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
            opacity: 1,
            src: imageDefault,
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
      Instalaciones[i]=Marcador(longitud[i], latitud[i], id[i], controlador[i], rol_[i], 'images/marc_negro.png');

    }

    var vista = new ol.View({
      center: [lon_ini, lat_ini],
      zoom: zoom_,
      projection: 'EPSG:4326'
    })
    

    var map = new ol.Map({
      layers: [new ol.layer.Tile({ source: new ol.source.XYZ({
    attributions: ['Powered by Esri',
                   'Source: Esri, DigitalGlobe, GeoEye, Earthstar Geographics, CNES/Airbus DS, USDA, USGS, AeroGRID, IGN, and the GIS User Community'],
    attributionsCollapsible: false,
    url: 'https://services.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
    maxZoom: 23
  }) })],
      target: document.getElementById('map'),
      view: vista
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
                var rol            = feature.values_.rol;
                var url            = urlroot+controlador;
                var datos          = $('#consulta-form').serialize();

                $("#contenedor").load(url, {id: id, tabla_asociada: tabla_instalacion_asociada, rol: rol});
            })
        });



             // function FinningQuery() {

             //   $.ajax({
             //      type: 'POST',
             //      url: urlroot_+"/FinningEstadoBombasMarcador",
             //      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
             //      success: function(result){




             //         map.getLayers().forEach(function(feature, layerin) {

             //        // map.removeLayer(map.getLayers());
             //        if (layerin==8) {
             //                map.removeLayer(feature);

             //                console.log(result.PlantaAgua)

             //                if (result.PlantaAgua==0) map.addLayer(Marcador(-70.388521, -23.597659, 9, "FinningController" , 1, 'images/marc_verde.png' ));
             //                if (result.PlantaAgua==1) map.addLayer(Marcador(-70.388521, -23.597659, 9, "FinningController" , 1, 'images/marc_amarillo.png' ));
             //                if (result.PlantaAgua==2) map.addLayer(Marcador(-70.388521, -23.597659, 9, "FinningController" , 1, 'images/marc_rojo.png' ));

             //                map.addLayer(Marcador(-70.389085, -23.598169, 8, "FinningController" , 1, 'images/marc_negro.png' ));



             //              }
             //         }); 



             //      }
             //  });
             // }

             //  FinningQuery();

              setInterval(function(){
                  FinningQuery();
              }, 60000);     











  var tabla_instalacion_asociada = tabla_instalacion_asociada_;
  return vista;
}

window.flyTo=function(vistamo ,location, done) {
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
      }




$( document ).ready(function() {
  $( ".content" ).addClass( "mapa-content" );
  $( "canvas" ).addClass( "mapa-canvas" );
});

window.AsignarIDHome=function(){

  $("body").addClass("HomePage");

}