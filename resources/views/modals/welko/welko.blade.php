<button type="button" class="btn btn-default waves-effect m-r-20 display-modal" data-toggle="modal" data-target="#largeModal" id="button_3b6e_0"></button>
<!-- Large Size -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-lg" role="document" id="div_3b6e_0">
      <div class="modal-content">
         <div class="modal-header">
            <div class="row" id="div_3b6e_1">
               <div class="col-md-2">
                Welko
               </div>
               <div class="col-md-5">
               </div>
               <div class="col-md-6" id="div_3b6e_2">
                  <div class="row">
                     <div class="col-md-5">
                        <div class="form-group">
                           <div class="form-line">
                              <input type="text" id="fecha_flujo_inicio" class="datetimepicker form-control" placeholder="Fecha Inicio">
                           </div>
                        </div>
                     </div>
                     <div class="col-md-5">
                        <div class="form-group">
                           <div class="form-line">
                              <input type="text" id="fecha_flujo_fin" class="datetimepicker form-control" placeholder="Fecha Fin">
                           </div>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <button onclick="GraficarFinning();" type="button" class="btn btn-primary waves-effect"><i class="fa fa-table"></i></button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-body table-custom" id="div_3b6e_3">
            <div class="row" style="min-height: 300px;">
               <div class="col-md-2" id='pozo_nave_4_div'>
                 {{-- @include("modals.Finning.pozo_nave_4") --}}
                 <div class="sicut-loading" id="sicut-loading5" style="margin-top:75px;"></div>
               </div>
               <div class="col-md-5" id="planta_agua_div">
                 {{-- @include("modals.Finning.planta_agua") --}}
                 <div class="sicut-loading" id="sicut-loading5" style="margin-top:75px;"></div>
               </div>
               <div class="col-md-5" id="dinamometro_div">
                 {{-- @include("modals.Finning.dinamometro") --}}
                 <div class="sicut-loading" id="sicut-loading5" style="margin-top:75px;"></div>
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

<script>
   $( ".display-modal" ).click();
   $(".loader-insta").css("display", "none");
  </script>