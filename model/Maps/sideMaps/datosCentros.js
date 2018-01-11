$(document).ready(function () {
    $.ajax({
        url: '../model/Maps/sideMaps/datosCentros.php',
        dataType: 'json',
        success: function (centros) {

            centros.forEach(n => {

                $("#center-result").append('<a href=\"#\">' +
                        '<div class="item-card panel panel-default panel-horizontal">' +
                        '<div class="panel-body">' +
                        '<h5>' + n.nombre + '</h5>' +
                        '<h7>Dirección: ' + n.direccion + '</h7>' +
                        '<p> Tlf: vacío</p>' +
                        '</div>' +
                        '<div class="panel-footer"><img src="' + n.url_img + '"></div>' +
                        ' </div></a>');
            });
        }
    });
});


