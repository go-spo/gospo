$(document).ready(function () {
    var maxId = 0;
    var deportesArray = [];


    /* ====================== VER DEPORTES ============================*/

    url = '../../../vendor/GospoAPI/deportes';
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function (deportes) {
            var resultado = "";
            for (i = 0; i < deportes.length; i++) {
                resultado += "<tr><td>" + deportes[i].id_deporte + "</td>"
                        + "<td>" + deportes[i].nombre + "</td>"
                        + "<td>" + deportes[i].descripcion + "</td>"
                        + '<td class="td-actions text-right">' +
                        '<a id="btn-update-deportes-table" href="#modificar-deportes" data-toggle="tab" rel="tooltip" class="btn btn-icon btn-sm" data-toggle="tooltip" title="Modificar" style="background-color: #7e57c2; margin-right:5px;">' +
                        '<i class="material-icons">description</i>' +
                        '</a>' +
                        '</td>' + "</tr>";
//                maxId = Number.parseFloat(deportes[i].id_deporte) + 1;
                deportesArray.push(deportes[i]);
            }
            $("#center-table").html(resultado);
            $("#id-insert-deporte").val(maxId);
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
            table = document.getElementById("ver-deportes-table");
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


    /* ====================== INSERTAR DEPORTES ============================*/

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

    $("#btn-insert-deportes").click(function () {
        nombre = $("input[name='nombre-insert-deporte']").val();
        descripcion = $("input[name='descripcion-insert-deporte']").val();
        img = $("input[name='file_input_text_div']").val();

        deporteInsert = {
            nombre: nombre,
            descripcion: descripcion,
            imagen: img
        };

        deporteInsert = JSON.stringify(deporteInsert);


        $.ajax({
            url: '../../../vendor/GospoAPI/deportes',
            type: 'POST',
            dataType: 'json',
            data: deporteInsert,
            success: function (insertResult) {
                //subir imagen
                var file_data = $("input[name='file_input_img_div']").prop('files')[0];
                var form_data = new FormData();
                form_data.append('file', file_data);

                $.ajax({
                    url: '../../../model/admin/deportes/img-insert-deporte.php', // point to server-side PHP script 
                    dataType: 'text', // what to expect back from the PHP script, if anything
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function (php_script_response) {
                        window.location.href = './admin-deportes.php';
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


    /* ===================== MODIFICAR DEPORTES ==========================*/




    $("#ver-deportes").on("click", "#btn-update-deportes-table", function () {

        var datos = this.parentNode.parentNode.childNodes;



        $(".card-content-update").html('   <div id="deportes-update-form">  ' +
                '                       <div class="row">  ' +
                '                           <div class="col-md-2">  ' +
                '                               <div class="form-group label-floating">  ' +
                '                                   <label class="control-label">ID</label>  ' +
                '                                   <input type="text" id="id-update-deporte" class="form-control"  disabled>  ' +
                '                               </div>  ' +
                '                           </div>  ' +
                '                       </div>                        ' +
                '                       <div class="row">  ' +
                '                           <div class="col-md-3">  ' +
                '                               <div class="form-group label-floating">  ' +
                '                                   <label class="control-label">Nombre</label>  ' +
                '                                   <input type="text" name="nombre-update-deporte" class="form-control">  ' +
                '                               </div>  ' +
                '                           </div>  ' +
                '                       </div>  ' +
                '                       <div class="row">  ' +
                '                           <div class="col-md-8">  ' +
                '                               <div class="form-group label-floating">  ' +
                '                                   <label class="control-label">Descripción</label>  ' +
                '                                   <input type="text" name="descripcion-update-deporte" class="form-control">  ' +
                '                               </div>  ' +
                '                           </div>  ' +
                '                       </div>  ' +
                '                       <div class="row">  ' +
                '                           <div class="col-md-3">  ' +
                '                               <br>  ' +
                '                               <div class="file_input_div">  ' +
                '                                   <div class="file_input">  ' +
                '                                       <label class="image_input_button mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect mdl-button--colored">  ' +
                '                                           <i class="material-icons icon-image-insert" data-background-color="red"  >file_upload</i>  ' +
                '                                           <input  name="file_input_img_div" id="file_input_file" class="none" type="file" />  ' +
                '                                       </label>  ' +
                '                                   </div>  ' +
                '                                   <div id="file_input_text_div" class="mdl-textfield mdl-js-textfield textfield-demo">  ' +
                '                                       <input name="file_input_text_div" class="file_input_text mdl-textfield__input" type="text" disabled readonly id="file_input_text" />  ' +
                '                                       <label class="mdl-textfield__label" for="file_input_text"></label>  ' +
                '                                   </div>  ' +
                '                               </div>  ' +
                '                           </div>  ' +
                '                       </div>      ' +
                '     ' +
                '                       <button  type="submit" class="btn btn-default pull-right" style="background-color: #7e57c2" data-toggle="modal" data-target="#updateConfirm">Modificar</button>  ' +
                '                  </div>  ');


        $("#id-update-deporte").val(datos[0].innerText);
        $("input[name='nombre-update-deporte']").val(datos[1].innerText);
        $("input[name='descripcion-update-deporte']").val(datos[2].innerText);

        $("#deportes-update-form").find(".label-floating").removeClass("is-empty");

        $("#center-update").click(function () {
            nombre = $("input[name='nombre-update-deporte']").val();
            descripcion = $("input[name='descripcion-update-deporte']").val();
            img = $("input[name='file_input_text_div']").val();

            deporteInsert = {
                nombre: nombre,
                descripcion: descripcion,
                imagen: img
            };

            deporteInsert = JSON.stringify(deporteInsert);


            $.ajax({
                url: '../../../vendor/GospoAPI/deportes',
                type: 'POST',
                dataType: 'json',
                data: deporteInsert,
                success: function (insertResult) {
                    //subir imagen
                    var file_data = $("input[name='file_input_img_div']").prop('files')[0];
                    var form_data = new FormData();
                    form_data.append('file', file_data);

                    $.ajax({
                        url: '../../../model/admin/deportes/img-update-deporte.php', // point to server-side PHP script 
                        dataType: 'text', // what to expect back from the PHP script, if anything
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function (php_script_response) {
                            window.location.href = './admin-deportes.php';
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

}
);