<p>
                  <div class="row clearfix">
                     <div class="col-md-2">
                        Tiempo de Riego
                     </div>
                     <div class="col-md-6 vina-parametro-unidad">
                        <div id="Riego" @if ($Rolito->rol==2) disabled='true' @endif class="noUi-target noUi-ltr noUi-horizontal"></div>
                        <div class='vina-parametro-info'>
                           <-----<b id="RiegoValor"></b><b> Minutos</b>----->
                        </div>
                     </div>
                     <div class="col-md-4">
                        @if ($Rolito->rol==1)
                        <button onclick="RegistarRiego('<?php echo Request::root() ?>/InsertarParametroRiego')" class="btn btn-primary btn-block boton1 vina-btn-parametro">Registrar</button>
                        @endif
                        <div class="vina-vina-loadingg vina-loadingg1"></div>
                     </div>
                  </div>
               <div class="row clearfix">
                  <div class="col-md-2">
                     Tiempo de Reposo
                  </div>
                  <div class="col-md-6 vina-parametro-unidad">
                     <div id="Reposo" @if ($Rolito->rol==2) disabled='true' @endif class="noUi-target noUi-ltr noUi-horizontal"></div>
                     <div class='vina-parametro-info'>
                        <-----<b id="ReposoValor"></b><b> Minutos</b>-----> 
                     </div>
                  </div>
                  <div class="col-md-4">
                     @if ($Rolito->rol==1)
                     <button onclick='RegistarReposo("<?php echo Request::root() ?>/InsertarParametroReposo")' class="btn btn-primary btn-block boton2 vina-btn-parametro">Registrar</button>
                     @endif
                     <div class="vina-vina-loadingg vina-loadingg2"></div>
                  </div>
               </div>
               </p>


<script>
    @foreach ($Parametros as $Parametro)
      @if($Parametro->mt_name=="Biofiltro04--Consumo.TiempoRiego")
       var TiempoRiego="<?php echo $Parametro->mt_value ?>";
      @endif 
      @if($Parametro->mt_name=="Biofiltro04--Consumo.TiempoReposo")
       var TiempoReposo="<?php echo $Parametro->mt_value ?>";
      @endif  
   @endforeach



   
             var riego = document.getElementById('Riego');
   
             noUiSlider.create(riego, {
                 start: TiempoRiego,
   
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
                     thousand: '.',
                 })
             });
   
             riego.noUiSlider.on('update', function (values, handle) {
                window.riego=values[handle];
                document.getElementById('RiegoValor').innerHTML = myTime(values[handle].toString().replace('.', ''));
             });
   
   
             var reposo = document.getElementById('Reposo');
   
             noUiSlider.create(reposo, {
                 start: TiempoReposo,
   
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
                     thousand: '.',
                 })
             });
   
             reposo.noUiSlider.on('update', function (values, handle) {
                window.reposo=values[handle];
                document.getElementById('ReposoValor').innerHTML = myTime(values[handle].toString().replace('.', ''));
             });

             $(".noUi-handle").addClass("vina-noUi-handle");
             $(".noUi-connect").addClass("vina-noUi-connect");





</script>