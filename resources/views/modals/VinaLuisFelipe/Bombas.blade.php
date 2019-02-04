

<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
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
                                         <input type="text" id="datetimesubmodal" class="datetimepicker form-control" placeholder="Fecha Inicio">
                                     </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                     <div class="form-line">
                                         <input type="text" id="datetimesubmodal2" class="datetimepicker form-control" placeholder="Fecha Fin">
                                     </div>
                                  </div>
                                </div>
                                <div class="col-md-1">
                                  <button onclick="RecogerFecha();" type="button" class="btn btn-primary waves-effect">→</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="body table-responsive">
                                    <table class="table table-striped">
                                       <thead>
                                          <tr>
                                             <th style="text-align: center;">Fecha</th>
                                             <th style="text-align: center;">Min&nbsp;Op.</th>
                                             <th style="text-align: center;">m3</th>
                                             <th style="text-align: center;">Bombas</th>
                                             </tr>
                                             </thead>
                                             @if ($Bombas!=null)
                                                <tbody align="center">
                                                   @php
                                                   $i=0;
                                                   @endphp
                                                   @foreach ($Bombas as $Bomba)
                                                   <tr>
                                                      <td><?php echo date_format(date_create($Bomba["FechaInicio"]), 'H:i:s'); ?></td>
                                                      <td>{{ $Bomba["MinutosOperativa"] }}</td>
                                                      <td></td>
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
                                 </div>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>

            <button style="display: none" type="button" class="btn btn-default waves-effect m-r-20 submodal" data-toggle="modal" data-target="#defaultModal" id="defaultModal">MODAL </button>

            <script>


                $(".submodal").click();
                $(".loader-insta").css("display", "none");
            </script>