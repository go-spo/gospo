$(document).ready(function () {

    
    $.ajax({
        url: '../model/Maps/sideMaps/datosCentros.php',
        dataType: 'json',
        success: function (centros) {

            centros.forEach(n => {
                var barraLateral = document.getElementsByClassName("content_sidebar")[0];
                var centro = document.createElement("div");
                var foto = document.createElement("img");
                var nombre = document.createElement("p");
                var horaApertura = document.createElement("p");
                var horaCierre = document.createElement("p");
                var direccion = document.createElement("p");
                centro.setAttribute("class", "centro" + n.id_centro);
                foto.src = n.img_url;
                nombre.textContent = n.nombre;
                horaApertura.textContent = n.hora_apertura;
                horaCierre.textContent = n.hora_cierre;
                direccion.textContent = n.direccion;
                console.log();
                centro.appendChild(nombre);
                centro.appendChild(foto);
                centro.appendChild(horaApertura);
                centro.appendChild(horaCierre);
                centro.appendChild(direccion);
                barraLateral.insertBefore(centro, barraLateral.childNodes[0]);
                
            });

        }


    });
});


