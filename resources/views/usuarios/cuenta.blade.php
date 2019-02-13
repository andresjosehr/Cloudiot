
    <link rel="stylesheet" href="css/custom/home.css">

    @include('header');

    @include('loader.index');

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