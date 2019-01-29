
@include('header');

<style>
  .consulta-alarma{
    margin-top: 120px;
  }
</style>

<!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    @include('top_menu');

    @include('sidebar');


	<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Alarmas</h2>
            </div>
            <!-- Basic Table -->
            <div class="row clearfix" style="margin-bottom: -16px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Alarmas de instalacion
                                <small>Consulta las alarmas registradas en la aplicacion</small>
                            </h2>
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombre de Instalacion</th>
                                        <th>Intervalo de consulta</th>
                                        <th>Editar intervalo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($DatosInstalacion as $DatoInstalacion)
                                    <tr>
                                        <th>{{ $DatoInstalacion->nombre }}</th>
                                        <td>
                                            @for ($i = 0; $i <count($DatosAlarmas) ; $i++)
                                                @if($DatosAlarmas[$i]->id_instalacion==$DatoInstalacion->id && $DatosAlarmas[$i]->tipo=="1")
                                                {{ $DatosAlarmas[$i]->valor}}
                                                @endif
                                            @endfor
                                        </td>
                                        @for ($i = 0; $i <count($DatosAlarmas) ; $i++)
                                          @if($DatosAlarmas[$i]->id_instalacion==$DatoInstalacion->id)
                                             <?php $id = $DatosAlarmas[$i]->id ?>
                                          @endif
                                        @endfor
                                        <td><button class="btn btn-primary" onclick="EditarIntervalo('<?php echo $id; ?>')">Editar</button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Añadir Alarma
                                <small>Crea alarmas de datos individuales por aplicacion</small>
                            </h2>
                        </div>
                        <div class="body table-responsive">
                          <div class="row clearfix">
                          <div class="col-md-3">
                            <select class="form-control show-tick" id="instalacion">
                                <option value="">-- Instalacion --</option>
                                @foreach($DatosInstalacion as $DatoInstalacion)
                                  <option value="{{$DatoInstalacion->id}}">{{$DatoInstalacion->nombre}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="mt_name" id="mt_name" />
                                </div>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <select class="form-control show-tick" id="operador">
                                <option value="">-- Operador --</option>
                                <option value="<">Menor</option>
                                <option value="<=">Menor o igual </option>
                                <option value="==">Igual </option>
                                <option value="!=">Distinto </option>
                                <option value=">">Mayor </option>
                                <option value=">=">Mayor o igual </option>
                            </select>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="valor" placeholder="Valor" />
                                </div>
                            </div>
                          </div>
                        </div>
                          <div class="col-md-12">
                            <button class="btn btn-block btn-primary" onclick="RegistrarDatoAlarma()">Añadir</button>
                          </div>
                          <div class="header consulta-alarma">
                            <h2>
                                Consulta las alarmas
                                <small>Consulta la tabla de alarmas creadas</small>
                            </h2>
                          </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombre de Instalacion</th>
                                        <th>mt_name</th>
                                        <th>Operador</th>
                                        <th>Valor</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($DatosAlarmas as $DatoAlarma)
                                      @if ($DatoAlarma->tipo==2)
                                          <tr>
                                              <td>
                                                @for ($i = 0; $i <count($DatosInstalacion) ; $i++)
                                                  @if ($DatoAlarma->id_instalacion==$DatosInstalacion[$i]->id)
                                                    {{$DatosInstalacion[$i]->nombre}}
                                                    @php
                                                      $PosicionInstalacion=$i+1;
                                                      $NombreInstalacion = $DatosInstalacion[$i]->nombre;
                                                    @endphp
                                                  @endif
                                                @endfor
                                              </td>
                                              <td>{{$DatoAlarma->mt_name}}</td>
                                              <td>{{$DatoAlarma->operador}}</td>
                                              <td>{{$DatoAlarma->valor}}</td>
                                              <td><button onclick="EditarDatoAlarma('{{$DatoAlarma->id}}','{{$DatoAlarma->id_instalacion}}','{{$DatoAlarma->mt_name}}','{{$DatoAlarma->operador}}','{{$DatoAlarma->valor}}','{{$PosicionInstalacion}}','{{$NombreInstalacion}}')">Editar</button></td>
                                          </tr>
                                      @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>

    <button style="display: none" id="EditarDatoAlarma" type="button" class="btn btn-default waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal">MODAL - DEFAULT SIZE</button>

    <form action="RegistrarIntervaloAlarma" method="post">
        @csrf
        <input type="hidden" id="intervalo" name="Intervalo">
        <input type="hidden" id="IdInstalacion" name="IdInstalacion">
        <input style="display: none;" type="submit" id="RegistrarIntervalo">
    </form>

    <form action="RegistrarDatoAlarma" method="post">
        @csrf
        <input type="hidden" name="IdInstalacion" id="dato1">
        <input type="hidden" name="mt_name" id="dato2">
        <input type="hidden" name="operador" id="dato3">
        <input type="hidden" name="valor" id="dato4">

        <input value="RegistrarDato" type="submit" id="RegistrarDato">
    </form>


    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document" style="margin-top: 200px;width: 70%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row clearfix">
                          <div class="col-md-3" id="editar-instalacion">
                            <select class="form-control show-tick" id="update-instalacion">
                                <option value="0">-- Instalacion --</option>
                                @foreach($DatosInstalacion as $DatoInstalacion)
                                  <option value="{{$DatoInstalacion->id}}">{{$DatoInstalacion->nombre}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="mt_name" id="editar-mt_name" />
                                </div>
                            </div>
                          </div>
                          <div class="col-md-3" id="editar-operador">
                            <select class="form-control show-tick" id="update-operador">
                                <option value="">-- Operador --</option>
                                <option value="<">Menor</option>
                                <option value="<=">Menor o igual </option>
                                <option value="==">Igual </option>
                                <option value="!=">Distinto </option>
                                <option value=">">Mayor </option>
                                <option value=">=">Mayor o igual </option>
                            </select>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="editar-valor" placeholder="Valor" />
                                </div>
                            </div>
                          </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" onclick="UpdateAlarma()">Guardar Cambios</button>
                        </div>
                    </div>
                </div>
            </div>
            <form action="EditarDatoAlarma" method="post">
              @csrf
              <input type="hidden" id="id_alarma"     name="id_alarma">
              <input type="hidden" id="e_instalacion" name="id_instalacion">
              <input type="hidden" id="e_mt_name"     name="mt_name">
              <input type="hidden" id="e_operador"    name="operador">
              <input type="hidden" id="evalor"        name="valor">
              <input type="submit" style="display: none;" id="SubmitEditarDato">
            </form>

    <script>
      function UpdateAlarma() {

        var updateinstalacion = document.getElementById('update-instalacion').value;
        var editarmt_name = document.getElementById('editar-mt_name').value;
        var updateoperador = document.getElementById('update-operador').value;
        var editarvalor = document.getElementById('editar-valor').value;

        document.getElementById('e_instalacion').value =   updateinstalacion;
        document.getElementById('e_mt_name').value     =   editarmt_name;
        document.getElementById('e_operador').value    =   updateoperador;
        document.getElementById('evalor').value        =   editarvalor;

        $("#SubmitEditarDato").click();


      }
      function EditarDatoAlarma(id_alarma, id_instalacion, mt_name, operador, valor, PosicionInstalacion, NombreInstalacion) {

        document.getElementById('update-instalacion').value=id_instalacion;
        $("#editar-instalacion li:nth-child(1)").removeClass("selected");
        $("#editar-instalacion .filter-option").empty();
        $("#editar-instalacion .filter-option").text(NombreInstalacion);

        document.getElementById('editar-mt_name').value=mt_name;

        document.getElementById('update-operador').value=operador;
        $("#editar-operador .filter-option").empty();
        $("#editar-operador .filter-option").text($("#update-operador option[value='"+operador+"']").text());


        console.log($('#editar-operador select[value="'+operador+'"]').text());

        document.getElementById('editar-valor').value=valor;

        document.getElementById('id_alarma').value=id_alarma;

        $("#EditarDatoAlarma").click()
      }


      function RegistrarDatoAlarma() {
           
           var IdInstalacion=document.getElementById('instalacion').value;
           var mt_name=document.getElementById('mt_name').value;
           var operador=document.getElementById('operador').value;
           var valor=document.getElementById('valor').value;

           document.getElementById('dato1').value=IdInstalacion;
           document.getElementById('dato2').value=mt_name;
           document.getElementById('dato3').value=operador;
           document.getElementById('dato4').value=valor;

           
            $("#RegistrarDato").click();

      }
    	function EditarIntervalo(id_instalacion) {

    		swal({
              text: 'Escribe el intervalo de tiempo en minutos',
              content: "input"
            })
                .then(name =>{
                    document.getElementById('intervalo').value = name;
                    document.getElementById('IdInstalacion').value = id_instalacion;
                    console.log(document.getElementById('IdInstalacion').value);
                    $("#RegistrarIntervalo").click();

                });
    	}
    </script>







    @include("footer");