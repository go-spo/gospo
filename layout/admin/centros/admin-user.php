<?php
session_start();
if (isset($_SESSION['id_user_pag_principal'])) {
    $_SESSION["id_user"] = $_SESSION['id_user_pag_principal'];
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
            <!--    Custom    -->
            <link href="../../../styles/css/admin-index.css" rel="stylesheet" type="text/css"/>
            <link href="../../../styles/css/admin-user.css" rel="stylesheet" type="text/css"/>
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
                            <li class="active">
                                <a href="./user.html">
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
                                <a class="navbar-brand" href="#">Panel usuario</a>
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
                    <div class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header" data-background-color="" style="background-color: #009688">
                                            <h4 class="title">Editor</h4>
                                            <p class="category">Completa tu perfil</p>
                                        </div>
                                        <div class="card-content" id="profile-update-form">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Nick</label><!--class="control-label"-->
                                                        <input id="User-nick" type="text" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-5">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Dirección Email </label>
                                                        <input id="User-email" type="email" class="form-control">
                                                        <label id="mailCheck" class="alert-message"> </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">DNI</label>
                                                        <input id="User-DNI" type="text" class="form-control">
                                                        <label id="dniCheck" class="alert-message"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Nombre</label>
                                                        <input id="User-nombre" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Primer apellido</label>
                                                        <input id="User-apellido1" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Segundo apellido</label>
                                                        <input id="User-apellido2" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Contraseña</label>
                                                        <input id="User-pass1" type="password" class="form-control">
                                                        <label id="passCheck" class="alert-message"></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Confirmación </label>
                                                        <input id="User-pass2" type="password" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary pull-right" id="cambiaDatos" style="background-color: #009688">Modificar</button>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-profile">
                                        <div class="card-avatar">
                                            <a href="#pablo">
                                                <img class="img" src="https://ih0.redbubble.net/image.483633982.6622/flat,1000x1000,075,f.u4.jpg" />
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h6 class="category text-gray" id="User-puesto"></h6>
                                            <a href="#pablo" class="btn btn-primary btn-round" style="background-color: #009688">Cambiar foto</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include '../../../model/admin/modal/update-profile.php'; ?>
        </div>
    </body>
    <!--   Core JS Files   -->
    <script src="../../../vendor/admin-page/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="../../../vendor/admin-page/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../vendor/admin-page/js/material.min.js" type="text/javascript"></script>
    <!--  Dynamic Elements plugin -->
    <script src="../../../vendor/admin-page/js/arrive.min.js" type="text/javascript"></script>
    <!--  PerfectScrollbar Library -->
    <script src="../../../vendor/admin-page/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <!-- Material Dashboard javascript methods -->
    <script src="../../../vendor/admin-page/js/material-dashboard.js" type="text/javascript"></script>
    <!--Custom-->
    <?php
    include '../../../model/admin/users/users.php';?>

    </html>

    <?php
} else {
    include './not-found-page/not-found-page.php';
}
?>