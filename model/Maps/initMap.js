function initMap() {
    var markadores = [];
    var centrado = {lat: 39.478758, lng: -0.414405};

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 11,
        center: centrado
    });
    $.ajax({

        url: '../model/Maps/initMap.php',
        dataType: 'json',
        success: function (markers) {

            markers.forEach(n => {
                var posicion = new google.maps.LatLng(n.coordenada_x, n.coordenada_y);

                var infowindow = new google.maps.InfoWindow({
                    content: n.nombre
                });
                var marker = new google.maps.Marker({
                    position: posicion,
                    map: map,

                    _value: n.id_centro


                });
                marker.addListener('click', function () {
                    infowindow.open(map, marker);

                    var id = this._value;

                    ///////fumada ajax anidado
                    $.ajax({
                        url: '../model/Maps/sideMaps/datosSeleccionado.php',
                        dataType: 'json',

                        data: "value=" + id,
                        success: function (seleccionado) {
                            
                            seleccionado.forEach(n => {
                                var barraLateral = document.getElementById("center-result");
                                barraLateral.innerHTML="";
                                
                                var centro = document.createElement("div");
                                var foto = document.createElement("img");
                                var nombre = document.createElement("p");
                                var horaApertura = document.createElement("p");
                                var horaCierre = document.createElement("p");
                                var direccion = document.createElement("p");
                                var municipio = document.createElement("p");
                                var provincia = document.createElement("p");
                                var pais = document.createElement("p");
                                centro.setAttribute("class", "centro" + n.id_centro);
                                foto.src = n.img_url;
                                nombre.textContent = n.nombre;
                                horaApertura.textContent = "Hora de apertura: "+n.hora_apertura;
                                horaCierre.textContent = "Hora de cierre: " +n.hora_cierre;
                                direccion.textContent = "Calle :" +n.direccion;
                                municipio.textContent = "Población :" +n.municipio;
                                provincia.textContent = "Provincia: "+n.provincia;
                                pais.textContent = "Pais: " +n.pais;
//                                
                                centro.appendChild(nombre);
                                centro.appendChild(foto);
                                centro.appendChild(horaApertura);
                                centro.appendChild(horaCierre);
                                centro.appendChild(direccion);
                                centro.appendChild(municipio);
                                centro.appendChild(provincia);
                                centro.appendChild(pais);

                                barraLateral.insertBefore(centro, barraLateral.childNodes[0]);

                            });

                        }
                    });
                    //////
                });

            });
        }
    });
}

