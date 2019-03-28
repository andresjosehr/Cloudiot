<button type="button" class="btn btn-default waves-effect m-r-20 display-modal vina-modal" data-toggle="modal" data-target="#largeModal">
</button>
<!-- Large Size -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg vina-modal-dialog" role="document">
        <div class="modal-content">
            <p id="contenedorLFE1"></p>
            <p id="contenedorLFE2"></p>
            <p id="contenedorLFE3"></p>
            <p id="contenedorLFE4"></p>
            <div id="contenedorLFESub"></div>
            <div class="modal-header">
                <p id="contenedorLFE"></p>
                <div class="row">
                    <div class="col-md-4">
                        <h4 class="modal-title vina-nombre-instalacion" id="largeModalLabel">{{ $Instalacion->nombre }}</h4>
                    </div>
                    <div class="col-md-4">
                        <h4 class="modal-title vina-nombre-instalacion" id="largeModalLabel">Última Mendición {{ $UltimaMedicion->mt_time }}</h4>
                    </div>
                </div>
                <div id="MostrarRelojes"></div>
                <div id="MostrarEntrada1"></div>
                <div id="MostrarEntrada2"></div>
                <div id="MostrarEntrada3"></div>
                <div id="MostrarSalida1"></div>
                <div id="MostrarSalida2"></div>
                <div id="MostrarSalida3"></div>
            </div>
            <div class="body">
            </div>
            <hr class="vina-hr">
            <div class="modal-body vina-table-custom">
                <ul class="nav nav-tabs tab-nav-right" role="tablist">
                    <li role="presentation" class="active"><a href="#home" data-toggle="tab">Panel de control</a></li>
                    <li role="presentation"><a href="#flujos" data-toggle="tab">Vista de Flujos</a></li>
                    <li role="presentation" id="GraficarPHDiario"><a href="#PHDiarios" data-toggle="tab">Vista de PH diarios</a></li>
                    <li role="presentation" id="GraficarORPDiario"><a href="#ORPDiarios" data-toggle="tab">Vista de ORP diarios</a></li>
                    <li role="presentation" id="GraficarConductividadDiario"><a href="#ConductividadDiarios" data-toggle="tab">Vista de Conductividad Diarios</a></li>
                    @if ($Rol!=5)
                    <li role="presentation" id="parametros"><a href="#profile" data-toggle="tab">Parametros de Configuracion</a></li>
                    @endif
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="home">
                        <div>
                            <div class="row">
                              <div id="MostrarBombas">
                              </div>
                            <div class="col-md-6">
                                <canvas id="myChart0" height="50"></canvas>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <p align="center"><b>PH</b></p>
                                            <div class="col-md-12" id="rpm-0">
                                                <div class="vina-loading"></div>
                                                <b class="vina-vertical">Entrada</b>
                                                <div>
                                                    <img src="images/rpm.png" class="img-rpm-lfe">
                                                    <canvas id="gauge0"></canvas>
                                                </div>
                                            </div>
                                            <div class="col-md-12 chart-lfe" id="chart-lfe1">
                                                <div class="vina-loading"></div>
                                                <img class="vina-cargando  img-chart-lfe" src="images/chart.png" class="img-rpm-lfe">
                                                <canvas id="myChart1" height="140"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <p><b align="center">ORP</b></p>
                                            <div class="col-md-12" id="rpm-1">
                                                <div class="vina-loading"></div>
                                                <div>
                                                    <img src="images/rpm.png" class="img-rpm-lfe">
                                                    <canvas id="gauge1"></canvas>
                                                </div>
                                            </div>
                                            <div class="col-md-12 chart-lfe" id="chart-lfe2">
                                                <div class="vina-loading"></div>
                                                <img class="vina-cargando  img-chart-lfe" src="images/chart.png" class="img-rpm-lfe">
                                                <canvas id="myChart2" height="140"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <p align="center"><b>Conductividad</b></p>
                                            <div class="col-md-12" id="rpm-2">
                                                <div class="vina-loading"></div>
                                                <div>
                                                    <img src="images/rpm.png" class="img-rpm-lfe">
                                                    <canvas id="gauge2"></canvas>
                                                </div>
                                            </div>
                                            <div class="col-md-12 chart-lfe" id="chart-lfe3">
                                                <div class="vina-loading"></div>
                                                <img class="vina-cargando  img-chart-lfe" src="images/chart.png" class="img-rpm-lfe">
                                                <canvas id="myChart3" height="140"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row vina-row-rpm">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12" id="rpm-3">
                                                <b class="vina-vertical">Salida</b>
                                                <div class="vina-loading"></div>
                                                <div>
                                                    <img src="images/rpm.png" class="img-rpm-lfe">
                                                    <canvas id="gauge3"></canvas>
                                                </div>
                                            </div>
                                            <div class="col-md-12 chart-lfe" id="chart-lfe4">
                                                <div class="vina-loading"></div>
                                                <img class="vina-cargando  img-chart-lfe" src="images/chart.png" class="img-rpm-lfe">
                                                <canvas id="myChart4" height="140"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12" id="rpm-4">
                                                <div class="vina-loading"></div>
                                                <div>
                                                    <img src="images/rpm.png" class="img-rpm-lfe">
                                                    <canvas id="gauge4"></canvas>
                                                </div>
                                            </div>
                                            <div class="col-md-12 chart-lfe" id="chart-lfe5">
                                                <div class="vina-loading"></div>
                                                <img class="vina-cargando  img-chart-lfe" src="images/chart.png" class="img-rpm-lfe">
                                                <canvas id="myChart5" height="140"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12" id="rpm-5">
                                                <div class="vina-loading"></div>
                                                <div>
                                                    <img src="images/rpm.png" class="img-rpm-lfe">
                                                    <canvas id="gauge5"></canvas>
                                                </div>
                                            </div>
                                            <div class="col-md-12 chart-lfe" id="chart-lfe6">
                                                <div class="vina-loading"></div>
                                                <img class="vina-cargando  img-chart-lfe" src="images/chart.png" class="img-rpm-lfe">
                                                <canvas id="myChart6" height="140"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                <div role="tabpanel" class="tab-pane fade" id="profile">
                    <div id='parametros-ejecucion'></div>
                    <div id='parametros-index'></div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="PHDiarios">
                    <div id="PHDiarioContenedor"></div>
                    <div class="row">
                        <div id="contenedorLFE2"></div>
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="fecha_ph_inicio" class="datetimepicker form-control" placeholder="Fecha Inicio">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="fecha_ph_fin" class="datetimepicker form-control" placeholder="Fecha Fin">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button onclick="GraficarphPersonalizado('<?php echo Request::root() ?>/CalculosLuisFelipe8');" type="button" class="btn btn-primary waves-effect">→</button>
                        </div>
                    </div>
                    <div class="vina-vina-loadingPH"></div>
                    <div id="ph-bar-chart-div">
                        <canvas id="ph-bar-chart" width="400" height="70"></canvas>
                    </div>
                    <div class="BotonExportarPHDiarios vina-BotonExportarPHDiarios">
                        <a onclick="DescargarExcelPH()" class="btn btn-primary">Exportar datos a Excel</a>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="ORPDiarios">
                    <div id="ORPDiarioContenedor"></div>
                    <div class="row">
                        <div id="contenedorLFE2"></div>
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="fecha_orp_inicio" class="datetimepicker form-control" placeholder="Fecha Inicio">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="fecha_orp_fin" class="datetimepicker form-control" placeholder="Fecha Fin">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button onclick="GraficarORPPersonalizado('<?php echo Request::root() ?>/CalculosLuisFelipe10');" type="button" class="btn btn-primary waves-effect">→</button>
                        </div>
                    </div>
                    <div class="vina-loadingORP"></div>
                    <div id="orp-bar-chart-div">
                        <canvas id="orp-bar-chart" width="400" height="70"></canvas>
                    </div>
                    <div class="BotonExportarORPDiarios vina-BotonExportarORPDiarios">
                        <a onclick="DescargarExcelORP()" class="btn btn-primary">Exportar datos a Excel</a>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="ConductividadDiarios">
                    <div id="ConductividadDiarioContenedor"></div>
                    <div class="row">
                        <div id="contenedorLFE2"></div>
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="fecha_conductividad_inicio" class="datetimepicker form-control" placeholder="Fecha Inicio">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="fecha_conductividad_fin" class="datetimepicker form-control" placeholder="Fecha Fin">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button onclick="GraficarConductividadPersonalizado('<?php echo Request::root() ?>/CalculosLuisFelipe12');" type="button" class="btn btn-primary waves-effect">→</button>
                        </div>
                    </div>
                    <div class="vina-loadingConductividad"></div>
                    <div id="conductividad-bar-chart-div">
                        <canvas id="conductividad-bar-chart" width="400" height="70"></canvas>
                    </div>
                    <div class="BotonExportarConductividadDiarios vina-BotonExportarConductividadDiarios">
                        <a onclick="DescargarExcelConductividad()" class="btn btn-primary">Exportar datos a Excel</a>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="flujos">
                    <div id="contenedorFlujos"></div>
                    <div class="row">
                        <div id="contenedorLFE2"></div>
                        <div class="col-md-2">
                            {{--
                            <p class="modal-title" id="defaultModalLabel">Flujos</p> --}}
                        </div>
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="fecha_flujo_inicio" class="datetimepicker form-control" placeholder="Fecha Inicio">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="fecha_flujo_fin" class="datetimepicker form-control" placeholder="Fecha Fin">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button onclick="GraficarFlujoPersonalizado('<?php echo Request::root() ?>/CalculosLuisFelipe4');" type="button" class="btn btn-primary waves-effect">→</button>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div id="flujo-bar-chart-div1">
                            <canvas id="flujo-bar-chart1" width="400" height="40"></canvas>
                        </div>
                        <div class="col-md-12" style="padding-top: 50px">
                            <div id="flujo-bar-chart-div2">
                                <canvas id="flujo-bar-chart2" width="400" height="40"></canvas>
                            </div>
                            <div class="vina-DescargarExcelFlujosDiarios-padre">
                                <a onclick="DescargarExcelFlujos()" class="btn btn-primary">Exportar datos a Excel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar ventana</button>
            </div>
        </div>
    </div>
