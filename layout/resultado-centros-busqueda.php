 <?php
session_start();

if (isset($_GET["deporte"])) {
    $_SESSION["deporte"] = $_GET["deporte"];
    $_SESSION["ciudad"] = $_GET["provincia"];
} else {
    $_SESSION["deporte"] = $_POST["deportes-browser"];
    $_SESSION["ciudad"] = $_POST["ciudades-browser"];
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Gospo</title>
        <!-- FAVICON -->
        <link rel="icon" type="image/png" href="../resources/img/favicon.png" />
        <!-- MDB -->
        <link href="../vendor/mdb/css/mdb.min.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- Jquery User Interface-->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <!-- Custom Google Maps Style -->
        <link href="../styles/css/google_maps.css" rel="stylesheet" type="text/css"/>
        <!-- Pickadate -->
        <link href="../vendor/pickadate/themes/default.css" rel="stylesheet" type="text/css"/>
        <link href="../vendor/pickadate/themes/default.date.css" rel="stylesheet" type="text/css"/>
        <link href="../vendor/pickadate/themes/default.time.css" rel="stylesheet" type="text/css"/>
        <!-- Custom styles for this template -->
        <link href="../styles/css/index.css" rel="stylesheet" type="text/css"/> 
        <!-- Carro compra-->
        <link href="../styles/css/carro.css" rel="stylesheet" type="text/css"/>
        <!-- Your custom styles login --> 
        <link href="../styles/css/login_registro.css" rel="stylesheet">
    </head>
    <body>
        <script type="text/javascript"> console.log(document.referrer);</script>
        <!--Jquery and Jquery UI -->
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!-- Pickadate and Pickatime -->
        <script src="../vendor/pickadate/legacy.js" type="text/javascript"></script>
        <script src="../vendor/pickadate/picker.js" type="text/javascript"></script>
        <script src="../vendor/pickadate/picker.date.js" type="text/javascript"></script>
        <script src="../vendor/pickadate/picker.time.js" type="text/javascript"></script>
        <!-- Bootstrap core JavaScript -->
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- MDB -->
        <script src="../vendor/mdb/js/mdb.min.js" type="text/javascript"></script>
        <!-- Data picker -->
        <script src="../vendor/jquery/components/data_picker/data_picker.js" type="text/javascript"></script>
        <!-- Font Awesome -->
        <script src="../vendor/fontawesome/fontawesome-all.js" type="text/javascript"></script>
        <!-- Drag and drop -->
        <script src="../model/drag-drop/drag-drop.js" type="text/javascript"></script>
        <!-- Google Maps -->
        <?php include '../model/Maps/initMap-prueba.php'; ?>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiTt0JoSwwww7v-t8xbt_40Ph6MvxeTMY&callback=initMap">
        </script>
        <script src="../model/Maps/sideMaps/datosCentros.js" type="text/javascript"></script>
        <!-- Carro compra-->
        <script src="../model/cart/modal.js" type="text/javascript"></script>
        <!-- Effects-->
        <script src="../vendor/jquery/effects/slider.js" type="text/javascript"></script>
        <!-- LOGIN -->
        <script src="../model/login_registro/js/registro_rcb.js" type="text/javascript"></script>

        <div class="container-grid">
            <div class="header">
                <!-- Navigation -->
                <nav class="navbar navbar-expand-lg navbar-dark bg-main-header-custom fixed-top">
                    <div class="container">
                        <div class="navbar-brand">
                            <a href="../index.html"><img src="../resources/img/logo-3.PNG" alt=""/></a>
                        </div>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarResponsive">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="../index.html">Home
                                        <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="https://danialba96.wixsite.com/gospo">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Contact</a>
                                </li>
                                <li class="nav-item">
                                    <a id="abrir" class="nav-link btn btn-primary nav-login" href="#"><span class="nav-login-color">Log In</span></a>
                                </li>
                            </ul>
                            <button type="button" class=" nav-item__carro" data-toggle="modal" data-target="#Modal__carrito">
                                <i class="fab fa-opencart fa-lg"></i><span class="nav-item__carro__contador"></span>
                            </button>
                       <!--     <div><i class="fa fa-user-circle prefix"></i><span id="label-user" class=""> <?php if(isset($_SESSION['id_user_pag_principal'])){echo(" ".$_SESSION['usuario']);} ?> </span></div>
                            <div class="nav-item">
                            <a id="salir" class="nav-link nav-link-text" href="#">Log Out</a>
                            </div> -->
                        </div>
                    </div>
                </nav>
            </div>

            <div class="sidebar left_inner">
                <!-- El div de arria existe exclusivamente para el posicionamiento del resizer-->
                <div id="content_sidebar">
                    <h2 clas="conten_sidebar_title">Resultados</h2>
                    <div>
                        <input type="search" class="form-control" id="input-search" placeholder="Filtrar..." >
                    </div>
                    <!-- LAS TARJETAS DE BUSQUEDA -->
                    <div id="center-result" class="searchable-container">

                    </div>
                </div>
            </div>
            <div class="map-container">
                <div id="map" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
            </div>
        </div>
        <!-- Modal Carro-->
        <div class="modal fade right" id="Modal__carrito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg modal-right" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">RESERVAS</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <hr>
                    <div class="modal-body" id="carrito__contenido">

                    </div>
                    <hr>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-secondary-carro" data-dismiss="modal">Cerrar</button>
                        <button type="button" id="boton__vaciar" class="btn btn-secondary btn-secondary-carro">Vaciar</button>
                        <button type="button" id="boton__reservar" class="btn btn-primary btn-primary-carro">Reservar</button>
                    </div>
                </div>
            </div>
        </div> 
        <!-- Modal  repetido-->
        <div class="modal fade" id="reservaRepetida" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-side modal-top-left" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Reservas</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6> Esta pista ya esta añadida a tu lista</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-secondary-carro" data-dismiss="modal">Cerrar</button>

                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Compra realizada con exito-->
        <div class="modal fade" id="ReservaRealizada" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Reservas</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6>Compra realizada con exito</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-secondary-carro" data-dismiss="modal">Cerrar</button>

                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Realizar Pedido Reservas-->
        <div class="modal fade" id="Comprar-Reservas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-side modal-top-right" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Reservas</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6>¿Realizar la reserva y pago?</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-secondary-carro" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary boton--pagar-reservar btn-primary-carro">Reservar</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!--Modal: Login / Register Form-->
    <div  class="modal fade" id="modalLRForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog cascading-modal" role="document">
            <!--Content-->
            <div class="modal-content">

                <!--Modal cascading tabs-->
                <div class="modal-c-tabs">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs tabs-2 light-blue darken-3" role="tablist">
                        <li class="nav-item">
                            <a id="tablogin" class="nav-link active" data-toggle="tab" href="#panel7" role="tab">
                                <i class="fa fa-user mr-1"></i> Login</a>
                        </li>
                        <li class="nav-item">
                            <a id="tabregistro" class="nav-link" data-toggle="tab" href="#panel8" role="tab">
                                <i class="fa fa-user-plus mr-1"></i> Registro</a>
                        </li>
                    </ul>

                    <!-- Tab panels -->
                    <div class="tab-content">
                        <!--Panel 7-->
                        <div class="tab-pane fade in show active" id="panel7" role="tabpanel">
                            <div id="form-sign-in">
                                <!--Body-->
                                <div class="modal-body mb-1">
                                    <div class="md-form form-sm">
                                        <i class="fa fa-envelope prefix"></i>
                                        <input id="youremail" type="email" name="youremail" class="form-control"  required="required">
                                        <label for="youremail" class="etiqueta">Email</label>
                                        <label id="info-email" for="noexiste" class="error"></label>
                                    </div>

                                    <div class="md-form form-sm">
                                        <i class="fa fa-lock prefix"></i>
                                        <input type="password" id="yourpassword" name="yourpassword" class="form-control" maxlength="12" required="required">
                                        <label for="yourpassword" class="etiqueta">Contraseña</label>
                                        <label id="info-pwd" for="noexiste" class="error"></label>
                                    </div>
                                    <div class="text-center mt-2">
                                        <button id="btn-login" class="btn btn-info" disabled="">Log in
                                            <i class="fa fa-sign-in-alt ml-1"></i>
                                        </button>
                                        
                                    </div>
                                </div>
                            </div>
                           
                            
                            <!--Footer-->
                            <div class="modal-footer display-footer">
                                <div class="options text-center text-md-right mt-1">
                                    <p>¿Todavía no eres miembro?
                                        <a id="registrate" href="#panel8" class="blue-text">Regístrate</a>
                                        <!-- ruta a registrarse-->
                                    </p>
                               <!--     <p>¿Olvidaste tu
                                        <a href="#" class="blue-text">Contraseña?</a>
                                    </p> -->
                                </div>
                                <button id="cerrarlogin" type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Cerrar</button>
                            </div>

                        </div>
                        <!--/.Panel 7-->

                        <!--Panel 8-->
                        <div class="tab-pane fade" id="panel8" role="tabpanel">
                            <div id="form-sign-up">
                                <!--Body-->
                                <div class="modal-body">
                                    <div class="md-form form-sm">
                                        <i class="fa fa-address-card prefix"></i>
                                        <input type="text" id="dni" class="form-control" name="dni" maxlength="9" required="required">
                                        <label for="dni" class="etiqueta">DNI</label>
                                        <label id="idni" for="noexiste" class="error"></label>
                                    </div>
                                    <div class="md-form form-sm">
                                        <i class="fa fa-user-circle prefix"></i>
                                        <input type="text" id="nombre" class="form-control" name="nombre" maxlength="45" required="required">
                                        <label for="nombre" class="etiqueta">Nombre</label>
                                        <label id="inombre" for="noexiste" class="error"></label>
                                    </div>

                                    <div class="md-form form-sm">
                                        <i class="fa fa-user prefix"></i>
                                        <input type="text" id="apellido1" class="form-control" name="apellido1" maxlength="45" required="required">
                                        <label for="apellido1" class="etiqueta">Apellido 1</label>
                                        <label id="iapellido1" for="noexiste" class="error"></label>
                                    </div>
                                    <div class="md-form form-sm">
                                        <i class="fa fa-user prefix"></i>
                                        <input type="text" id="apellido2" class="form-control" name="apellido2" maxlength="45" required="required">
                                        <label for="apellido2" class="etiqueta">Apellido 2</label>
                                        <label id="iapellido2" for="noexiste" class="error"></label>
                                    </div>

                                    <div class="md-form form-sm">
                                        <i class="fa fa-star prefix"></i>
                                        <input type="text" id="nick" class="form-control" name="nick" maxlength="45" required="required">
                                        <label for="nick" class="etiqueta">Nick</label>
                                        <label id="inick" for="noexiste" class="error"></label>
                                    </div>

                                    <div class="md-form form-sm">
                                        <i class="fa fa-envelope prefix"></i>
                                        <input type="email" id="email" class="form-control" name="email" maxlength="45" required="required">
                                        <label for="email" class="etiqueta">email</label>
                                        <label id="iemail" for="noexiste" class="error"></label>
                                    </div>

                                    <div class="md-form form-sm">
                                        <i class="fa fa-lock prefix"></i>
                                        <input type="password" id="password" class="form-control" name="password" maxlength="12" required="required"> 
                                        <label for="password" class="etiqueta">Password</label>
                                        <label id="ipassword" for="noexiste" class="error"></label>
                                    </div>

                                    <div class="md-form form-sm">
                                        <i class="fa fa-lock prefix"></i>
                                        <input type="password" id="password2" class="form-control" name="password2" maxlength="12" required="required">
                                        <label for="password2" class="etiqueta">Repetir password</label>
                                        <label id="ipassword2" for="noexiste" class="error"></label>
                                    </div>

                                    <div class="text-center form-sm mt-2">
                                        <button type="submit" id="btn-registro" class="btn btn-info" disabled="">Sign up
                                            <i class="fa fa-sign-in-alt ml-1"></i>

                                        </button>
                                    </div>
                            </div>
                            </div>
                            <!--Footer-->
                            <div class="modal-footer">
                                <div class="options text-right">
                                    <p class="pt-1">¿Ya tienes una cuenta?
                                        <a id="linklogin" href="#" class="blue-text">Log In</a>
                                    </p>
                                </div>
                                <button id="cerrar" type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <!--/.Panel 8-->
                    </div>

                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!--Modal: Login / Register Form-->

        <script>
                    $('.left_inner').resizable();
                    $(function () {
                        $('#input-search').on('keyup', function () {
                            var rex = new RegExp($(this).val(), 'i');
                            $('.searchable-container .item-card').hide();
                            $('.searchable-container .item-card').filter(function () {
                                return rex.test($(this).text());
                            }).show();
                        });
                    });
        </script>
    </body>
</html>
