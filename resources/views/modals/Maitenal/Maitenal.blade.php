<button type="button" class="btn btn-default waves-effect m-r-20 display-modal" data-toggle="modal" data-target="#largeModal" style="display: none"></button>
<!-- Large Size -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-lg" role="document" style="width: 95%;margin-top: 2%;">
      <div class="modal-content">
         <div class="modal-header">
            <div class="row">
               <div class="col-md-2">
                  <h4 class="modal-title nombre-instalacion" id="largeModalLabel" >El Maitenal</h4>
               </div>
               <div class="col-md-5">
                  <h4 class="modal-title nombre-instalacion" id="largeModalLabel">Ultima Mendicion: {{$UltimaMedicion->mt_time}}</h4>
               </div>
               <div class="col-md-5">
                  <h4 class="modal-title nombre-instalacion" id="largeModalLabel">Flujo Total: {{$FlujoTotal->mt_value}}</h4>
               </div>
            </div>
         </div>
         <hr style=" color: black">
         <div class="modal-body table-custom">
            <div class="body">
               <!-- Nav tabs -->
               <ul class="nav nav-tabs tab-nav-right" role="tablist">
                  <li role="presentation" class="active"><a href="#home" data-toggle="tab">Panel</a></li>
                  <li role="presentation" id="parametros"><a href="#profile" data-toggle="tab">Parametros</a></li>
                  <li role="presentation" id="flujoDiario_"><a href="#flujoDiario" data-toggle="tab">Flujo Diario</a></li>
               </ul>
               <!-- Tab panes -->
               <div class="tab-content">
                  <div role="tabpanel" class="tab-pane fade in active" id="home">
                     <div class="row" align="center">
                        <div class="col-md-4">
                           <div id="bombas_maitenal"></div>
                           <div class="vina-loading-bomba" style="display: block; margin-top: 90px"></div>
                        </div>
                        <div class="col-md-4">
                           <div class="bombas-cargando" style="padding-top: 76px;">
                              <div class="row">
                                 <div class="col-md-4">
                                    Bomba 1
                                 </div>
                                 <div class="col-md-1">
                                    <button type="button" class="btncasc0 btn btn-circle waves-effect waves-circle waves-float vina-circle-custom bg-green">
                                    <i class="material-icons bomba0-op-btn">check</i>
                                    </button>
                                    <br>
                                 </div>
                                 <div class="col-md-3">
                                    <span class="badge bomba0-op bg-red">No Op.</span>
                                 </div>
                                 <div class="col-md-3">
                                    <button type="button" class="vina-btn-bomba-error0 btn waves-effect vina-btn_error_custom bg-green">
                                    <span class="vina-custom-error texto-error0">Sin Error</span>
                                    </button>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-4">
                                    Bomba 2
                                 </div>
                                 <div class="col-md-1">
                                    <button type="button" class="btncasc1 btn btn-circle waves-effect waves-circle waves-float vina-circle-custom bg-green">
                                    <i class="material-icons bomba1-op-btn">check</i>
                                    </button>
                                    <br>
                                 </div>
                                 <div class="col-md-3">
                                    <span class="badge bomba1-op bg-red">No Op.</span>
                                 </div>
                                 <div class="col-md-3">
                                    <button type="button" class="vina-btn-bomba-error1 btn waves-effect vina-btn_error_custom bg-green">
                                    <span class="vina-custom-error texto-error1">Sin Error</span>
                                    </button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4">
                        </div>
                        <div class="row">
                           <div class="col-md-8">
                              <canvas id="myChart" height="80"></canvas>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="profile">
                     <div id="MaitenalParametros"></div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="flujoDiario">
                     <div id="MaitenalFlujoDiario"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <div id="grafico_maitenal"></div>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
         </div>
      </div>
   </div>
</div>
<style>
   div .btn-bomba{
   color: #2b982b !important;
   font-size: 13px;
   }
   .boton-bombas{
   width: 9px;
   height: 16px;
   }            
   .tabla-titulo{
   background: #cccccc;
   border: 1px solid #cccccc;
   border-bottom: 0;
   text-align: center; 
   font-weight: 600; 
   color: black;
   padding-top: 4px;
   padding-bottom: 4px;
   border-top-left-radius: 10px;
   border-top-right-radius: 10px;
   }
   .nombre-instalacion{
   text-align: left;
   }
   .modal-table1 tbody tr th{
   padding-top: 0px !important;
   padding-bottom: 0px !important;
   padding-right: 0px !important;
   padding-left: 10px !important;
   text-align: left;
   }
   .modal-table1 tbody tr td{
   text-align: center;
   padding: 0px !important;
   }
   .table-bordered tbody tr td, .table-bordered tbody tr th {
   font-size: 13px;
   border-color: #cccccc;
   }
   .col-1-5{
   width: 20%;
   float: left;
   position: relative;
   min-height: 1px;
   padding-right: 15px;
   padding-left: 15px;
   }
   .table tbody tr td, .table tbody tr th {
   padding: 5px;
   }
   .table-custom table{
   font-size: 13px;
   }
</style>
<script  src="instalaciones/PlantaLican.js"></script>
<script>
   $( ".display-modal" ).click();
   $(".loader-insta").css("display", "none");
   
      $(document).ready(function(){
        $("#bombas_maitenal").load("<?php echo Request::root() ?>/MaitenalBombas");
        $("#grafico_maitenal").load("<?php echo Request::root() ?>/MaitenalGrafico");
        $("#MaitenalParametros").load("<?php echo Request::root() ?>/MaitenalParametros");
        $("#MaitenalFlujoDiario").load("<?php echo Request::root() ?>/MaitenalFlujoDiario");
      })
            
</script>