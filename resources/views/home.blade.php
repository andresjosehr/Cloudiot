{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

    <link rel="stylesheet" href="css/custom/home.css">

    @include('header');

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    @include('top_menu');

    @include('sidebar');

    <section>
        <div class="container-fluid">
            <div class="block-header">
              <div align="center" id="contenedor"></div>
                <div class="right_col section-mapa" role="main">
                  <div id="map" class="map"></div>
                </div>
            </div>
        </div>
    </section>

    <script>




(function(){

  function Marcador(lon, lat, id) {
    var vectorSource = new ol.source.Vector({
      //create empty vector
    });

      //create a bunch of icons and add to source vector
        
        var iconFeature = new ol.Feature({
          geometry: new  
          ol.geom.Point([lon, lat]),
          name: id,
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

    

    var map = new ol.Map({
      layers: [new ol.layer.Tile({ source: new ol.source.OSM() }), @foreach ($Instalaciones as $Instalacion) Marcador({{ $Instalacion->longitud }}, {{ $Instalacion->latitud }}, {{ $Instalacion->id }}), @endforeach ],
      target: document.getElementById('map'),
      view: new ol.View({
      center: [-71.097899, -34.766003],
      zoom: 7,
      projection: 'EPSG:4326'
      })
    });

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

                var id    = feature.values_.name;
                var url   = "<?php echo Request::root() ?>/ConsultaInstalacion";
                var datos = $('#consulta-form').serialize();
                
                $("#contenedor").load(url, {id: id});


            })
        });

  })();
    </script>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>

    <script src="js/custom.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

</body>

</html>