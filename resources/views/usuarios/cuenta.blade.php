{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

    <link rel="stylesheet" href="css/custom/home.css">

    @include('header');

    @include('loader.index');


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

   <section class="content mapa-content">
        <div class="container-fluid">
            <!-- Basic Table -->
            <div class="row clearfix" style="margin-bottom: -16px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Cuenta
                                <small>Revisa y edita los datos de tu cuenta</small>
                            </h2>
                        </div>
                        <div class="body">
                          <h1 id="cuentaconte"></h1>
                          <h2 class="card-inside-title">Cambia tu contraseña</h2>
                          <div class="row clearfix">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" class="form-control" id="pass1" placeholder="Escribe tu contraseña">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" class="form-control" id="pass2" placeholder="Repite tu contraseña">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <button onclick="CambiarContraseña();" id="btn_cambiar" class="btn btn-primary btn-block">Cambiar Contraseña</button>
                                    <div class="loadingg"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
      
      function CambiarContraseña() {
        $.ajaxSetup({
       headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
      });
      pass1=document.getElementById('pass1').value;
      pass2=document.getElementById('pass2').value;

      if (pass1=="" || pass2=="") {
        swal("Espera!", "Debes llenar los dos campos de contraseña", "warning");
      } else{
        if (pass1!=pass2) {

          swal("Espera!", "Las contraseñas no concuerdan", "warning");

        } else{

          $(".loadingg").css("display", "block");
      $("#btn_cambiar").css("display", "none");

          var url = "<?php echo Request::root() ?>/CambiarContrasena";

          $("#cuentaconte").load(url, {pass1: pass1, pass2: pass2});

        }

      }
    }</script>

    <style>
         .loadingg{
         width: 35px;
         height: 35px;
         border-radius:150px;
         border:6px solid #797979;
         border-top-color:rgba(0,0,0,0.3);
         box-sizing:border-box;
         position:absolute;
         top: 72px;
         left: 64%;
         margin-top:-80px;
         margin-left:-80px;
         animation:loading 1.2s linear infinite;
         -webkit-animation:loading 1.2s linear infinite;
         z-index: 1;
         display: none;
         }
         @keyframes loading{
         0%{transform:rotate(0deg)}
         100%{transform:rotate(360deg)}
         }
         @-webkit-keyframes loading{
         0%{-webkit-transform:rotate(0deg)}
         100%{-webkit-transform:rotate(360deg)}
         }
    </style>


    @include("footer");