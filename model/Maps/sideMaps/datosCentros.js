$(document).ready(function () {
    $.ajax({
        url: '../model/Maps/sideMaps/datosCentros.php',
        dataType: 'json',
        success: function (centros) {

            var resultados = "";
            centros.forEach(n => {

                $("#center-result").append(
                        '<div class="item-card panel panel-default panel-horizontal">' +
                        '<div class="panel-body">' +
                        '<h5>' + n.nombre + '</h5>' +
                        '<h7>Dirección: ' + n.direccion + '</h7>' +
                        '<p> Tlf: vacío</p>' +
                        '<p class="rate-stars">3,4<span><i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i></span>(45)</p>' +
                        '</div>' +
                        '<div class="panel-footer"><img src="' + n.url_img + '"></div>' +
                        ' </div>');

                resultados = resultados + '<div class="item-card panel panel-default panel-horizontal">' +
                        '<div class="panel-body">' +
                        '<h5>' + n.nombre + '</h5>' +
                        '<h7>Dirección: ' + n.direccion + '</h7>' +
                        '<p> Tlf: vacío</p>' +
                        '<p class="rate-stars">3,4<span><i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i></span>(45)</p>' +
                        '</div>' +
                        '<div class="panel-footer"><img src="' + n.url_img + '"></div>' +
                        ' </div>';
            });
            

            $('.item-card').click(function () {
                $("#content_sidebar").empty("");
                $("#content_sidebar").append("<button id='volver-resultados-centros'>volver</button>");

                $('#volver-resultados-centros').click(function () {
                    console.log(resultados);
                    $("#content_sidebar").empty("");
                    $("#content_sidebar").append('<h2 clas="conten_sidebar_title">Resultados</h2>' +
                            '<div><input type="search" class="form-control" id="input-search" placeholder="Busqueda..." >' +
                            '</div><!-- LAS TARJETAS DE BUSQUEDA -->' +
                            '<div id="center-result" class="searchable-container">' +
                            resultados +
                            '</div>');
                });

            });

        }
    });
});


