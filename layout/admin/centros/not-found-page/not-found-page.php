<?php ?>

<html>
    <head>
        <title>Acceso denegado</title>
        <link rel="icon" type="image/png" href="../../../resources/img/favicon.png" />
        <meta charset="UTF-8">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <style>
            @keyframes Gradient {
                0% {
                    background-position: 0% 50%
                }
                50% {
                    background-position: 100% 50%
                }
                100% {
                    background-position: 0% 50%
                }
            }
            body{
                width: 100% !important;
            }
            #card-traviesa{
                position: absolute;
                width: 38%;
                text-align: center;
                padding: 10px;
                margin-left: auto;
                margin-right: auto;
                left: 0;
                right: 0;
                top:25vh;
            }
            #particles-js {
                background: linear-gradient(-45deg, #e54b4b, #e54b4b, #23A6D5, #23D5AB);
                background-size: 400% 400%;
                animation: Gradient 15s ease infinite;
                padding-top: 18px !important;
                padding-bottom: 18px !important;
            }

            .particles-js-canvas-el{
                position: absolute !important;
                top:0px;
                z-index: -1 !important;
            }

            .panel-body{
                overflow: auto;
                max-height: 70vh;
            }
        </style>
        <link href="../../../vendor/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="../../../vendor/mdb/css/mdb.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body id="particles-js"> 
        <!-- jquery -->
        <script src="../../../vendor/jquery/jquery.js" type="text/javascript"></script>
        <!-- MDB -->
        <script src="../../../vendor/mdb/js/mdb.min.js" type="text/javascript"></script>
        <!-- Particles -->
        <script src="../../../vendor/particles/particles.min.js" type="text/javascript"></script>
        <script src="../../../vendor/particles/app.js" type="text/javascript"></script>

        <script>
            var topeHuidas = 0;
            function movimientoAleatorio(min, max) {
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }
            $(function () {
                $("a").on({
                    mouseover: function () {
                        if (topeHuidas <= 2) {
                            var maxX = $(window).width() - $("#card-traviesa").width();
                            var maxY = $(window).height() - $("#card-traviesa").height();
                            $("#card-traviesa").css({
                                'left': movimientoAleatorio(0, maxX),
                                'top': movimientoAleatorio(0, maxY)
                            });
                            topeHuidas++;
                        }
                    }
                });
            });
        </script>
        <div id='card-traviesa'  class="card animated flipInY ">
            <div class="card-block">
                <h1 class="card-title">Ups</h1>
                <h4 class="card-subtitle mb-2 text-muted">Parece que no tienes derecho para estar aquí</h4>
                <hr>
                <a href='../../../index.html' class="btn btn-primary">Volver</a>
            </div>
        </div>

    </body>
</html>
