
    @include('header');

    @include('top_menu');

    @include('sidebar');

    <section>
        <div class="container-fluid">
            <div class="block-header">
              <div align="center" class="contenedor-home" id="contenedor"></div>
                <div class="right_col section-mapa" role="main">
                  <div id="map" class="map"></div>
                </div>
            </div>
        </div>
    </section>

<script>
  $(document).ready(function () {
      var longitud_    = [];
      var latitud_     = [];
      var id_          = [];
      var controlador_ = [];
      var i           = 0;
      @foreach ($Instalaciones as $Instalacion)
        longitud_[i]    =  "{{ $Instalacion->longitud }}";
        latitud_[i]     =  "{{ $Instalacion->latitud }}";
        id_[i]          =  "{{ $Instalacion->id }}";
        controlador_[i] =  "{{ $Instalacion->controlador }} ";
        i++;
      @endforeach
      urlroot_="<?php echo Request::root() ?>/";
      var tabla_instalacion_asociada_ = "<?php echo $Instalacion->tabla_asociada ?>";
      RenderizarMapa(latitud_, longitud_, id_, controlador_, urlroot_, tabla_instalacion_asociada_);
  });

  AsignarIDHome();
    </script>

    @include("footer");