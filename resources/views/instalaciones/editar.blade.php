
@include('header');

<style>
  .consulta-alarma{
    margin-top: 120px;
  }
</style>
<?php

if (!isset($_GET["m"])) {
	$_GET["m"] = 0;
}

?>
@if ($_GET["m"]==1)
	
	<script>
			swal("Listo", "Instalacion registrada correctamente", "success");
	</script>

@endif

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
                        <div class="body">

                        <div class="body table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Modelo Equipo</th>
                                        <th>Numero Serie</th>
                                        <th>Tabla Asociada</th>
                                        <th>Controlador</th>
                                        <th>Latitud</th>
                                        <th>Longitud</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach($Instalaciones as $Instalacion)
                                    <tr>
                                        <th>{{ $Instalacion->nombre }}</th>
                                        <td>{{ $Instalacion->modelo_equipo }}</td>
                                        <td>{{ $Instalacion->numero_serie }}</td>
                                        <td>{{ $Instalacion->tabla_asociada }}</td>
                                        <th>{{ $Instalacion->controlador }}</th>
                                        <td>{{ $Instalacion->latitud }}</td>
                                        <td>{{ $Instalacion->longitud }}</td>
                                        <td><button class="btn btn-block btn-primary" onclick="EditarInstalacion('{{$Instalacion->id}}','{{$Instalacion->nombre}}', '{{$Instalacion->modelo_equipo}}','{{$Instalacion->numero_serie}}','{{$Instalacion->tabla_asociada}}', '{{$Instalacion->controlador}}','{{$Instalacion->latitud}}','{{$Instalacion->longitud}}')">Editar</button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    	function EditarInstalacion(id_instalacion, nombre_instalacion, nombre_equipo, numero_serie, tabla_asociada, controlador, latitud, longitud) {


    		$("#nombre_instalacion").val("Epaleeeeee");


    		$("#modal_editar").click();
    	}
    </script>


    <button type="button" id="modal_editar" class="btn btn-default waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal" style="display: none">Editar</button>


    <div class="modal fade in" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            <form action="RegistarInstalacion2" method="post">
                        		<input type="hidden" name="_token" value="eFpHO7bUZj6znDkLpOlrA51WjPwQegwE4uh7EBC7">	                        	<div class="row clearfix">
	                                <div class="col-sm-3">
	                                    <div class="form-group">
	                                        <div class="form-line">
	                                            <input type="text" id="nombre_instalacion" name="nombre_instalacion" class="form-control" placeholder="Nombre de Instalacion" value="Epale el mio">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-sm-3">
	                                    <div class="form-group">
	                                        <div class="form-line">
	                                            <input type="text" id="modelo_equipo" name="modelo_equipo" class="form-control" placeholder="Modelo de Equipo">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-sm-3">
	                                    <div class="form-group">
	                                        <div class="form-line">
	                                            <input type="text" id="numero_serie" name="numero_serie" class="form-control" placeholder="Numero de Serie">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-sm-3">
	                                    <div class="form-group">
	                                        <div class="form-line">
	                                            <input type="text" id="tabla_asociada" name="tabla_asociada" class="form-control" placeholder="Tabla Asociada">
	                                        </div>
	                                    </div>
	                                </div>
	                          </div>
	                          <div class="row clearfix">
	                                <div class="col-sm-4">
	                                    <div class="form-group">
	                                        <div class="form-line">
	                                            <input type="text" id="controlador" name="controlador" class="form-control" placeholder="Controlador">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-sm-4">
	                                    <div class="form-group">
	                                        <div class="form-line">
	                                            <input type="text" id="latitud" name="latitud" class="form-control" placeholder="Latitud">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-sm-4">
	                                    <div class="form-group">
	                                        <div class="form-line">
	                                            <input type="text" id="longitud" name="longitud" class="form-control" placeholder="Longitud">
	                                        </div>
	                                    </div>
	                                </div>
	                          </div>
	                          <div class="row clearfix">
	                          	<input type="submit" class="btn btn-danger btn-block" value="Añadir instalacion">
	                          </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>







    @include("footer");