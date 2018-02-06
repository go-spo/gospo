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
        <link href="../styles/css/half-slider.css" rel="stylesheet" type="text/css"/> 
        <!-- Carro compra-->
        <link href="../styles/css/carro.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
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
        <script src="../vendor/fontawesome-all.js" type="text/javascript"></script>
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
                                    <a class="nav-link btn btn-primary nav-login" href="#"><span class="nav-login-color">Log In</span></a>
                                </li>
                            </ul>
                            <button type="button" class=" nav-item__carro" data-toggle="modal" data-target="#Modal__carrito">
                                <i class="fab fa-opencart fa-lg"></i><span class="nav-item__carro__contador"></span>
                            </button>
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
