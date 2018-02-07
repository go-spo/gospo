<?php ?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="../../../resources/img/favicon.png" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Admin</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <!-- Bootstrap core CSS     -->
        <link href="../../../styles/css/admin/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!--  Material Dashboard CSS    -->
        <link href="../../../styles/css/admin/material-dashboard.css" rel="stylesheet" type="text/css"/>
        <!--     Fonts and icons     -->
        <link href="../../../vendor/fontawesome/fontawesome-admin.css" rel="stylesheet" type="text/css"/>
        <link href="../../../vendor/fontawesome/materialIcon.css" rel="stylesheet" type="text/css"/>
        <!--  Custom styles  -->
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
                        <li class="active">
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
                            <a href="./admin-maps.php">
                                <i class="material-icons">location_on</i>
                                <p>Mapa</p>
                            </a>
                        </li>
                        <li>
                            <a href="./notifications.html">
                                <i class="material-icons text-gray">notifications</i>
                                <p>Notificaciones</p>
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
                            <a class="navbar-brand" href="./user.html"> Bienvenido Daniel </a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="material-icons">dashboard</i>
                                        <p class="hidden-lg hidden-md">Dashboard</p>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="material-icons">notifications</i>
                                        <span class="notification">3</span>
                                        <p class="hidden-lg hidden-md">Notificaciones</p>
                                    </a>
                                    <!-- AQUI SE AÑADIRIAN LAS NOTIFICACIONES QUE TUVISIE PENDIENTES -->
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="#">Daniel tiene que acabar el panel de admin</a>
                                        </li>
                                        <li>
                                            <a href="#">Tengo que parar a cenar</a>
                                        </li>
                                        <li>
                                            <a href="#">Recuerda estirar las piernas</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="./admin-user.php" class="dropdown-toggle">
                                        <i class="material-icons">person</i>
                                        <p class="hidden-lg hidden-md">Perfil</p>
                                    </a>
                                </li>
                            </ul>
                            <form class="navbar-form navbar-right" role="search">
                                <div class="form-group  is-empty">
                                    <input type="text" class="form-control" placeholder="Buscar...">
                                    <span class="material-input"></span>
                                </div>
                                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                    <i class="material-icons">search</i>
                                    <div class="ripple-container"></div>
                                </button>
                            </form>
                        </div>
                    </div>
                </nav>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <!-- Centros totales -->
                                <div class="card card-stats">
                                    <div class="card-header" data-background-color="" style="background-color: #ef5350">
                                        <i class="material-icons">account_balance</i>
                                    </div>
                                    <div class="card-content">
                                        <p class="category">Total Centros</p>
                                        <h3 id="total-centers" class="title"></h3>
                                    </div>
                                    <div class="card-footer">
                                        <div class="stats">
                                            <i class="material-icons">remove_red_eye</i>
                                            <a href="./admin-centros.php"> Ver centros</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Personas Logeadas -->
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="card card-stats">
                                    <div class="card-header" data-background-color="" style="background-color: #009688">
                                        <i class="material-icons">person</i>
                                    </div>
                                    <div class="card-content">
                                        <p class="category">Total Usuarios</p>
                                        <h3 id="total-users" class="title"></h3>
                                    </div>
                                    <div class="card-footer">
                                        <div class="stats">
                                            <i class="material-icons">date_range</i> Últimas 24 horas
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Tarjeta 3  -->
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="card card-stats">
                                    <div class="card-header" data-background-color="" style="background-color: #607d8b">
                                        <i class="material-icons">directions_run</i>
                                    </div>
                                    <div class="card-content">
                                        <p class="category">Total Deportes</p>
                                        <h3 id="total-sports" class="title"></h3>
                                    </div>
                                    <div class="card-footer">
                                        <div class="stats">
                                            <i class="material-icons">remove_red_eye</i>
                                            <a href="#">Ver deportes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Tarjeta 4  -->
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="card card-stats">
                                    <div class="card-header" data-background-color="blue">
                                        <i class="material-icons">group</i>
                                    </div>
                                    <div class="card-content">
                                        <p class="category">Eventos Activos</p>
                                        <h3 id="total-events" class="title"></h3>
                                    </div>
                                    <div class="card-footer">
                                        <div class="stats">
                                            <i class="material-icons">date_range</i> Últimas 24 horas
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-header card-chart" data-background-color="" style="background-color: #607d8b">
                                        <div class="ct-chart" id="resrervasChart"></div>
                                    </div>
                                    <div class="card-content">
                                        <div id="tooltip"></div>
                                        <h4 class="title">Reservas por deportes
                                            <a class="icon-link">
                                                <i class="material-icons" data-toggle="modal" data-target="#indicesChart">remove_red_eye</i>
                                            </a>
                                        </h4>
                                    </div>
                                    <div class="card-footer">
                                        <div class="stats">
                                            <i class="material-icons">date_range</i> Últimas 24 horas
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="green">
                                        <h4 class="title">Trabajadores GoSpo</h4>
                                        <a href="#">
                                            <i class="material-icons">person_add</i> Añadir trabajador
                                        </a>
                                    </div>
                                    <div class="card-content table-responsive">
                                        <table class="table table-hover">
                                            <thead class="text-success">
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            </thead>
                                            <tbody id="users-table">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <nav class="pull-left">
                            <ul>
                                <li>
                                    <a href="#">
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Company
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Portfolio
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Blog
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <p class="copyright pull-right">
                            &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="#">GoSpo</a>, Time to move on
                        </p>
                    </div>
                </footer>
            </div>
        </div>
    </body>

    <!-- ====================== MODALS ======================== -->
    <!-- Modal Leyenda -->
    <div class="modal fade" id="indicesChart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <b>Leyenda</b>
                </div>
                <div id="leyeneda-reservas-chart" class="modal-body">
                    <p>Ordenados de izquiera a derecha.</p><hr>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!--   Core JS Files   -->
    <script src="../../../vendor/admin-page/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="../../../vendor/admin-page/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../vendor/admin-page/js/material.min.js" type="text/javascript"></script>
    <!--  Charts Plugin -->
    <script src="../../../vendor/admin-page/js/chartist.min.js" type="text/javascript"></script>
    <!--  Dynamic Elements plugin -->
    <script src="../../../vendor/admin-page/js/arrive.min.js" type="text/javascript"></script>
    <!--  PerfectScrollbar Library -->
    <script src="../../../vendor/admin-page/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <!--  Notifications Plugin    -->
    <script src="../../../vendor/admin-page/js/bootstrap-notify.js" type="text/javascript"></script>
    <!-- Material Dashboard javascript methods -->
    <script src="../../../vendor/admin-page/js/material-dashboard.js" type="text/javascript"></script>
    <!-- Dashboard data -->
    <script src="../../../model/admin/dashboard/dashboard.js" type="text/javascript"></script>
</html>