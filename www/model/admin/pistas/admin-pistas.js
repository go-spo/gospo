$(document).ready(function () {
    var maxId = 0;
    var pistasArray = [];
    /*
     $("#ver").click(function () {
     idver = $("#id").val();
     });
     if (idver !== "") {
     url = 'GospoAPI/pistas/' + idver;
     } else {
     
     }
     */

    /* ====================== VER PISTAS ============================*/

    url = '../../../vendor/GospoAPI/pistas';
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function (pistas) {
            console.log(pistas);
            var resultado = "";
            for (i = 0; i < pistas.length; i++) {
                
                resultado += "<tr><td>" + pistas[i].nombreDeporte + "</td>"
                        + "<td>" + pistas[i].nombreCentro + "</td>"
                        + "<td>" + pistas[i].numero_pista + "</td>"
                        + "<td>" + pistas[i].precio_hora + "</td>"
                        + "<td>" + pistas[i].hora_apertura + "</td>"
                        + "<td>" + pistas[i].hora_cierre + "</td>"
                        + "</tr>";
//                maxId = Number.parseFloat(pistas[i].id_pista) + 1;
                pistasArray.push(pistas[i]);
            }
            $("#center-table").html(resultado);
            $("#id-insert-pista").val(maxId);
        },
        error: function (error) {
            alert(error.responseText);
        }
    });
    /*------------- FILTRO ---------------*/
    /*LIMPIAR AL CLICK*/
    $(function () {
        $('#input-search').on('keyup', function () {
            var encontradas = [];
            var input, filter, table, tr, i;
            input = document.getElementById("input-search");
            filter = input.value.toUpperCase();
            table = document.getElementById("ver-pistas-table");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {

                for (var j = 0; j < tr[i].getElementsByTagName("td").length; j++) {
                    tr[i].style.display = "none";
                    if (tr[i].getElementsByTagName("td")[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                        encontradas.push(tr[i]);
                    }
                }
                for (var k = 0; k < encontradas.length; k++) {
                    encontradas[k].style.display = "";
                }
            }
        });
    });


    /* ====================== INSERTAR PISTAS ============================*/

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



    $("#btn-insert-pistas").click(function () {
        deporte = $("input[name='deporte-insert-pista']").val();
        centro = $("input[name='centro-insert-pista']").val();
        numero = $("input[name='numero-insert-pista']").val();
        precio = $("input[name='precio-insert-pista']").val();
        apertura = $("input[name='apertura-insert-pista']").val();
        cierre = $("input[name='cierre-insert-pista']").val();
//        img = $("input[name='file_input_text_div']").val();

        pistaInsert = {deporte: deporte,
            centro: centro,
            numero_pista: numero,
            precio_hora: precio,
            hora_apertura: apertura,
            hora_cierre: cierre
        };

        pistaInsert = JSON.stringify(pistaInsert);


        $.ajax({
            url: '../../../vendor/GospoAPI/pistas',
            type: 'POST',
            dataType: 'json',
            data: pistaInsert,
            success: function (insertResult) {
                //subir imagen
                var file_data = $("input[name='file_input_img_div']").prop('files')[0];
                var form_data = new FormData();
                form_data.append('file', file_data);

                $.ajax({
                    url: '../../../model/admin/pistas/img-insert-pista.php', // point to server-side PHP script 
                    dataType: 'text', // what to expect back from the PHP script, if anything
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function (php_script_response) {
                        window.location.href = './admin-pistas.php';
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


    /* ===================== MODIFICAR PISTAS ==========================*/

    $("#ver-pistas").on("click", "#btn-update-pistas-table", function () {

        var datos = this.parentNode.parentNode.childNodes;

        $("input[name='deporte-update-pista']").val(datos[0].innerText);
        $("input[name='centro-update-pista']").val(datos[1].innerText);
        $("input[name='numero-update-pista']").val(datos[2].innerText);
        $("input[name='precio-update-pista']").val(datos[3].innerText);
        $("input[name='apertura-update-pista']").val(datos[4].innerText);
        $("input[name='cierre-update-pista']").val(datos[5].innerText);

        $("#pistas-update-form").find(".label-floating").removeClass("is-empty");
        $("#pistas-update-form").find("input").prop("disabled", false);
        $("input[name='id-update-pista']").prop("disabled", true);
        $("input[name='pais-update-pista']").prop("disabled", true);


    });

    /* ===================== ELIMINAR PISTAS ==========================*/

    $("#ver-pistas").on("click", "#btn-delete-pistas-table", function () {
        pistaSeleccionadoDelete = this.parentNode.parentNode;
        pistaSeleccionadoDelete.removeChild(pistaSeleccionadoDelete.lastChild);
        $(".card-content-delete").html('<table id="ver-pistas-table" class="table table-hover">' +
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
        $("#center-table-delete").html(pistaSeleccionadoDelete);
    });


    $("#center-delete").click(function () {
        $.ajax({
            url: "../../../vendor/GospoAPI/pistas/" + pistaSeleccionadoDelete.childNodes[0].innerHTML,
            type: 'DELETE',
            success: function () {
                alert("borrado");
                $(".card-content-delete").html('<br>' +
                        '<h4>Para eliminar un pista seleccionelo en  ' +
                        '<a href="#ver-pistas" data-toggle="tab" rel="tooltip">' +
                        '<i>ver pistas</i>' +
                        '</a>' +
                        '</h4>' +
                        '<br>');
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });
}
);