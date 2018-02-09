<?php
session_start();
if (isset($_SESSION['id_user_pag_principal'])) {
    ?>
    <!doctype html>
    <html lang="en">

        <head>
            <meta charset="utf-8" />
            <link rel="icon" type="image/png" href="../../../resources/img/favicon.png" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
            <title>Panel Administrador</title>
            <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
            <meta name="viewport" content="width=device-width" />
            <!-- Bootstrap core CSS     -->
            <link href="../../../styles/css/admin/bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <!--  Material Dashboard CSS    -->
            <link href="../../../styles/css/admin/material-dashboard.css" rel="stylesheet" type="text/css"/>
            <!--     Fonts and icons     -->
            <link href="../../../vendor/fontawesome/fontawesome-admin.css" rel="stylesheet" type="text/css"/>
            <link href="../../../vendor/fontawesome/materialIcon.css" rel="stylesheet" type="text/css"/>
        </head>

        <body>
            <div class="wrapper">
                <div class="sidebar" data-color="blue" data-image="../../../resources/img/girl-warmup.JPG">
                    <!--
                Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"
        
                Tip 2: you can also add an image using data-image tag
                    -->
                    <div class="logo">
                        <a href="../../../index.html" class="simple-text" target="_blank">
                            <img src="../../../resources/img/logo-3.PNG" alt=""/>
                        </a>
                    </div>
                    <div class="sidebar-wrapper">
                        <ul class="nav">
                            <li>
                                <a href="./admin-index.php">
                                    <i class="material-icons">dashboard</i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li>
                                <a href="./admin-user.php">
                                    <i class="material-icons">person</i>
                                    <p>Perfil</p>
                                </a>
                            </li>
                            <li>
                                <a href="./admin-centros.php">
                                    <i class="material-icons">content_paste</i>
                                    <p>Centros</p>
                                </a>
                            </li>
                            <li>
                                <a href="./admin-pistas.php">
                                    <i class="material-icons">content_paste</i>
                                    <p>Pistas</p>
                                </a>
                            </li>
                            <li>
                                <a href="./admin-deportes.php">
                                    <i class="material-icons">content_paste</i>
                                    <p>Deportes</p>
                                </a>
                            </li>
                            <li class="active">
                                <a href="./admin-maps.php">
                                    <i class="material-icons">location_on</i>
                                    <p>Mapa</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="main-panel">
                    <nav class="navbar navbar-transparent navbar-absolute">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="#"> Panel Maps </a>
                            </div>
                            <div class="collapse navbar-collapse">
                                <ul class="nav navbar-nav navbar-right">
                                    <li>
                                        <a href="#" onclick='window.location = "../../../model/admin/sign-out/sign-out.php"' id="SignOut" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="material-icons">forward</i>
                                            <p class="hidden-lg hidden-md">Sing Out</p>
                                        </a>
                                    </li>
                                </ul>
                                <div class="navbar-form navbar-right" ></div>
                            </div>
                        </div>
                    </nav>
                    <div id="map" style="width: 100%;height: 89vh;position: relative;overflow: hidden;margin-top: 11vh;"></div>
                </div>
            </div>
        </body>
        <!--   Core JS Files   -->

        <script>
        </script>
        <script src="../../../vendor/admin-page/js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="../../../vendor/admin-page/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../../vendor/admin-page/js/material.min.js" type="text/javascript"></script>
        <!--  PerfectScrollbar Library -->
        <script src="../../../vendor/admin-page/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
        <!--  Google Maps Plugin    -->
        <script src="../../../vendor/google-maps/clusters/clusters.js" type="text/javascript"></script>
        <?php
        include '../../../model/admin/maps/admin-init-map.php';
        ?>?>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiTt0JoSwwww7v-t8xbt_40Ph6MvxeTMY&callback=initMap">
        </script>
        <!-- Material Dashboard javascript methods -->
        <script src="../../../vendor/admin-page/js/material-dashboard.js" type="text/javascript"></script>

    </html>

    <?php
} else {
    include './not-found-page/not-found-page.php';
}
?>
