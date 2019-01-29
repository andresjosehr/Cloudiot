
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
                        <div class="body">

                        	<form action="RegistarInstalacion2" method="post">
                        		@csrf
	                        	<div class="row clearfix">
	                                <div class="col-sm-3">
	                                    <div class="form-group">
	                                        <div class="form-line">
	                                            <input type="text" name="nombre_instalacion" class="form-control" placeholder="Nombre de Instalacion">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-sm-3">
	                                    <div class="form-group">
	                                        <div class="form-line">
	                                            <input type="text" name="modelo_equipo" class="form-control" placeholder="Modelo de Equipo">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-sm-3">
	                                    <div class="form-group">
	                                        <div class="form-line">
	                                            <input type="text" name="numero_serie" class="form-control" placeholder="Numero de Serie">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-sm-3">
	                                    <div class="form-group">
	                                        <div class="form-line">
	                                            <input type="text" name="tabla_asociada" class="form-control" placeholder="Tabla Asociada">
	                                        </div>
	                                    </div>
	                                </div>
	                          </div>
	                          <div class="row clearfix">
	                                <div class="col-sm-4">
	                                    <div class="form-group">
	                                        <div class="form-line">
	                                            <input type="text" name="controlador" class="form-control" placeholder="Controlador">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-sm-4">
	                                    <div class="form-group">
	                                        <div class="form-line">
	                                            <input type="text" name="latitud" class="form-control" placeholder="Latitud">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-sm-4">
	                                    <div class="form-group">
	                                        <div class="form-line">
	                                            <input type="text" name="longitud" class="form-control" placeholder="Longitud">
	                                        </div>
	                                    </div>
	                                </div>
	                          </div>
	                          <div class="row clearfix">
	                          	<input type="submit" class="btn btn-danger btn-block" value="Añadir instalacion"></button>
	                          </div>
                          </form>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </section>







    @include("footer");