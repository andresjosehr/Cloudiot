<p>
                  <div class="row clearfix">
                     <div class="col-md-2">
                        Tiempo de Riego
                     </div>
                     <div class="col-md-6 vina-parametro-unidad">
                        <div id="Riego" @if ($Rol==2) disabled='true' @endif class="noUi-target noUi-ltr noUi-horizontal"></div>
                        <div class='vina-parametro-info'>
                           <-----<b id="RiegoValor"></b><b> Minutos</b>----->
                        </div>
                     </div>
                     <div class="col-md-4">
                        @if ($Rol==1)
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
                     <div id="Reposo" @if ($Rol==2) disabled='true' @endif class="noUi-target noUi-ltr noUi-horizontal"></div>
                     <div class='vina-parametro-info'>
                        <-----<b id="ReposoValor"></b><b> Minutos</b>-----> 
                     </div>
                  </div>
                  <div class="col-md-4">
                     @if ($Rol==1)
                     <button onclick='RegistarReposo("<?php echo Request::root() ?>/InsertarParametroReposo")' class="btn btn-primary btn-block boton2 vina-btn-parametro">Registrar</button>
                     @endif
                     <div class="vina-vina-loadingg vina-loadingg2"></div>
                  </div>
               </div>
               <div class="row clearfix">
                  <div class="col-md-2">
                     Rango de PH
                  </div>
                  <div class="col-md-6 vina-parametro-unidad">
                     <div id="slider" @if ($Rol==2) disabled='true' @endif class="noUi-target noUi-ltr noUi-horizontal"></div>
                     <div class='vina-parametro-info'>
                        <b id="BajoPH"></b><----------><b id="AltoPH"></b>
                     </div>
                  </div>
                  <div class="col-md-4">
                     @if ($Rol==1)
                     <button onclick="RegistarRangoPH('<?php echo Request::root() ?>/InsertarParametroRangoPH')" class="btn btn-primary btn-block boton3 vina-btn-parametro">Registrar</button>
                     @endif
                     <div class="vina-vina-loadingg vina-loadingg3"></div>
                  </div>
               </div>
               </p>


<script>
    @foreach ($Parametros as $Parametro)
    @if($Parametro->mt_name=="Biofiltro02--Consumo.LimitePH_Bajo")
      var vina_param_bajo="<?php echo $Parametro->mt_value/100 ?>";
     @endif 
     @if($Parametro->mt_name=="Biofiltro02--Consumo.LimitePH_Alto")
       var vina_param_alto="<?php echo $Parametro->mt_value/100 ?>";
      @endif
      @if($Parametro->mt_name=="Biofiltro02--Consumo.TiempoRiego")
       var TiempoRiego="<?php echo $Parametro->mt_value ?>";
      @endif 
      @if($Parametro->mt_name=="Biofiltro02--Consumo.TiempoReposo")
       var TiempoReposo="<?php echo $Parametro->mt_value ?>";
      @endif  
   @endforeach

   $("#parametros").click(function () {
     CompilarRango(vina_param_alto, vina_param_bajo, TiempoRiego, TiempoReposo);
   });
</script>