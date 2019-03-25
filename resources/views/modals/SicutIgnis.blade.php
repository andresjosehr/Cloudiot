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
                            <div class="col-md-6">
                              <button onclick="GraficarSicutPersonalizado('<?php echo Request::root(); ?>')" type="button" class="btn btn-primary waves-effect">→</button>
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
                                    <div class="col-md-3">
                                      <div class="body table-responsive">
                                          <table class="table sicut-table-bordered sicut-modal-table1">
                                            <thead>
                                                <caption scope="row" class="sicut-tabla-titulo">Energia Activa</caption>
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
                                    <div class="col-md-3">
                                      <div class="body table-responsive">
                                          <table class="table sicut-table-bordered sicut-modal-table1">
                                            <thead>
                                                <caption scope="row" class="sicut-tabla-titulo">Energia Reactiva</caption>
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
                                    <div class="col-md-6">
                                      <canvas onclick="GraficarDefaultIgnis('<?php echo Request::root(); ?>', '7')" id="sicut-myChart3" height="70" style="margin-top: 30px"></canvas>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3" align="center">
                                  <div class="div-chart1">
                                    <canvas onclick="GraficarDefaultIgnis('<?php echo Request::root(); ?>', '1')" id="myChart0" height="100"></canvas>
                                  </div>
                                  <div class="sicut-loading" id="sicut-loading1"></div>
                                </div>
                                <div class="col-md-3" align="center">
                                  <div class="div-chart2">
                                    <canvas onclick="GraficarDefaultIgnis('<?php echo Request::root(); ?>', '2')" id="myChart1" height="100"></canvas>
                                  </div>
                                  <div class="sicut-loading" id="sicut-loading2"></div>
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
                                          <tr>
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
                                          </tr>
                                          <tr>
                                              <th class="sicut-th">Total</th>
                                              <td>{{ $Datos["FactorPotenciaTotal"] }}</td>
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
                            <button class="btn btn-primary" id="SicutExportarExcel" disabled>Exportar a Excel</button>
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

    function restaFechas(f1,f2){
       var aFecha1 = f1.split('-');
       var aFecha2 = f2.split('-');
       var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]);
       var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]);
       var dif = fFecha2 - fFecha1;
       var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
       return dias;
   }

    function GraficarSicutPersonalizado(url) {

      var val=0;
      if ($("#FechaEscoger").val()=="0") {
        alert("Debes escoger un periodo de tiempo a graficar");
        val++;
      }

      if ($("#FechaEscoger").val()=="Personalizado") {
          if ($("#datetimesubmodal").val()>$("#datetimesubmodal2").val() || $("#datetimesubmodal").val()==0 || $("#datetimesubmodal2").val()==0) {
            alert("Debes Escoger una feca valida");
            val++;
          } else{
            var Horas = ((restaFechas($("#datetimesubmodal").val(), $("#datetimesubmodal2").val()))+1)*24;
          }
        }

      if ($("#FechaEscoger").val()!="Personalizado") {
        var Horas = $("#FechaEscoger").val();
      } 

      if ($("#DatoEscoger").val()=="0") {
          alert("Debes escoger un dato a graficar");
          val++;
        } 

        if (val==0) {
          var dat=parseInt($("#DatoEscoger").val())-1;
          if (parseInt($("#DatoEscoger").val())>=3) {
            dat=dat+2;
          }
          $("#sicut-loading"+$("#DatoEscoger").val()).css("display", "block");

          $(".div-chart"+$("#DatoEscoger").val()).empty();
          $(".div-chart"+$("#DatoEscoger").val()).html('<canvas id="myChart'+dat+'"  height="100"></canvas>');


          $("#SicutContenedor"+$("#DatoEscoger").val()).load(url+"/GraficoSigutIgnis"+$("#DatoEscoger").val(),{
              HorasTotales: Horas
          })
        }

    }

    $( "#FechaEscoger" )
  .change(function () {
    var str = "";
    $( "#FechaEscoger option:selected" ).each(function() {
      str += $( this ).text();
    });
    if (str=="Personalizado") {
      $(".InputFecha").css("display", "block");
    } else {
      $(".InputFecha").css("display", "none");      
    }
  })
  .change();


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