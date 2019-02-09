
<div class="modal fade modalbomba" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document" style="width: 70%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="row">
                              <div id="contenedorLFE2"></div>
                                <div class="col-md-2">
                                    <p class="modal-title" id="defaultModalLabel">Bombas</p>
                                </div>
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                     <div class="form-line">
                                         <input type="text" id="FechaInicioBomba" class="datetimepicker form-control" placeholder="Fecha Inicio">
                                     </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                     <div class="form-line">
                                         <input type="text" id="FechaFinBomba" class="datetimepicker form-control" placeholder="Fecha Fin">
                                     </div>
                                  </div>
                                </div>
                                <div class="col-md-1">
                                  <button onclick="GraficarBombas();" type="button" class="btn btn-primary waves-effect">→</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="body table-responsive" style="max-height: 65%;">
                                    <table class="table table-striped">
                                       <thead>
                                          <tr>
                                             <th style="text-align: center;">Fecha</th>
                                             <th style="text-align: center;">Min&nbsp;Op.</th>
                                             <th style="text-align: center;">m3</th>
                                             <th style="text-align: center;">Bombas</th>
                                             </tr>
                                             </thead>
                                             @if ($ImprimirBombas==true)
                                                <tbody align="center">
                                                   @php
                                                   $i=0;
                                                   @endphp
                                                   @foreach ($Bombas as $Bomba)
                                                   <tr>
                                                      <td><?php echo date_format(date_create($Bomba["FechaInicio"]), 'Y-m-j H:i:s'); ?></td>
                                                      <td>{{ $Bomba["MinutosOperativa"] }}</td>
                                                      <td>{{ $Bomba["Flujo"] }}</td>
                                                      <td>
                                                      @if ($Bomba["NumeroDeBomba"][1]==1)
                                                         <i class="material-icons btn-bomba">add_circle</i>
                                                      @endif
                                                      @if ($Bomba["NumeroDeBomba"][1]==0)
                                                         <i class="material-icons btn-bomba" style="color: #a0a0a0 !important;">add_circle</i>
                                                      @endif
                                                      @if ($Bomba["NumeroDeBomba"][2]==1)
                                                         <i class="material-icons btn-bomba">add_circle</i>
                                                      @endif
                                                      @if ($Bomba["NumeroDeBomba"][2]==0)
                                                         <i class="material-icons btn-bomba" style="color: #a0a0a0 !important;">add_circle</i>
                                                      @endif
                                                      @if ($Bomba["NumeroDeBomba"][3]==1)
                                                         <i class="material-icons btn-bomba">add_circle</i>
                                                      @endif
                                                      @if ($Bomba["NumeroDeBomba"][3]==0)
                                                         <i class="material-icons btn-bomba" style="color: #a0a0a0 !important;">add_circle</i>
                                                      @endif
                                                      </td>
                                                   </tr>
                                                   @php
                                                   $i++;
                                                   @endphp
                                                   @endforeach
                                                </tbody>
                                             @endif
                                    </table>
                                    @if ($ImprimirBombas==false && $Horas12==true)
                                                <div>
                                                   <p>Sin datos de Bombas activas en las ultimas 12 horas</p>
                                                   <p>Selecciona una fecha personalizada para obetener datos</p>
                                                </div>
                                             @endif
                                             @if ($ImprimirBombas==false && $Horas12==false)
                                                <div>
                                                   <p>Sin datos de Bombas activas en el rango seleccionado</p>
                                                   <p>Selecciona otra fecha personalizada para obetener datos</p>
                                                </div>
                                             @endif
                                 </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-link waves-effect" onclick="Epale()">CLOSE</button>
                        </div>
                    </div>
                </div>
                <button style="display: none" type="button" class="btn btn-default waves-effect m-r-20 submodal" data-toggle="modal" data-target="#defaultModal" id="defaultModal">MODAL </button>
            </div>
            



            <script>

              function GraficarBombas() {

               $(".loader-insta").css("display", "block");


                var FechaInicio = document.getElementById('FechaInicioBomba').value;
                var FechaFin = document.getElementById('FechaFinBomba').value;
                var url = "<?php echo Request::root() ?>/CalculosLuisFelipe6";
                $("#contenedorLFE").load(url, {FechaInicio: FechaInicio, FechaFin: FechaFin});
                $('body').removeClass('modal-open');
                $('.modalbomba').modal('hide');
                $('.modalbomba').empty();
                $('.modalbomba').remove();
              }

              $('#FechaInicioBomba').bootstrapMaterialDatePicker
                ({
                  format: 'YYYY-MM-DD HH:mm',
                  lang: 'es',
                  weekStart: 1, 
                  cancelText : 'ANNULER',
                  nowButton : true,
                  switchOnClick : true
                });

                $('#FechaFinBomba').bootstrapMaterialDatePicker
                ({
                  format: 'YYYY-MM-DD HH:mm',
                  lang: 'es',
                  weekStart: 1, 
                  cancelText : 'ANNULER',
                  nowButton : true,
                  switchOnClick : true
                });

                @if (isset($FechaInicio))
                   document.getElementById('FechaInicioBomba').value="{{$FechaInicio}}";
                  document.getElementById('FechaFinBomba').value="{{$FechaFin}}";
                @endif


                $(".submodal").click();
                $(".loader-insta").css("display", "none");


            </script>