$(document).ready(function () {
    $.ajax({
        url: 'model/categories/categorias.php',
        dataType: 'json',
        success: function (miCategorias) {
            
            miCategorias[0].forEach(n => $("#deportes-browser").append("<option value="
                        + n.id_deporte + ">" + n.nombre + "</option>"));
                
            miCategorias[1].forEach(n => $("#ciudades-browser").append("<option value="
                        + n.provincia + ">" + n.provincia + "</option>"));
        }
    });
});