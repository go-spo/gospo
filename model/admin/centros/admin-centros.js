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


    /* ====================== INSERTAR Y MODIIFCAR FOTOS ============================*/

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
        var nombre = $("input[name='nombre-insert-centro']").val();
        var telefono = $("input[name='telefono-insert-centro']").val();
        var email = $("input[name='email-insert-centro']").val();
        var direccion = $("input[name='direccion-insert-centro']").val();
        var municipio = $("input[name='municipio-insert-centro']").val();
        var provincia = $("input[name='provincia-insert-centro']").val();
        var pais = $("input[name='pais-insert-centro']").val();
        var img = $("input[name='file_input_text_div']").val();

        var direccionCompleta = direccion + "," + municipio + "," + provincia + "," + pais;
        $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?address=" + direccionCompleta + "&key=AIzaSyBiTt0JoSwwww7v-t8xbt_40Ph6MvxeTMY", function (data) {
            var coordenada_lat = data.results[0].geometry.location.lat;
            var coordenada_lng = data.results[0].geometry.location.lng;
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



        $(".card-content-update").html('   <div id="centros-update-form">  ' +
                '                       <div class="row">  ' +
                '                           <div class="col-md-2">  ' +
                '                               <div class="form-group label-floating">  ' +
                '                                   <label class="control-label">ID</label>  ' +
                '                                   <input type="text" class="form-control" name="id-update-centro" value="null" disabled>  ' +
                '                               </div>  ' +
                '                           </div>  ' +
                '                       </div>  ' +
                '                       <div class="row">  ' +
                '                           <div class="col-md-5">  ' +
                '                               <div class="form-group label-floating">  ' +
                '                                   <label class="control-label">Nombre</label>  ' +
                '                                   <input type="text" name="nombre-update-centro" class="form-control" disabled>  ' +
                '                               </div>  ' +
                '                           </div>  ' +
                '                           <div class="col-md-2">  ' +
                '                               <div class="form-group label-floating">  ' +
                '                                   <label class="control-label">Teléfono</label>  ' +
                '                                   <input type="text" name="telefono-update-centro" class="form-control" disabled>  ' +
                '                               </div>  ' +
                '                           </div>  ' +
                '                           <div class="col-md-5">  ' +
                '                               <div class="form-group label-floating">  ' +
                '                                   <label class="control-label">Email</label>  ' +
                '                                   <input type="email" name="email-update-centro" class="form-control" disabled>  ' +
                '                               </div>  ' +
                '                           </div>  ' +
                '                       </div>  ' +
                '                       <div class="row">  ' +
                '                           <div class="col-md-8">  ' +
                '                               <div class="form-group label-floating">  ' +
                '                                   <label class="control-label">Dirección</label>  ' +
                '                                   <input type="text" name="direccion-update-centro" class="form-control" disabled>  ' +
                '                               </div>  ' +
                '                           </div>  ' +
                '                           <div class="col-md-4">  ' +
                '                               <div class="form-group label-floating">  ' +
                '                                   <label class="control-label">Municipio</label>  ' +
                '                                   <input type="text" name="municipio-update-centro" class="form-control" disabled>  ' +
                '                               </div>  ' +
                '                           </div>  ' +
                '                       </div>  ' +
                '                       <div class="row">  ' +
                '                           <div class="col-md-4">  ' +
                '                               <div class="form-group label-floating">  ' +
                '                                   <label class="control-label">Provincia</label>  ' +
                '                                   <input  list="provincias" name="provincia-update-centro" class="form-control" disabled>  ' +
                '                                   <datalist  id="provincias">  ' +
                '                                       <option value="Valencia">  ' +
                '                                       <option value="Castellón">  ' +
                '                                       <option value="Alicante">  ' +
                '                                   </datalist>  ' +
                '                               </div>  ' +
                '                           </div>  ' +
                '                           <div class="col-md-4">  ' +
                '                               <div class="form-group label-floating">  ' +
                '                                   <label class="control-label">País</label>  ' +
                '                                   <input type="text" name="pais-update-centro" value="España" class="form-control" disabled>  ' +
                '                               </div>  ' +
                '                           </div>  ' +
                '                       </div>  ' +
                '                       <button id="btn" class="btn btn-default pull-right" style="background-color: #7e57c2" data-toggle="modal" data-target="#updateConfirm">Insertar</button>  ' +
                '</div>  ');



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

        $('.main-panel').scrollTop(100);
    });



    $("#center-update").click(function () {


        var id = $("input[name='id-update-centro']").val();
        var nombre = $("input[name='nombre-update-centro']").val();
        var telefono = $("input[name='telefono-update-centro']").val();
        var email = $("input[name='email-update-centro']").val();
        var municipio = $("input[name='direccion-update-centro']").val();
        var direccion = $("input[name='municipio-update-centro']").val();
        var provincia = $("input[name='provincia-update-centro']").val();
        var pais = $("input[name='pais-update-centro']").val();
        var img = $("input[name='file_input_text_div']").val();



        var direccionCompleta = direccion + "," + municipio + "," + provincia + "," + pais;
        $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?address=" + direccionCompleta + "&key=AIzaSyBiTt0JoSwwww7v-t8xbt_40Ph6MvxeTMY", function (data) {
            var coordenada_lat = data.results[0].geometry.location.lat;
            var coordenada_lng = data.results[0].geometry.location.lng;
            centroUpdate = {nombre: nombre,
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

            centroUpdate = JSON.stringify(centroUpdate);


            $.ajax({
                url: '../../../vendor/GospoAPI/centros/' + id,
                type: 'PUT',
                dataType: 'json',
                data: centroUpdate,
                success: function (updateResult) {
                    window.location.href = './admin-centros.php';

                }, error: function (error) {
                    alert(error.responseText);
                }

            });

        });


    });


    /* ================== BRORAR CENTROS ===========================*/


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
        $('.main-panel').scrollTop(0);
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
            error: function (xhr) {
                alert(xhr.responseText);
            }
        });
    });

});