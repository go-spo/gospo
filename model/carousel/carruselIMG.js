$(document).ready(function () {
    $.ajax({
        url: 'model/carousel/carruselIMG.php',
        dataType: 'json',
        success: function (imagenes) {
            var div1;
            var i = 0;
            imagenes.forEach(n => {
                if (i === 0) {
                    div1 = "<div class='carousel-item active' style='background-image:url(" + n.url + ")'>" +
                            "  <div class='carousel-caption d-none d-md-block'> <h3>" + n.titulo + "</h3><p>" + n.descripcion + "</p></div></div>";
                } else {
                    div1 = "<div class='carousel-item ' style='background-image:url(" + n.url + ")'>" +
                            "  <div class='carousel-caption d-none d-md-block'> <h3>" + n.titulo + "</h3><p>" + n.descripcion + "</p></div></div>";
                }
                $(".main-img-caoursel").append(div1);
                i++;
            });
        }
    });
});


