
@include('header');

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
                <h2>NORMAL TABLES</h2>
            </div>
            <!-- Basic Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                BASIC TABLES
                                <small>Basic example without any additional modification classes</small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
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
                                	@foreach($Datos as $Dato)
                                    <tr>
                                        <th>{{ $Dato->nombre }}</th>
                                        <td>{{ $Dato->alarma_intervalo }}</td>
                                        <td><button class="btn btn-primary" onclick="EditarIntervalo('<?php echo $Dato->id; ?>')">Editar</button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <form action="RegistrarIntervaloAlarma" method="post">
        @csrf
        <input type="hidden" id="intervalo" name="Intervalo">
        <input type="hidden" id="IdInstalacion" name="IdInstalacion">
        <input style="display: none;" type="submit" id="RegistrarIntervalo">
    </form>

    <script>
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