


$(document).ready(function () {
    articulos();


    $(".nav-item__carro").on("click", function () {

        var url = "";
        if (document.referrer === "http://localhost/gospo/index.html") {
            url = "url(\'../resources/img/Centros/olimpia.jpg\')";
        } else {
            url = "url(\'resources/img/Centros/olimpia.jpg\')";
        }

        var myvar = '<div class="contenedor__carrito">' + ' <div class="carrito__productos">';
        var precioFinal = 0;

        var jcarro = localStorage.getItem("carro");
        var carro = JSON.parse(jcarro);


        carro.forEach(n => {

            var url = "";
            if (document.referrer === "http://localhost/gospo/index.html") {
                url = "url(\'" + n.imagen + "\')";
            } else {
                url = "url(\'" + n.imagen.substring(3) + "\')";
            }
            myvar += '<div id="' + n.id + '"class="carrito__item">' +
                    ' <div class="carrito__item__imagen" style="background-image:' + url + ';" ></div>' +
                    ' <div class="carrito__valores">' +
                    '<div class="carrito__item__descripcion">' + n.direccion + '<p>' + n.municipio + '</p></div>' +
                    '<div class="carrito__item__horario"><strong>Hora inicio:</strong>' + n.hora + '<p><strong>Fecha: </strong>' + n.fecha + '</p> </div>' +
                    '<div class="carrito__item__precio"><strong>Precio:</strong>' + n.precio_hora + '€</div>' +
                    ' <div class="carrito__item__boton"><button type="button" class="boton__carrito--cancelar"><i class="fas fa-times-circle"></i></button></div></div><hr></div></div>';
            precioFinal += parseFloat(n.precio_hora);
        });

        myvar += '<div class="carrito__footer">' +
                '<div class="carrito__footer--precio-total"><strong>Precio Total: </strong><span id="carrito__precioTotal">' + precioFinal + ' €</span></div>' +
                '</div>' +
                '</div>';

        $("#carrito__contenido").html("");
        $("#carrito__contenido").append(myvar);


        // Carga de functiones en botones del carro  //

        $(".contenedor__carrito").ready(function () {
            $(".boton__carrito--cancelar").on("click", function () {

                var id_padre = $(this).parent().parent().parent().attr("id");
                console.log(id_padre);
                //borra el elemento de la memoria
                listadoItems = localStorage.getItem("carro");
                items = JSON.parse(listadoItems);
                for (var i = 0; i < items.length; i++) {
                    if (items[i].id === id_padre) {
                        items.splice(i, 1);
                    }
                }
                localStorage.setItem("carro", JSON.stringify(items));
                //borra elemento del html
                var reservaBorrar = document.getElementById(id_padre);
                reservaBorrar.parentNode.removeChild(reservaBorrar);
                precioTotal();
                articulos();
            });
            $("#boton__vaciar").on("click", function () {
                $("#carrito__contenido").html("");


                localStorage.removeItem("carro");
                $(".nav-item__carro__contador").text("");

            });
            $("#boton__reservar").on("click", function () {
                $("#Comprar-Reservas").modal("show");
                

            });
        });
    });
    $(".boton--pagar-reservar").on("click", function () {
        var envio = localStorage.getItem("carro");


        $.ajax({
            url: '/gospo/model/cart/reservas.php',
            type: 'POST',
            dataType: 'json',
            data: {carro: envio},           
            success: function (reservado) {
                alert("si va");
            }


        });
    });

});

function articulos() {
    if (localStorage.getItem("carro") !== null) {
        var jcarro = localStorage.getItem("carro");
        var carro = JSON.parse(jcarro);
        var cantidad = carro.length;
        if (cantidad >= 1) {
            $(".nav-item__carro__contador").text(cantidad);
        } else {
            $(".nav-item__carro__contador").text("");
        }
    }
}
;

function precioTotal() {
    var jcarro = localStorage.getItem("carro");
    var carro = JSON.parse(jcarro);
    var total = 0;
    carro.forEach(n => {
        total += parseFloat(n.precio_hora);
    });
    $("#carrito__precioTotal").text(total + " €");

}
;

