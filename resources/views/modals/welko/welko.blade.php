<button type="button" class="btn btn-default waves-effect m-r-20 display-modal" data-toggle="modal" data-target="#largeModal" id="button_3b6e_0"></button>
<!-- Large Size -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-lg" role="document" id="div_3b6e_0">
      <div class="modal-content">
         <div class="modal-header">
            <div class="row" id="div_3b6e_1">
               <div class="col-md-2">
                <h2 class="font-weight-bold">Welko</h2>
               </div>
               <div class="col-md-5" style="line-height: 0">
                  <h4 class="modal-title nombre-instalacion" id="largeModalLabel">Ultima Medición: {{$Datos["UltimaMedicion"][0]->mt_time}}</h4>
                </div>
           {{--     <div class="col-md-6" id="div_3b6e_2">
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
               </div> --}}
            </div>
         </div>
         <div class="modal-body table-custom" id="div_3b6e_3">
            <div class="row" style="">
              

               <div class="col-md-12">
                <div class="sicut-loading" id="WelkoNivel-loader" style="margin-top:75px;"></div>
                 <canvas id="WelkoNivel" height="50"></canvas>
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
   window.AjaxRequest("POST", "WelkoGraficarNivel", "1")
   $( ".display-modal" ).click();
   $(".loader-insta").css("display", "none");
  </script>