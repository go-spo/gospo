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

            resultados = "";
            centros.forEach(n => {
                resultados = resultados + '<div id="' + n.id_centro + '" class="item-card panel panel-default panel-horizontal" draggable="true" ondragstart="drag(event)">' +
                        '<div class="panel-body">' +
                        '<h5>' + n.nombre + '</h5>' +
                        '<h7>Dirección: ' + n.direccion + '</h7>' +
                        '<p> Tlf: ' + n.telefono + '</p>' +
                        '<p class="rate-stars">' + (n.media).substring(0, 3) + '<span>' + rate(n.media) + '</span>(' + n.votos + ')</p>' +
                        '</div>' +
                        '<div class="panel-footer"><img src="' + n.url_img + '" draggable="false"></div>' +
                        ' </div>';

            });
            $("#center-result").append(resultados);

            /*----------- PARA ANIMAR EL MARKER ON HOVER----------------*/
            $('.sidebar').on('mouseover', '.item-card', function () {
                var id = this.id;
                $.ajax({
                    url: '../model/Maps/sideMaps/datosSeleccionado.php',
                    dataType: 'json',
                    data: "value=" + id,
                    success: function (seleccionado) {
                        seleccionado.forEach(n => {
                            markadores.forEach(n => {
                                if (id == n._value) {
                                    /*
                                     map.panTo(n.getPosition());
                                     map.setZoom(12);
                                     */
                                    n.setAnimation(google.maps.Animation.BOUNCE);
                                } else {
                                    n.setAnimation(null);
                                }
                            });
                        });
                    }
                });
            });

            /*cambiar a click abajo*/
            $('.sidebar').on('click', '.item-card', function () {

                var id = this.id;
                /*----------- PARA ANIMAR EL MARKER SELECCIONADO ----------------*/
                $.ajax({
                    url: '../model/Maps/sideMaps/datosSeleccionado.php',
                    dataType: 'json',
                    data: "value=" + id,
                    success: function (seleccionado) {
                        seleccionado.forEach(n => {
                            markadores.forEach(n => {
                                if (id == n._value) {
                                    map.panTo(n.getPosition());
                                    map.setZoom(13);

                                    n.setAnimation(google.maps.Animation.BOUNCE);
                                } else {
                                    n.setAnimation(null);
                                }
                            });
                        });
                    }
                });

                /*------------ PARA MOSTRAR LA INFORMACIÓN -----------------*/
                $.ajax({
                    url: '../model/Maps/sideMaps/datosSeleccionado.php',
                    dataType: 'json',
                    data: "value=" + id,
                    success: function (seleccionado) {

                        seleccionado.forEach(n => {

                            var datosJson = n.id_centro + ":" + n.id_deporte + ":" + n.precio_hora + ":" + n.url_img + ":" + n.direccion + ":" + n.municipio  + ":" + n.deporte + ":" + n.color;
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
                                        imagen: datosSplit[3], direccion: datosSplit[4], municipio: datosSplit[5], pista: pistaSelect,
                                        hora: horaSelect, fecha: fechaSelect,deporte:datosSplit[6],color:datosSplit[7]};

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
        }
    });

    $(".boton--add").on("click", function () {
        if (localStorage.getItem("carro") === null) {
            var reservas = [];
            reservas.push(reserva);
            localStorage.setItem("carro", JSON.stringify(reservas));
            articulos();
            console.log("hola");
            $("#addReserva").modal("hide");
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
                $("#addReserva").modal("hide");
            } else {
                $("#addReserva").modal("hide");
                $("#reservaRepetida").modal("show");

            }
        }
    });

});


