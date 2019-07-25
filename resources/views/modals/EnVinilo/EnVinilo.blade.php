<button type="button" class="btn btn-default waves-effect m-r-20 display-modal" data-toggle="modal" data-target="#largeModal" style="display: none"></button>
<!-- Large Size -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-lg" role="document" style="width: 95%;margin-top: 2%;">
      <div class="modal-content">
         <div class="modal-header">
            <div class="row" style="display: flex;">
               <div class="col-md-2">
                  <h4 class="modal-title nombre-instalacion" id="largeModalLabel" >EnVinilo</h4>
               </div>
            </div>
         </div>
         <div class="modal-body table-custom" style="padding-top: 0;margin-top: 35px">
            <iframe width="1546" height="541.25" src="https://app.powerbi.com/view?r=eyJrIjoiZmZiZTkzNjktYjQ5ZS00NDQ2LWFiZDYtNDlkY2RiNjk4MWFiIiwidCI6ImIwZmU2YjNlLTRjNTItNDg1Zi1hNzZlLWZjNTVjYzIzYzhmMCJ9" frameborder="0" allowFullScreen="true"></iframe>
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