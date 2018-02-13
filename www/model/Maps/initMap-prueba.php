
<script>
    function initMap() {

        markadores = [];
        var prev_infowindow;
        var centrado = {lat: 39.478758, lng: -0.414405};
        var positionSelected = "<?php echo $_SESSION["ciudad"] ?>";
        $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?address=" + positionSelected + ",España&key=AIzaSyBiTt0JoSwwww7v-t8xbt_40Ph6MvxeTMY", function (data) {
            centrado = {lat: data.results[0].geometry.location.lat, lng: data.results[0].geometry.location.lng};
            map = new google.maps.Map(document.getElementById('map'), {
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
                                         /*------------ PARA MOSTRAR LA INFORMACIÓN -----------------*/
                $.ajax({
                    url: '../model/Maps/sideMaps/datosSeleccionado.php',
                    dataType: 'json',
                    data: "value=" + id,
                    success: function (seleccionado) {

                        seleccionado.forEach(n => {

                            var datosJson = n.id_centro + ":" + n.id_deporte + ":" + n.precio_hora + ":" + n.url_img + ":" + n.direccion + ":" + n.municipio + ":" + n.deporte + ":" + n.color;
                            id_centro = n.id_centro;
                            id_deporte = n.id_deporte;
                            $("#content_sidebar").empty("");
                            if ($('.left_inner').resizable()) {
                                $('.left_inner').resizable('destroy');
                            }
                            $('.left_inner').width('30vw');

                            $("#content_sidebar").empty("");
                            $("#content_sidebar").append("<button id='volver-resultados-centros'><i class=\"fas fa-angle-double-left\"></i> <span class='volver-resultados-centros-texto'> Atras</span></button><div id='center-result'></div>");
                            /*------ Funcion Volver ----------------*/
                            $('#volver-resultados-centros').click(function () {
                                $('.left_inner').resizable();
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

                            $("#center-result").append('<div class="card mb-3">' +
                                    '<img class="card-img-top" src="' + n.url_img + '" alt="Card image cap">' +
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
                                    /*RESERVAS*/'  <div class="tab-pane fade show active" id="reservas" role="tabpanel" aria-labelledby="home-tab">' +
                                    '<hr><h5>Día:</h5><input class="datepicker">' +
                                    '<hr><h5>Hora:</h5><input class="timepicker" readonly>' +
                                    '<hr><br><button id="btn-reserva" data="' + datosJson + '" class="btn btn-info">Reservar</button>' +
                                    '</div>' +
                                    /*INFO*/'  <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="profile-tab" style="padding-top:10px">' +
                                    '<p><b>Nombre: </b>' + n.nombre + '</p><hr>' +
                                    '<p><b>Apertura: </b>' + n.hora_apertura + '</p><hr>' +
                                    '<p><b>Cierre: </b>' + n.hora_cierre + '</p><hr>' +
                                    '<p><b>Dirección: </b>' + n.direccion + '</p><hr>' +
                                    '<p><b>Municipio: </b>' + n.municipio + '</p><hr>' +
                                    '<p><b>Provincia: </b>' + n.provincia + '</p><hr>' +
                                    '</div>' +
                                    /*FOTOS*/'  <div class="tab-pane fade" id="fotos" role="tabpanel" aria-labelledby="contact-tab">Fotos</div>' +
                                    /*MENSAJES*/'  <div class="tab-pane fade" id="mensaje" role="tabpanel" aria-labelledby="contact-tab">mensaje</div>' +
                                    /*VALORACIONES*/'  <div class="tab-pane fade" id="valoracion" role="tabpanel" aria-labelledby="contact-tab">valoración</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>');
                            // ------------- BOTON RESERVAR --------------- // 
                            $("#reservas").ready(function () {
                                $("#btn-reserva").on("click", function () {
                                    datos = $(this).attr("data");
                                    datosSplit = datos.split(":");


                                    var horaSelect = tiempoElegido;
                                    console.log(tiempoElegido);
                                    //     var fechaSelect = ($("#input_datepicker").val());
                                    var fechaSelect = fechaElegida;
                                    var pistaSelect = 1;

                                    var id = datosSplit[0] + datosSplit[1] + pistaSelect + horaSelect + fechaSelect;
                                    reserva = {id: id, id_centro: datosSplit[0], id_deporte: datosSplit[1], precio_hora: datosSplit[2],
                                        imagen: datosSplit[3], direccion: datosSplit[4], municipio: datosSplit[5], 
                                        pista: pistaSelect, hora: horaSelect, fecha: fechaSelect,deporte:datosSplit[6],color:datosSplit[7]};

                                    if (localStorage.getItem("carro") === null) {
                                        var reservas = [];
                                        reservas.push(reserva);
                                        localStorage.setItem("carro", JSON.stringify(reservas));
                                        articulos();
                                        console.log("hola");

                                    } else {
                                        var add = true;
                                        jcarro = localStorage.getItem("carro");
                                        var carro = JSON.parse(jcarro);
                                        for (var i = 0; i < carro.length; i++) {
                                            if (carro[i].id === reserva.id) {
                                                add = false;
                                            }
                                        }
                                        if (add) {
                                            carro.push(reserva);
                                            localStorage.setItem("carro", JSON.stringify(carro));
                                            articulos();
                                            console.log("ass");

                                        } else {

                                            $("#reservaRepetida").modal("show");

                                        }
                                    }

                                });

                            });
                            ////////////////////////
                        });

                        $('.datepicker').pickadate({
                            monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                            monthsShort: ['En', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                            weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                            weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                            firstDay: 2,
                            today: 'Hoy',
                            clear: 'Limpiar',
                            close: 'Cancelar',
                            labelMonthNext: 'Mes siguiente',
                            labelMonthPrev: 'Mes anterior',
                            min: true,
                            max: 365,
                            onSet: function () {

                                $('.timepicker').val("");
                                var selected = {
                                    id_deporte: id_deporte,
                                    id_centro: id_centro,
                                    fecha: this.get('select', 'yyyy-mm-dd')
                                };

                                $.ajax({
                                    url: '../model/Maps/sideMaps/diaSeleccionado.php',
                                    type: "POST",
                                    dataType: 'json',
                                    data: selected,
                                    success: function (resultado) {
                                        timePicker = $('.timepicker').pickatime({
                                            clear: 'Limpiar',
                                            interval: 60,
                                            min: [10, 00],
                                            max: [22, 0],
                                            disable: resultado,
                                            onSet: function () {
                                                tiempoElegido = this.get('select', 'H:i');
                                            }
                                        });
                                        tpicker = timePicker.pickatime('picker');
                                        if (resultado.length !== 0) {
                                            tpicker.set('disable', resultado);
                                        } else {
                                            tpicker.set('disable', false);
                                        }
                                    }
                                });

                                fechaElegida = this.get('select', 'yyyy-mm-dd');

                            }

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

