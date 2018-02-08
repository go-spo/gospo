<?php ?>

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
        <!-- Custom css -->
        <link href="../../../styles/css/admin-index.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <div class="wrapper">
            <div class="sidebar" data-color="blue" data-image="../../../resources/img/girl-warmup.JPG">
                <!--
            Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"
    
            Tip 2: you can also add an image using data-image tag
                -->
                <div class="logo">
                    <a href="#" class="simple-text">
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
                        <li class="active">
                            <a href="./admin-deportes.php">
                                <i class="material-icons">content_paste</i>
                                <p>Deportes</p>
                            </a>
                        </li>
                        <li>
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
                            <a class="navbar-brand" href="#"> Panel deportes</a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="#" id="SignOut" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="material-icons">forward</i>
                                        <p class="hidden-lg hidden-md">Sing Out</p>
                                    </a>
                                </li>
                            </ul>
                            <div class="navbar-form navbar-right" ></div>
                        </div>
                    </div>
                </nav>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row" data-tabs="tabs">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <!-- VER -->
                                <div class="card card-stats">
                                    <a href="#ver-deportes" data-toggle="tab">
                                        <div class="card-header" data-background-color="green">
                                            <i class="material-icons">remove_red_eye</i>
                                        </div>
                                        <div class="card-content">
                                            <p class="category">Ver Deportes</p>
                                            <h3 id="total-centers" class="title"></h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!-- INSERTAR  -->
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <div class="card card-stats">
                                    <a href="#insertar-deportes" data-toggle="tab">
                                        <div class="card-header" data-background-color="blue">
                                            <i class="material-icons">account_balance</i>
                                        </div>
                                        <div class="card-content">
                                            <p class="category">Añadir Deportes</p>
                                            <h3 id="total-users" class="title"></h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!-- MODIFICAR  -->
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <div class="card card-stats">
                                    <a href="#modificar-deportes" data-toggle="tab">
                                        <div class="card-header" data-background-color=""  style="background-color: #7e57c2">
                                            <i class="material-icons">description</i>
                                        </div>
                                        <div class="card-content">
                                            <p class="category">Modificar Deportes</p>
                                            <h3 id="total-sports" class="title"></h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">

                        <div class="card-content">
                            <div class="tab-content">
                                <div class="tab-pane active" id="ver-deportes">
                                    <?php
                                    include '../../../model/admin/deportes/tab-get-deportes.php';
                                    ?>
                                </div>
                                <div class="tab-pane" id="insertar-deportes">
                                    <?php
                                    include '../../../model/admin/deportes/tab-insert-deportes.php';
                                    ?>
                                </div>
                                <div class="tab-pane" id="modificar-deportes">
                                    <?php
                                    include '../../../model/admin/deportes/tab-update-deportes.php';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../../../model/admin/modal/update.php'; ?>
    </body>
    <!--   Core JS Files   -->
    <script src="../../../vendor/admin-page/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="../../../vendor/admin-page/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../vendor/admin-page/js/material.min.js" type="text/javascript"></script>
    <!--  Dynamic Elements plugin -->
    <script src="../../../vendor/admin-page/js/arrive.min.js" type="text/javascript"></script>
    <!--  PerfectScrollbar Library -->
    <script src="../../../vendor/admin-page/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <!--  Notifications Plugin    -->
    <script src="../../../vendor/admin-page/js/bootstrap-notify.js" type="text/javascript"></script>
    <!-- Material Dashboard javascript methods -->
    <script src="../../../vendor/admin-page/js/material-dashboard.js" type="text/javascript"></script>
    <!--  Center Data -->
    <script src="../../../model/admin/deportes/admin-deportes.js" type="text/javascript"></script>
</html>