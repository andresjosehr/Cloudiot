
    @include('header');

    @include('top_menu');

    @include('sidebar');


    <style>
      .ol-popup.input {
        background: none;
      }
      .ol-popup.input input {
        background-color: rgba(255,255,255,.6);
        border: 1px solid #999;
        padding: .2em .5em;
      }
    </style>

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
        rol_[i]         =  "{{ $Instalacion->rol }} ";

        if ("{{ $Instalacion->id }}"==8 || "{{ $Instalacion->id }}"==9 || "{{ $Instalacion->id }}"==10) {
          window.StartFinning=true;
        } else {window.StartFinning=false;}
        i++;
      @endforeach
      urlroot_="<?php echo Request::root() ?>/";
      var tabla_instalacion_asociada_ = "<?php echo $Instalacion->tabla_asociada ?>";

      @if ($Usuario->longitud==null)
      @php
        $longi='-71.148302';
        $lati='-34.078780';
      @endphp
      @else
      @php
        $longi=$Usuario->longitud;
        $lati=$Usuario->latitud;
      @endphp
      @endif

      @php
        if ($Usuario->zoom==null) {
          $zoom=8;
        }else{
          $zoom=$Usuario->zoom;
        }
      @endphp

      var Vista = RenderizarMapa(latitud_, longitud_, id_, controlador_, urlroot_, tabla_instalacion_asociada_, rol_, {{$lati}}, {{$longi}}, '{{$zoom}}');
      
      <?php $i=0; ?>
        @foreach ($Instalaciones as $Instalacion)
          $("#EsteEsMiID_<?php echo $i; ?>").on("click", function(){ flyTo(Vista, [{{ $Instalacion->longitud }}, {{ $Instalacion->latitud }}], function() {}); });
        <?php $i++; ?>
      @endforeach
  });

  AsignarIDHome();
</script>


    @include("footer");