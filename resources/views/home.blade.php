
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
      var rol_ = [];
      var i           = 0;
      @foreach ($Instalaciones as $Instalacion)
        longitud_[i]    =  "{{ $Instalacion->longitud }}";
        latitud_[i]     =  "{{ $Instalacion->latitud }}";
        id_[i]          =  "{{ $Instalacion->id }}";
        controlador_[i] =  "{{ $Instalacion->controlador }} ";
        rol_[i] =  "{{ $Instalacion->rol }} ";
        i++;
      @endforeach
      urlroot_="<?php echo Request::root() ?>/";
      var tabla_instalacion_asociada_ = "<?php echo $Instalacion->tabla_asociada ?>";

      var Vista = RenderizarMapa(latitud_, longitud_, id_, controlador_, urlroot_, tabla_instalacion_asociada_, rol_);
      
      <?php $i=0; ?>
      @foreach ($Instalaciones as $Instalacion)
      $("#EsteEsMiID_<?php echo $i; ?>").on("click", function(){ flyTo(Vista, [{{ $Instalacion->longitud }}, {{ $Instalacion->latitud }}], function() {}); });
      <?php $i++; ?>
      @endforeach
  });

  AsignarIDHome();
</script>


    @include("footer");