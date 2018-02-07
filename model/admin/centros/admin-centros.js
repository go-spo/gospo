$(document).ready(function () {
    var maxId = 0;
    var centrosArray = [];
    /*
     $("#ver").click(function () {
     idver = $("#id").val();
     });
     if (idver !== "") {
     url = 'GospoAPI/centros/' + idver;
     } else {
     
     }
     */

    /* ====================== VER CENTROS ============================*/

    url = '../../../vendor/GospoAPI/centros';
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function (centros) {
            var resultado = "";
            for (i = 0; i < centros.length; i++) {
                resultado += "<tr><td>" + centros[i].id_centro + "</td>"
                        + "<td>" + centros[i].nombre + "</td>"
                        + "<td>" + centros[i].telefono + "</td>"
                        + "<td>" + centros[i].email + "</td>"
                        + "<td>" + centros[i].direccion + "</td>"
                        + "<td>" + centros[i].municipio + "</td>"
                        + "<td>" + centros[i].provincia + "</td>"
                        + "<td>" + centros[i].pais + "</td>"
                        + '<td class="td-actions text-right">' +
                        '<a id="btn-update-centros-table" href="#modificar-centros" data-toggle="tab" rel="tooltip" class="btn btn-icon btn-sm" data-toggle="tooltip" title="Modificar" style="background-color: #7e57c2; margin-right:5px;">' +
                        '<i class="material-icons">description</i>' +
                        '</a>' +
                        '<a id="btn-delete-centros-table" href="#eliminar-centros" data-toggle="tab" rel="tooltip" class="btn btn-danger btn-icon btn-sm" data-toggle="tooltip" title="Borrar">' +
                        '<i class="material-icons">delete_forever</i>' +
                        '</a>' +
                        '</td>' + "</tr>";
                maxId = Number.parseFloat(centros[i].id_centro) + 1;
                centrosArray.push(centros[i]);
            }
            $("#center-table").html(resultado);
            $("#id-insert-centro").val(maxId);
        },
        error: function (error) {
            alert(error.responseText);
        }
    });
    /*------------- FILTRO ---------------*/
    /*LIMPIAR AL CLICK*/
    $(function () {
        $('#input-search').on('keyup', function () {
            var econtradas = [];
            var input, filter, table, tr, i;
            input = document.getElementById("input-search");
            filter = input.value.toUpperCase();
            table = document.getElementById("ver-centros-table");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {

                for (var j = 0; j < tr[i].getElementsByTagName("td").length; j++) {
                    tr[i].style.display = "none";
                    if (tr[i].getElementsByTagName("td")[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                        econtradas.push(tr[i]);
                    }
                }
                for (var k = 0; k < econtradas.length; k++) {
                    econtradas[k].style.display = "";
                }
            }
        });
    });


    /* ====================== INSERTAR CENTROS ============================*/

    var fileInputTextDiv = document.getElementById('file_input_text_div');
    var fileInput = document.getElementById('file_input_file');
    var fileInputText = document.getElementById('file_input_text');

    fileInput.addEventListener('change', changeInputText);
    fileInput.addEventListener('change', changeState);

    function changeInputText() {
        var str = fileInput.value;
        var i;
        if (str.lastIndexOf('\\')) {
            i = str.lastIndexOf('\\') + 1;
        } else if (str.lastIndexOf('/')) {
            i = str.lastIndexOf('/') + 1;
        }
        fileInputText.value = str.slice(i, str.length);
    }

    function changeState() {
        if (fileInputText.value.length != 0) {
            if (!fileInputTextDiv.classList.contains("is-focused")) {
                fileInputTextDiv.classList.add('is-focused');
            }
        } else {
            if (fileInputTextDiv.classList.contains("is-focused")) {
                fileInputTextDiv.classList.remove('is-focused');
            }
        }
    }



    $("#btn-insert-centros").click(function () {
        nombre = $("input[name='nombre-insert-centro']").val();
        telefono = $("input[name='telefono-insert-centro']").val();
        email = $("input[name='email-insert-centro']").val();
        direccion = $("input[name='direccion-insert-centro']").val();
        municipio = $("input[name='municipio-insert-centro']").val();
        provincia = $("input[name='provincia-insert-centro']").val();
        pais = $("input[name='pais-insert-centro']").val();
        img = $("input[name='file_input_text_div']").val();

        /*
         imagen = "../resources/img/centros/" + $("#imagen").val().split('\\').pop();
         */
        var direccionCompleta = direccion + "," + municipio + "," + provincia + "," + pais;
        $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?address=" + direccionCompleta + "&key=AIzaSyBiTt0JoSwwww7v-t8xbt_40Ph6MvxeTMY", function (data) {
            coordenada_lat = data.results[0].geometry.location.lat;
            coordenada_lng = data.results[0].geometry.location.lng;
            centroInsert = {nombre: nombre,
                telefono: telefono,
                email: email,
                municipio: municipio,
                direccion: direccion,
                provincia: provincia,
                pais: pais,
                coordenada_x: coordenada_lat,
                coordenada_y: coordenada_lng,
                url_img: "../resources/img/centros/" + img
            };

            centroInsert = JSON.stringify(centroInsert);


            $.ajax({
                url: '../../../vendor/GospoAPI/centros',
                type: 'POST',
                dataType: 'json',
                data: centroInsert,
                success: function (insertResult) {
                    //subir imagen
                    var file_data = $("input[name='file_input_img_div']").prop('files')[0];
                    var form_data = new FormData();
                    form_data.append('file', file_data);

                    $.ajax({
                        url: '../../../model/admin/centros/img-insert-centro.php', // point to server-side PHP script 
                        dataType: 'text', // what to expect back from the PHP script, if anything
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function (php_script_response) {
                            window.location.href = './admin-centros.php';
                        },
                        error: function (error) {
                            alert(error.responseText);
                        }
                    });

                }, error: function (error) {
                    alert(error.responseText);
                }

            });

        });
    });


    /* ===================== MODIFICAR CENTROS ==========================*/

    $("#ver-centros").on("click", "#btn-update-centros-table", function () {

        var datos = this.parentNode.parentNode.childNodes;

        $("input[name='id-update-centro']").val(datos[0].innerText);
        $("input[name='nombre-update-centro']").val(datos[1].innerText);
        $("input[name='telefono-update-centro']").val(datos[2].innerText);
        $("input[name='email-update-centro']").val(datos[3].innerText);
        $("input[name='direccion-update-centro']").val(datos[4].innerText);
        $("input[name='municipio-update-centro']").val(datos[5].innerText);
        $("input[name='provincia-update-centro']").val(datos[6].innerText);
        $("input[name='pais-update-centro']").val(datos[7].innerText);
        
        $("#centros-update-form").find(".label-floating").removeClass("is-empty");
        $("#centros-update-form").find("input").prop("disabled", false);
        $("input[name='id-update-centro']").prop("disabled", true);
        $("input[name='pais-update-centro']").prop("disabled", true);


    });

    $("#ver-centros").on("click", "#btn-delete-centros-table", function () {
        centroSeleccionadoDelete = this.parentNode.parentNode;
        centroSeleccionadoDelete.removeChild(centroSeleccionadoDelete.lastChild);
        $(".card-content-delete").html('<table id="ver-centros-table" class="table table-hover">' +
                '<thead class="text-danger">' +
                '<th>ID</th>' +
                '<th>Nombre</th>' +
                '<th>Telefono</th>' +
                '<th>Email</th>' +
                '<th>Dirección</th>' +
                '<th>Municipio</th>' +
                '<th>Provincia</th>' +
                '<th>País</th>' +
                '</thead>' +
                '<tbody id="center-table-delete">' +
                '</tbody>' +
                '</table>' +
                '<button class="btn btn-primary btn-danger pull-right" data-toggle="modal" data-target="#deleteConfirm">Eliminar</button>');
        $("#center-table-delete").html(centroSeleccionadoDelete);
    });


    $("#center-delete").click(function () {
        $.ajax({
            url: "../../../vendor/GospoAPI/centros/" + centroSeleccionadoDelete.childNodes[0].innerHTML,
            type: 'DELETE',
            success: function () {
                alert("borrado");
                $(".card-content-delete").html('<br>' +
                        '<h4>Para eliminar un centro seleccionelo en  ' +
                        '<a href="#ver-centros" data-toggle="tab" rel="tooltip">' +
                        '<i>ver centros</i>' +
                        '</a>' +
                        '</h4>' +
                        '<br>');
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

});