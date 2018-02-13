$(document).ready(function () {

    /*Effect on scroll*/
    new WOW().init();


    //Latitud: 39.4271073   Longitud: -0.4118602  PAIPORTA
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            console.log("Latitud: " + pos.lat + "Longitud: " + pos.lng);
            $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?latlng=" + pos.lat + "," + pos.lng + "&key=AIzaSyBiTt0JoSwwww7v-t8xbt_40Ph6MvxeTMY", function (data) {
                
                lastPos = data.results[0].address_components.length - 1;
                //provincia = data.results[0].address_components[3].long_name;
                //console.log(provincia);

                codigopostal = data.results[0].address_components[lastPos].long_name;
                subcadena = codigopostal.substring(0, 2);
                switch (subcadena) {
                    case '46':
                        provincia = "Valencia";
                        break;
                    case '03':
                        provincia = "Alicante";
                        break;
                    case '12':
                        provincia = "Castellon";
                        break; //sin tilde
                    default:
                        alert("Provincia no registrada en el sistema");
                }
            });

        }, function () {

        });
    } else {
        // Browser doesn't support Geolocation
        alert("¡Error! Este navegador no soporta la Geolocalización.");
    }



    /*
     function refrescarUbicacion() {	
     navigator.geolocation.watchPosition(mostrarUbicacion);
     }	
     */
    var $carousel = $('.deportes-moda').flickity({
        initialIndex: 1,
        cellAlign: 'left',
        contain: true,
        autoPlay: true,
        pageDots: false,
        arrowShape: {
            x0: 40,
            x1: 60, y1: 50,
            x2: 75, y2: 40,
            x3: 10
        }
    });

    $.ajax({

        url: 'model/seleccion/seleccion_deportes.php',
        dataType: 'json',
        success: function (deportesmoda) {

            deportesmoda.forEach(n => {
                var $cellElems = $(makeCellHtml(n.id_deporte, n.imagen, n.nombre));
                $carousel.flickity('append', $cellElems);
                var card = ".card-" + n.id_deporte;
                var top = ".top-" + n.id_deporte;
                $(card).hover(function () {
                    $(top).css("background", n.color);
                }, function () {
                    $(top).css("background", "rgba(66, 66, 66, 0.56)");
                });
            });
        }

    });

    function makeCellHtml(id, img, nombre) {
        return '<div class="carousel-cell">' +
                '<div id="' + id + '" class="card hover-card card-' + id + '">' +
                '<img class="card-img-top img-responsive" src="resources/img/deportes/' + img + '" alt="' + nombre + '">' +
                '<div class="top top-' + id + '"">' + nombre + '</div>' +
                '</div>' +
                '</div>';
    }

    $('#deportes-moda').on('click', '.card', function () {  //tiene que funcionar como si el user clicka en Buscar del formulario principal


        /* Llamada ajax para enviar coordenadas o ubicación al servidor y consultar*/
        deporteID = $(this).attr("id");
        //console.log(deporteID+" "+provincia);
        $.ajax({
            url: "model/Maps/sideMaps/datosCentros.php",
            // url: "model/seleccion/mostrar_centros_cerca.php?deporte="+deporteID+"&provincia="+provincia, 
            data: "deporte=" + deporteID + "&provincia=" + provincia,
            dataType: 'json',
            success: function (centros) {

                centros.forEach(n => {
                    console.log(n);
                });

                window.location = "layout/resultado-centros-busqueda.php?deporte=" + deporteID + "&provincia=" + provincia;
            }

        });

    });


});