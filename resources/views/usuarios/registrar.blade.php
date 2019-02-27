    @include('header');

    @include('top_menu');

    @include('sidebar');

<section class="content">
        <div class="container-fluid">
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Registrar Usuario
                                <small>Para registrar un usuario, debes hacer click al boton de abajo el cual genera un link de registro de usuario para ser enviado a la persona que tendra acceso al sistema para que pueda completar sus datos</small>
                            </h2>
                            <div id="reg_usuario"></div>
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
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="email" class="form-control"  placeholder="Escribe el email del Usuario a registrar" id="email_user" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <button type="button" class="btn bg-red btn-block btn-lg waves-effect btn-block" onclick="RegistrarUsuario('<?php echo Request::root() ?>/PreRegistro');">Registrar usuario</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            Usuarios sin haber completado su registro:
                            <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Email</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
{{--                                     <tr>
                                        <th scope="row">5</th>
                                        <td>Larry</td>
                                        <td>Kikat</td>
                                        <td>@lakitkat</td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
        </div>
    </section>


	@include("footer");