$(document).ready(function () {

    $("#deportes-browser").on("change", function () {
        $("#ciudades-browser").empty();
        var cat = 0;
        cat = $(this).val();
        if (cat != 0) {
            $.ajax({
                url: 'model/browser/selects.php',
                dataType: 'json',
                data: "value=" + cat,
                success: function (ciudades) {
                    $("#ciudades-browser").append("<option value='0'>Ciudades</option>")
                    ciudades.forEach(n => $("#ciudades-browser").append("<option value="
                                + n.provincia + ">" + n.provincia + "</option>"));

                }
            }
            );
        } else {
            $.ajax({
                url: 'model/categories/categorias.php',
                dataType: 'json',
                data: "value=" + cat,
                success: function (ciudades) {
                    $("#ciudades-browser").append("<option value='0'>Ciudades</option>")
                    ciudades[1].forEach(n => $("#ciudades-browser").append("<option value="
                                + n.provincia + ">" + n.provincia + "</option>"));

                }
            }
            );
        }
    });

});
