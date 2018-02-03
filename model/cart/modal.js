


$(document).ready(function () {
    articulos();



    $(".nav-item__carro").on("click", function () {

        var url = "";

        var myvar = '<div class="contenedor__carrito">' + ' <div class="carrito__productos">';
        var precioFinal = 0;

        var jcarro = localStorage.getItem("carro");
        var carro = JSON.parse(jcarro);
        if ((carro === null) || (carro.length < 1)) {
            $("#carrito__contenido").html("");
            var carroEmpty = "<h5>No tienes ningún articulo en el carro</h5>";
            $("#carrito__contenido").append(carroEmpty);
        } else {


            carro.forEach(n => {

                var url = "";
                if ((document.referrer === "http://172.16.205.8/gospo/index.html") || (document.referrer === "172.16.205.8/gospo/index.html") ||
                        (document.referrer === "http://localhost/gospo/index.html")) {

                    url = n.imagen;
                } else {
                    url = n.imagen.substring(3);
                }

                myvar += '   <div id="' + n.id + '" class="card card-cascade narrower">  ' +
                        '                <!--Card image-->  ' +
                        '                <div class="view overlay hm-white-slight">  ' +
                        '                <img src="' + url + '" class="img-fluid" alt="">  ' +
                        '                <a>  ' +
                        '                <div class="mask"></div>  ' +
                        '                </a>  ' +
                        '                </div>  ' +
                        '                <!--/.Card image-->  ' +
                        '                <a class="btn btn-circle-sm boton__carrito--cancelar">X</a>  ' +
                        '                <!--Card content-->  ' +
                        '                <div class="card-body">  ' +
                        '                <h4 style="color:' + n.color + '";><b>' + n.deporte + '</b></h4>  ' +
                        '                <!--Title-->  ' +
                        '                <h4 class="card-title">' + n.direccion + ',&nbsp;&nbsp;' + n.municipio + '</h4>  ' +
                        '                <!--Text-->  ' +
                        '                <p class="card-text"><b>Hora:' + n.hora + '</b></p>  ' +
                        '                <hr>  ' +
                        '                <p class="card-text"><b>Fecha: ' + n.fecha + '</b></p>  ' +
                        '                <hr>  ' +
                        '                <p class="card-text"><b>Precio: ' + n.precio_hora + '</b></p>  ' +
                        '                </div>  ' +
                        '               </div>  ';

                precioFinal += parseFloat(n.precio_hora);

            });

            myvar += '<hr><div class="carrito__footer">' +
                    '<div class="carrito__footer--precio-total"><strong>Precio Total: </strong><span id="carrito__precioTotal">' + precioFinal + ' €</span></div>' +
                    '</div>' +
                    '</div>';

            $("#carrito__contenido").html("");
            $("#carrito__contenido").append(myvar);

        }
        // Carga de functiones en botones del carro  //

        $(".contenedor__carrito").ready(function () {
            $(".boton__carrito--cancelar").on("click", function () {

                var id_padre = $(this).parent().attr("id");
                console.log(id_padre);
                //borra el elemento de la memoria
                listadoItems = localStorage.getItem("carro");
                items = JSON.parse(listadoItems);
                for (var i = 0; i < items.length; i++) {
                    if (items[i].id === id_padre) {
                        items.splice(i, 1);
                    }
                }
                if (items.length < 1) {
                    $(".carrito__footer--precio-total").html("");
                    $("#Modal__carrito").modal("hide");
                }
                localStorage.setItem("carro", JSON.stringify(items));
                //borra elemento del html
                var reservaBorrar = document.getElementById(id_padre);
                $($(this).parent()).addClass('animated zoomOut');
                setTimeout(function () {
                    reservaBorrar.parentNode.removeChild(reservaBorrar);
                }, 300);
                precioTotal();
                articulos();

            });
            $("#boton__vaciar").on("click", function () {
                $("#carrito__contenido").html("");


                localStorage.removeItem("carro");
                $(".nav-item__carro__contador").text("");
                $("#Modal__carrito").modal("hide");

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
            data: {carro: envio},
            success: function (reservado) {

                $("#Modal__carrito").modal("hide");
                $("#Comprar-Reservas").modal("hide");
                //llama a modal de compra con exito         
                $("#ReservaRealizada").modal("show");
                $("#carrito__contenido").html("");
                localStorage.removeItem("carro");
                $(".nav-item__carro__contador").text("");
                $('.datepicker').val("");
                $('.timepicker').val("");


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

