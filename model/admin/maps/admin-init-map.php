<?php ?>

<script>
    function initMap() {
        markadoresCluster = [];
        centrado = {lat: 39.478758, lng: -0.414405};
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            center: centrado
        });
        var map = new google.maps.Map(document.getElementById("map"), map);
        $.ajax({

            url: '../../model/Maps/admin-init-map.php',
            dataType: 'json',
            success: function (markers) {

                markers.forEach(n => {
                    var posicion = new google.maps.LatLng(n.coordenada_x, n.coordenada_y);
                    var marker = new google.maps.Marker({
                        position: posicion,
                        map: map,
                        animation: google.maps.Animation.DROP,
                        _value: n.id_centro
                    });
                    markadoresCluster.push(marker);

                });
                 markerCluster = new MarkerClusterer(map, markadoresCluster,
                        {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
            }
        });

    }


</script>
