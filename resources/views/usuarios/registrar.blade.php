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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="email" class="form-control"  placeholder="Escribe el email del Usuario a registrar" id="email_user" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line reg_usr_multiselect">
                                           <select class="selectpicker" id="instalaciones_asignadas" multiple>
                                            @foreach($Instalaciones as $Instalacion)
                                              <option value="{{$Instalacion->id}}">{{$Instalacion->nombre}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <button type="button" class="btn bg-red btn-block btn-lg waves-effect btn-block" onclick="RegistrarUsuario('<?php echo Request::root() ?>/PreRegistro');">Registrar usuario</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            Usuarios sin haber completado su registro:
                            <div class="body table-responsive">
                            <table class="table" id="pending_user">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($UsuariosTemp as $UsuarioTemp)
                                    <tr id="{{$UsuarioTemp->key}}">
                                        <td id='email_temp'>{{$UsuarioTemp->email}}</td>
                                        <td><button class='btn btn-danger' onclick="EliminarUserTemp('<?php echo $UsuarioTemp->email ?>', '{{$UsuarioTemp->key}}', '<?php echo Request::root() ?>/BorrarPreRegistro')">Eliminar</button></td>
                                    </tr>
                                    @endforeach
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