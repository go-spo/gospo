$(document).ready(function () {
    $.ajax({
        url: '../model/Maps/sideMaps/datosCentros.php',
        dataType: 'json',
        success: function (centros) {

            function rate(puntuacion) {

                var rate = Number.parseFloat(puntuacion);

                var resultado = '<i class="far fa-star"></i>' +
                        '<i class="far fa-star"></i>' +
                        '<i class="far fa-star"></i>' +
                        '<i class="far fa-star"></i>' +
                        '<i class="far fa-star"></i>';

                if (rate <= 1.4) {
                    var resultado = '<i class="fas fa-star"></i>' +
                            '<i class="far fa-star"></i>' +
                            '<i class="far fa-star"></i>' +
                            '<i class="far fa-star"></i>' +
                            '<i class="far fa-star"></i>';
                } else if (rate <= 2.4) {
                    var resultado = '<i class="fas fa-star"></i>' +
                            '<i class="fas fa-star"></i>' +
                            '<i class="far fa-star"></i>' +
                            '<i class="far fa-star"></i>' +
                            '<i class="far fa-star"></i>';
                } else if (rate <= 3.4) {
                    var resultado = '<i class="fas fa-star"></i>' +
                            '<i class="fas fa-star"></i>' +
                            '<i class="fas fa-star"></i>' +
                            '<i class="far fa-star"></i>' +
                            '<i class="far fa-star"></i>';
                } else if (rate <= 4.4) {
                    var resultado = '<i class="fas fa-star"></i>' +
                            '<i class="fas fa-star"></i>' +
                            '<i class="fas fa-star"></i>' +
                            '<i class="fas fa-star"></i>' +
                            '<i class="far fa-star"></i>';
                } else if (rate >= 4.5) {
                    var resultado = '<i class="fas fa-star"></i>' +
                            '<i class="fas fa-star"></i>' +
                            '<i class="fas fa-star"></i>' +
                            '<i class="fas fa-star"></i>' +
                            '<i class="fas fa-star"></i>';
                }
                return resultado;
            }

            var resultados = "";
            centros.forEach(n => {
                resultados = resultados + '<div id="' + n.id_centro + '" class="item-card panel panel-default panel-horizontal">' +
                        '<div class="panel-body">' +
                        '<h5>' + n.nombre + '</h5>' +
                        '<h7>Dirección: ' + n.direccion + '</h7>' +
                        '<p> Tlf: ' + n.telefono + '</p>' +
                        '<p class="rate-stars">' + (n.media).substring(0, 3) + '<span>' + rate(n.media) + '</span>(' + n.votos + ')</p>' +
                        '</div>' +
                        '<div class="panel-footer"><img src="' + n.url_img + '"></div>' +
                        ' </div>';

            });
            $("#center-result").append(resultados);


            $('.sidebar').on('click', '.item-card', function () {

                var id = this.id;
                $.ajax({
                    url: '../model/Maps/sideMaps/datosSeleccionado.php',
                    dataType: 'json',
                    data: "value=" + id,
                    success: function (seleccionado) {


                        seleccionado.forEach(n => {
                            $("#content_sidebar").empty("");
                            if ($('.left_inner').resizable()) {
                                $('.left_inner').resizable('destroy');
                            }
                            $('.left_inner').width('550');

                            $("#content_sidebar").empty("");
                            $("#content_sidebar").append("<button id='volver-resultados-centros'>volver</button><div id='center-result'></div>");
                            /*------ Funcion Volver ----------------*/
                            $('#volver-resultados-centros').click(function () {
                                $("#content_sidebar").empty("");
                                $("#content_sidebar").append('<h2 clas="conten_sidebar_title">Resultados</h2>' +
                                        '<div><input type="search" class="form-control" id="input-search" placeholder="Filtrar..." >' +
                                        '</div><!-- LAS TARJETAS DE BUSQUEDA -->' +
                                        '<div id="center-result" class="searchable-container">' +
                                        resultados +
                                        '</div>');
                                $('#input-search').on('keyup', function () {
                                    var rex = new RegExp($(this).val(), 'i');
                                    $('.searchable-container .item-card').hide();
                                    $('.searchable-container .item-card').filter(function () {
                                        return rex.test($(this).text());
                                    }).show();
                                });
                            });

                            $("#center-result").append('<div class="container-center-result">' +
                                    '<section class="columna1"><img src="' + n.url_img + '"></section>' +
                                    '<section class="columna2"><p>' + n.nombre + '</p></section>' +
                                    '<section class="columna3"><hr>'
                                    + "<p><b>Apertura: </b>" + n.hora_apertura + "</p><hr>" +
                                    "<p><b>Cierre: </b>" + n.hora_cierre + "</p><hr>" +
                                    "<p><b>Dirección: </b>" + n.direccion + "</p><hr>" +
                                    "<p><b>Municipio: </b>" + n.municipio + "</p><hr>" +
                                    "<p><b>Provincia: </b>" + n.provincia + "</p><hr>" +
                                    '</section>' +
                                    '</div>');
                        });
                    }
                });

            });

        }
    });
});


