<!DOCTYPE html>
<html>
  <head>
    <title>View Animation</title>
    <link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css">
    <!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>
    <script src="https://openlayers.org/en/v4.6.5/build/ol.js"></script>
  </head>
  <body>
    <div id="map" class="map"></div>
    <button id="fly-to-bern" onclick="flyTo(bern, function() {})">Fly to Bern</button>

    <script>
      var istanbul = ol.proj.fromLonLat([28.9744, 41.0128]);
      var bern = ol.proj.fromLonLat([7.4458, 46.95]);

      var view = new ol.View({
        center: istanbul,
        zoom: 6
      });

      var map = new ol.Map({
        target: 'map',
        layers: [
          new ol.layer.Tile({
            preload: 4,
            source: new ol.source.OSM()
          })
        ],
        // Improve user experience by loading tiles while animating. Will make
        // animations stutter on mobile or slow devices.
        loadTilesWhileAnimating: true,
        view: view
      });


      function onClick(id, callback) {
        document.getElementById(id).addEventListener('click', callback);
      }


      function flyTo(location, done) {
        var duration = 2000;
        var zoom = view.getZoom();
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
        view.animate({
          center: location,
          duration: duration
        }, callback);
        view.animate({
          zoom: zoom - 1,
          duration: duration / 2
        }, {
          zoom: zoom,
          duration: duration / 2
        }, callback);
      }

    


    </script>
  </body>
</html>