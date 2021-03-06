    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar" style="margin-top: -8px;">
            <!-- User Info -->
            <div class="user-info" style="background-image: url({{ asset('/images/user-img-background.jpg') }});">
                <div style="text-align: center;">
                    <img src="http://www.proyex.cl/wp-content/uploads/2018/03/logo__menu_somb.png" style="width: 60%" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $Usuario->name }}</div>
                    <div class="email">{{ $Usuario->email }}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i style="margin-top: -42px;" class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="Cuenta"><i class="material-icons">person</i>Cuenta</a></li>
{{--                             <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li> --}}
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">Instalaciones Asignadas</li>
                    <li>
                            <a href="panel-de-control" class=" waves-effect waves-block">
                                <i class="material-icons">home</i>
                                <span>Panel de control</span>
                            </a>
                        </li>
                        @if ($Usuario->rol==1)
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">person_pin</i>
                                <span>Usuarios</span>
                            </a>
                            <ul class="ml-menu">
                                <li>
                                    <a href="registrar-usuario/">
                                        <span>Registrar Usuario</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>Lista de Usuarios</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">location_city</i>
                                <span>Instalaciones</span>
                            </a>
                            <ul class="ml-menu">
                                <li>
                                    <a href="RegistrarInstalacion">
                                        <span>Registrar Instalacion</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="EditarInstalacion">
                                        <span>Editar Instalaciones</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="Alarmas">
                                        <span>Alarmas</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @if (Request::segment(1)=="panel-de-control")
                        <?php $i=0; ?>
                            @foreach($Instalaciones as $Instalacion)
                                <a id="EsteEsMiID_<?php echo $i; ?>" >
                                  <span>{{ $Instalacion->nombre }}</span>
                                </a>
                                <?php $i++; ?>
                            @endforeach
                            <div class="instalaciones-boton">
                                <?php $i=0; ?>
                                @foreach($Instalaciones as $Instalacion)
                                    <button id="instalacion_boton_{{$i}}"></button>
                                    <?php $i++; ?>
                                @endforeach
                            </div>
                        @endif

                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2019<a href="javascript:void(0);"> Cloudiot</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>