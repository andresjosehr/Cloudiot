<script>
   var FP=0;
</script>
   <button type="button" class="btn btn-default waves-effect m-r-20 display-modal sitcut-btn-modal" data-toggle="modal" data-target="#largeModal"></button>
  
         <!-- Large Size -->
            <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg sicut-modal" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                          <div class="row">
                            <div class="col-md-3">
                              <h4 class="modal-title sicut-nombre-instalacion" id="largeModalLabel" >{{ $Instalacion->nombre }}</h4>
                            </div>
                            <div class="col-md-3">
                              <h4 class="modal-title sicut-nombre-instalacion" id="largeModalLabel" >Ultima dato: {{ $Datos["UltimaMedicion"] }}</h4> 
                            </div>                            
                          </div>
                        </div>
                        <hr class="sicut-hr">  
                        <div class="modal-body">
                          <div id="SicutContenedor1"></div>
                          <div id="SicutContenedor2"></div>
                          <div id="SicutContenedor3"></div>
                          <div id="SicutContenedor4"></div>
                          <div id="SicutContenedor5"></div>
                          <div id="SicutContenedor6"></div>
                          <div id="SicutContenedor7"></div>
                          <div id="SicutSubModalContenedor"></div>
                          <div id="SicutContenedorExcel"></div>
                            <div class="row" align="center">
                                    <div class="col-md-4">
                                      <div class="body table-responsive">
                                          <table class="table sicut-table-bordered sicut-modal-table1">
                                            <thead>
                                                <caption scope="row" class="sicut-tabla-titulo">reg. kWh últ. 15 min.</caption>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th class="sicut-th">Inyectada</th>
                                                    <td>{{ $Datos["EnergiaActivaInyectada"] }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="sicut-th">Retirada</th>
                                                    <td>{{ $Datos["EnergiaActivaRetirada"] }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="body table-responsive">
                                          <table class="table sicut-table-bordered sicut-modal-table1">
                                            <thead>
                                                <caption scope="row" class="sicut-tabla-titulo">reg. kVARh últ. 15 min</caption>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th class="sicut-th">Inyectada</th>
                                                    <td>{{ $Datos["EnergíaReactivaInyectada"] }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="sicut-th">Retirada</th>
                                                    <td>{{ $Datos["EnergíaReactivaRetirada"] }}</td>
                                                </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="body table-responsive">
                                          <table class="table sicut-table-bordered sicut-modal-table1">
                                            <thead>
                                                <caption scope="row" class="sicut-tabla-titulo">Potencia (kW)</caption>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th class="sicut-th">Inyectada</th>
                                                    <td id="PoteIny"></td>
                                                </tr>
                                                <tr>
                                                    <th class="sicut-th">Retirada</th>
                                                    <td id="PoteRet"></td>
                                                </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4" align="center">
                                  <div class="div-chart1">
                                    <canvas onclick="GraficarDefaultIgnis('<?php echo Request::root(); ?>', '1')" id="myChart0" height="100"></canvas>
                                  </div>
                                  <div class="sicut-loading" id="sicut-loading1"></div>
                                </div>
                                <div class="col-md-4" align="center">
                                  <div class="div-chart2">
                                    <canvas onclick="GraficarDefaultIgnis('<?php echo Request::root(); ?>', '2')" id="myChart1" height="100"></canvas>
                                  </div>
                                  <div class="sicut-loading" id="sicut-loading2"></div>
                                </div>
                                <div class="col-md-4">
                                  <canvas onclick="GraficarDefaultIgnis('<?php echo Request::root(); ?>', '7')" id="sicut-myChart3" height="100"></canvas>
                                </div>
                          </div>
                            <div class="row sicut-row2" align="center">
                              <div class="col-md-4">
                                <div class="body table-responsive">
                                    <table class="table sicut-table-bordered sicut-modal-table1">
                                      <thead>
                                          <caption scope="row" class="sicut-tabla-titulo">Voltaje de Lineas</caption>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <th class="sicut-th">VL ab</th>
                                              <td>{{ $Datos["VoltajeDeLineaAB"] }}</td>
                                          </tr>
                                          <tr>
                                              <th class="sicut-th">VL bc</th>
                                              <td>{{ $Datos["VoltajeDeLineaBC"] }}</td>
                                          </tr>
                                          <tr>
                                              <th class="sicut-th">VL ca</th>
                                              <td>{{ $Datos["VoltajeDeLineaCA"] }}</td>
                                          </tr>
                                          <tr>
                                              <th class="sicut-th">Promedio</th>
                                              <td>{{ $Datos["VoltajeDeLineaPromedio"] }}</td>
                                          </tr>
                                      </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="body table-responsive">
                                    <table class="table sicut-table-bordered sicut-modal-table1">
                                      <thead>
                                          <caption scope="row" class="sicut-tabla-titulo">Voltaje de Fases</caption>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <th class="sicut-th">Voltaje A</th>
                                              <td>{{ $Datos["VoltajeA"] }}</td>
                                          </tr>
                                          <tr>
                                              <th class="sicut-th">Voltaje B</th>
                                              <td>{{ $Datos["VoltajeB"] }}</td>
                                          </tr>
                                          <tr>
                                              <th class="sicut-th">Voltaje C</th>
                                              <td>{{ $Datos["VoltajeC"] }}</td>
                                          </tr>
                                          <tr>
                                              <th class="sicut-th">Promedio</th>
                                              <td>{{ $Datos["VoltajePromedio"] }}</td>
                                          </tr>
                                      </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="body table-responsive">
                                    <table class="table sicut-table-bordered sicut-modal-table1">
                                      <thead>
                                          <caption scope="row" class="sicut-tabla-titulo">Factor de potencia</caption>
                                      </thead>
                                      <tbody>
{{--                                           <tr>
                                              <th class="sicut-th">F. Potencia A</th>
                                              <td>{{ $Datos["FactorPotenciaA"] }}</td>
                                          </tr>
                                          <tr>
                                              <th class="sicut-th">F. Potencia B</th>
                                              <td>{{ $Datos["FactorPotenciaB"] }}</td>
                                          </tr>
                                          <tr>
                                              <th class="sicut-th">F. Potencia C</th>
                                              <td>{{ $Datos["FactorPotenciaC"] }}</td>
                                          </tr> --}}
                                          <tr>
                                              <th class="sicut-th">Total</th>
                                              <td id="FactorPotencia_td">{{-- {{ $Datos["FactorPotenciaTotal"] }} --}}</td>
                                          </tr>
                                      </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="row" align="center" class="sicut-row-chart-2">
                          <div class="col-md-4">
                            <div class="div-chart3">
                                <canvas onclick="GraficarDefaultIgnis('<?php echo Request::root(); ?>', '3')" id="myChart4" height="100"></canvas>
                            </div>
                              <div class="sicut-loading" id="sicut-loading3"></div>
                            </div>
                            <div class="col-md-4">
                              <div class="div-chart4">
                                  <canvas onclick="GraficarDefaultIgnis('<?php echo Request::root(); ?>', '4')" id="myChart5" height="100"></canvas>
                              </div>
                              <div class="sicut-loading" id="sicut-loading4"></div>
                            </div>
                            <div class="col-md-4">
                              <div class="div-chart5">
                                    <canvas onclick="GraficarDefaultIgnis('<?php echo Request::root(); ?>', '5')" id="myChart6" height="100"></canvas>
                                </div>
                              <div class="sicut-loading" id="sicut-loading5"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <div align="center">
                            <a href="{{Request::root()}}/ExportarAasa" target="_blank" class="btn btn-primary" id="SicutExportarExcel">Exportar a Excel</a>
                          </div>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <form id="TheForm" method="post" action="<?php echo Request::root() ?>/ExportarSicutExcel" target="TheWindow">
              @csrf 
              
           </form>


           <style>
              canvas{
                  cursor: pointer;
              }
          </style>

  <script>


    var FuncionesCompletas=0;
    var url_ = "<?php echo Request::root() ?>";
    SicutScriptDefault();
    GraficarTodo(url_);
    var SicutFormLimit=0;

    function FuncionExportacion(final) {
      if (final==7) {
        var script = document.createElement( "script" );
        script.type = "text/javascript";
        script.text = function ExportarSicutExcel() { SubirDatos(); };
        document.getElementsByTagName('head')[0].appendChild(script);
        $("#SicutExportarExcel").on("click", function(){ ExportarSicutExcel(); });
        $("#SicutExportarExcel").removeAttr("disabled");
      }
    }

    function SubirDatos(){
        if (SicutFormLimit==0) {
          $( "#TheForm" ).append( "<input type='hidden' name='EnergiaActivaInyectada_mt_time' value='"+EnergiaActivaInyectada_mt_time+"'>" );
          $( "#TheForm" ).append( "<input type='hidden' name='EnergiaActivaInyectada_mt_value' value='"+EnergiaActivaInyectada_mt_value+"'>" );
          $( "#TheForm" ).append( "<input type='hidden' name='EnergiaActivaRetirada_mt_value' value='"+EnergiaActivaRetirada_mt_value+"'>" );

          $( "#TheForm" ).append( "<input type='hidden' name='EnergiaReactivaInyectada_mt_time' value='"+EnergiaReactivaInyectada_mt_time+"'>" );
          $( "#TheForm" ).append( "<input type='hidden' name='EnergiaReactivaInyectada_mt_value' value='"+EnergiaReactivaInyectada_mt_value+"'>" );
          $( "#TheForm" ).append( "<input type='hidden' name='EnergiaReactivaRetirada_mt_value' value='"+EnergiaReactivaRetirada_mt_value+"'>" );

          $( "#TheForm" ).append( "<input type='hidden' name='VoltajeLineaab_mt_time' value='"+VoltajeLineaab_mt_time+"'>" );
          $( "#TheForm" ).append( "<input type='hidden' name='VoltajeLineaab_mt_value' value='"+VoltajeLineaab_mt_value+"'>" );
          $( "#TheForm" ).append( "<input type='hidden' name='VoltajeLineabc_mt_value' value='"+VoltajeLineabc_mt_value+"'>" );
          $( "#TheForm" ).append( "<input type='hidden' name='VoltajeLineaca_mt_value' value='"+VoltajeLineaca_mt_value+"'>" );
          $( "#TheForm" ).append( "<input type='hidden' name='VoltajeLineaPromedio_mt_value' value='"+VoltajeLineaPromedio_mt_value+"'>" );

          $( "#TheForm" ).append( "<input type='hidden' name='Voltajea_mt_time' value='"+Voltajea_mt_time+"'>" );
          $( "#TheForm" ).append( "<input type='hidden' name='Voltajea_mt_value' value='"+Voltajea_mt_value+"'>" );
          $( "#TheForm" ).append( "<input type='hidden' name='Voltajeb_mt_value' value='"+Voltajeb_mt_value+"'>" );
          $( "#TheForm" ).append( "<input type='hidden' name='Voltajec_mt_value' value='"+Voltajec_mt_value+"'>" );
          $( "#TheForm" ).append( "<input type='hidden' name='VoltajePromedio_mt_value' value='"+VoltajePromedio_mt_value+"'>" );

          $( "#TheForm" ).append( "<input type='hidden' name='FactorPotenciaa_mt_time' value='"+FactorPotenciaa_mt_time+"'>" );
          $( "#TheForm" ).append( "<input type='hidden' name='FactorPotenciaa_mt_value' value='"+FactorPotenciaa_mt_value+"'>" );
          $( "#TheForm" ).append( "<input type='hidden' name='FactorPotenciab_mt_value' value='"+FactorPotenciab_mt_value+"'>" );
          $( "#TheForm" ).append( "<input type='hidden' name='FactorPotenciac_mt_value' value='"+FactorPotenciac_mt_value+"'>" );
          $( "#TheForm" ).append( "<input type='hidden' name='FactorPotenciaTotal_mt_value' value='"+FactorPotenciaTotal_mt_value+"'>" );
        }
        SicutFormLimit++;
        window.open('', 'TheWindow'); document.getElementById('TheForm').submit();
      }  
  </script>