</div>

<script src="instalaciones/VinaLuisFelipe.js"></script>
<script>
    GraficarPHDiario("<?php echo Request::root() ?>/CalculosLuisFelipe7");
    GraficarORPDiario("<?php echo Request::root() ?>/CalculosLuisFelipe9");
    GraficarConductividadDiario("<?php echo Request::root() ?>/CalculosLuisFelipe11");
    GraficarFlujos("<?php echo Request::root() ?>/CalculosLuisFelipe13")
    ConsultarParametros("<?php echo Request::root() ?>/CalculosLuisFelipe14")
    MostrarBombas("<?php echo Request::root() ?>/CalculosLuisFelipe15")
    MostrarRelojes("<?php echo Request::root() ?>/CalculosLuisFelipe16", <?php echo json_encode($Instalacion); ?>);

    MostrarEntrada1("<?php echo Request::root() ?>/CalculosLuisFelipe17", <?php echo json_encode($Instalacion); ?>);
    MostrarEntrada2("<?php echo Request::root() ?>/CalculosLuisFelipe18", <?php echo json_encode($Instalacion); ?>);
    MostrarEntrada3("<?php echo Request::root() ?>/CalculosLuisFelipe19", <?php echo json_encode($Instalacion); ?>);
    MostrarSalida1("<?php echo Request::root() ?>/CalculosLuisFelipe20", <?php echo json_encode($Instalacion); ?>);
    MostrarSalida2("<?php echo Request::root() ?>/CalculosLuisFelipe21", <?php echo json_encode($Instalacion); ?>);
    MostrarSalida3("<?php echo Request::root() ?>/CalculosLuisFelipe22", <?php echo json_encode($Instalacion); ?>);

    $("#ListarBombas").click(function() {
        ListarBombas("<?php echo Request::root() ?>/CalculosLuisFelipe5");
    });

    $("#gauge0").click(function() {
        var url = "<?php echo Request::root() ?>/CalculosLuisFelipe2";
        $("#contenedorLFE").load(url, {
            dato: "0"
        });
        $(".loader-insta").css("display", "block");
    });

    $("#gauge1").click(function() {
        var url = "<?php echo Request::root() ?>/CalculosLuisFelipe2";
        $("#contenedorLFE").load(url, {
            dato: "1"
        });
        $(".loader-insta").css("display", "block");
    });

    $("#gauge2").click(function() {
        var url = "<?php echo Request::root() ?>/CalculosLuisFelipe2";
        $("#contenedorLFE").load(url, {
            dato: "2"
        });
        $(".loader-insta").css("display", "block");
    });

    $("#gauge3").click(function() {
        var url = "<?php echo Request::root() ?>/CalculosLuisFelipe2";
        $("#contenedorLFE").load(url, {
            dato: "3"
        });
        $(".loader-insta").css("display", "block");
    });

    $("#gauge4").click(function() {
        var url = "<?php echo Request::root() ?>/CalculosLuisFelipe2";
        $("#contenedorLFE").load(url, {
            dato: "4"
        });
        $(".loader-insta").css("display", "block");
    });

    $("#gauge5").click(function() {
        var url = "<?php echo Request::root() ?>/CalculosLuisFelipe2";
        $("#contenedorLFE").load(url, {
            dato: "5"
        });
        $(".loader-insta").css("display", "block");
    });
</script>