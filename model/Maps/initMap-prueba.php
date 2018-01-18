
<script>
    function initMap() {

        var markadores = [];
        var prev_infowindow;
        var centrado = {lat: 39.478758, lng: -0.414405};
        var positionSelected = "<?php echo $_SESSION["ciudad"] ?>";
        $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?address=" + positionSelected + "&key=AIzaSyBiTt0JoSwwww7v-t8xbt_40Ph6MvxeTMY", function (data) {
            centrado = {lat: data.results[0].geometry.location.lat, lng: data.results[0].geometry.location.lng};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 9,
                center: centrado
            });
            $.ajax({

                url: '../model/Maps/initMap.php',
                dataType: 'json',
                success: function (markers) {

                    markers.forEach(n => {
                        var posicion = new google.maps.LatLng(n.coordenada_x, n.coordenada_y);
                        var infowindow = new google.maps.InfoWindow({
                            content: "<h6>" + n.nombre + "</h6>"

                        });
                        var marker = new google.maps.Marker({
                            position: posicion,
                            map: map,
                            animation: google.maps.Animation.DROP,
                            _value: n.id_centro
                        });
                        markadores.push(marker);
                        /*Esto asigna el bote*/
                        marker.addListener('click', toggleBounce);
                        function toggleBounce() {
                            if (marker.getAnimation() !== null) {
                                marker.setAnimation(null);
                            } else {
                                marker.setAnimation(google.maps.Animation.BOUNCE);
                            }
                        }
                        marker.addListener('dblclick', function () {
                            map.setZoom(14);
                            map.setCenter(marker.getPosition());
                        });
                        google.maps.event.addListener(infowindow, 'closeclick', function () {
                            marker.setAnimation(null);
                        });
                        marker.addListener('click', function () {
                            /* Esto para el bote y hace zoom*/
                            for (var i = 0; i < markadores.length; i++) {
                                markadores[i].setAnimation(null);
                                infowindow.close(map, markadores[i]);
                            }
                            toggleBounce(this);
                            /* hasta aqui*/
                            /*--- Close and open infowindow ----*/
                            if (prev_infowindow) {
                                prev_infowindow.close();
                            }
                            prev_infowindow = infowindow;
                            infowindow.open(map, marker);
                            /* Hasta aqui*/
                            var id = this._value;
///////fumada ajax anidado
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

                                        $("#content_sidebar").append("<div id='center-result'></div>");
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
                    });
                }
            });
        }
        );
    }

</script>

