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

                            /*$("#center-result").append('<div class="container-center-result">' +
                             '<section class="columna1"><img src="' + n.url_img + '"></section>' +
                             '<section class="columna2"><p>' + n.nombre + '</p></section>' +
                             '<section class="columna3"><hr>'
                             + "<p><b>Apertura: </b>" + n.hora_apertura + "</p><hr>" +
                             "<p><b>Cierre: </b>" + n.hora_cierre + "</p><hr>" +
                             "<p><b>Dirección: </b>" + n.direccion + "</p><hr>" +
                             "<p><b>Municipio: </b>" + n.municipio + "</p><hr>" +
                             "<p><b>Provincia: </b>" + n.provincia + "</p><hr>" +
                             '</section>' +
                             '</div>');*/

                            $("#center-result").append('<div class="card mb-3">' +
                                    '<img class="card-img-top" src="http://lajugadafinanciera.com/wp-content/uploads/2017/06/copa-mundo-tenis-itf.jpg" alt="Card image cap">' +
                                    '<div class="card-body">' +
                                    '<ul class="nav nav-tabs" id="myTab" role="tablist">' +
                                    '  <li class="nav-item">' +
                                    '    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#reservas" role="tab" aria-controls="reservas" aria-selected="true"><i class="fas fa-calendar-alt"></i></a>' +
                                    '  </li>' +
                                    '  <li class="nav-item">' +
                                    '    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false"><i class="fas fa-question-circle"></i></a>' +
                                    '  </li>' +
                                    '  <li class="nav-item">' +
                                    '    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#fotos" role="tab" aria-controls="fotos" aria-selected="false"><i class="fas fa-camera"></i></a>' +
                                    '  </li>' +
                                    '  <li class="nav-item">' +
                                    '    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#mensaje" role="tab" aria-controls="mensaje" aria-selected="false"><i class="fas fa-envelope"></i></a>' +
                                    '  </li>' +
                                    '  <li class="nav-item">' +
                                    '    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#valoracion" role="tab" aria-controls="valoracion" aria-selected="false"><i class="fas fa-star"></i></a>' +
                                    '  </li>' +
                                    '</ul>' +
                                    '<div class="tab-content" id="myTabContent">' +
                                    '  <div class="tab-pane fade show active" id="reservas" role="tabpanel" aria-labelledby="home-tab">Reservas</div>' +
                                    '  <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="profile-tab">Información del centro</div>' +
                                    '  <div class="tab-pane fade" id="fotos" role="tabpanel" aria-labelledby="contact-tab">Fotos</div>' +
                                    '  <div class="tab-pane fade" id="mensaje" role="tabpanel" aria-labelledby="contact-tab">mensaje</div>' +
                                    '  <div class="tab-pane fade" id="valoracion" role="tabpanel" aria-labelledby="contact-tab">valoración</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>');
                        });
                    }
                });

            });

        }
    });
});


