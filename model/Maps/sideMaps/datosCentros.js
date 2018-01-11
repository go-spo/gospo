$(document).ready(function () {
    $.ajax({
        url: '../model/Maps/sideMaps/datosCentros.php',
        dataType: 'json',
        success: function (centros) {

            centros.forEach(n => {
                $("#center-result").append('<div class="item-card">' +
                        '<div class="info-block">' +
                        '<div class="square-box pull-left">' +
                        '</div>' +
                        '<h5>' + n.nombre + '</h5>' +
                        '<h7>C/ ' + n.direccion + '</h7>'+
                        '<h7>Phone: 555-555-5555</h7>' +
                        '</div>' +
                        '</div>');
            });
        }
    });
});


