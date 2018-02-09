<?php ?>
<script>
    $(document).ready(function () {

        var id = <?php echo $_SESSION["id_user"] ?>;
        carga();
        function carga() {
            $.ajax({
                url: 'http://localhost/gospo/vendor/GospoAPI/usuario/' + id,
                dataType: 'json',
                type: 'GET',
                success: function (user) {
                    user.forEach(n => {

                        $("#User-nick").val(n.nick);
                        $("#User-email").val(n.email);
                        $("#User-nombre").val(n.nombre);
                        $("#User-apellido1").val(n.apellido1);
                        $("#User-apellido2").val(n.apellido2);
                        $("#User-puesto").empty();
                        $("#User-puesto").append(n.tipo_usuario);
                        $("#User-welcome").empty();
                        $("#User-welcome").append(n.nombre);
                        $("#User-DNI").val(n.dni);
                        $("#imagen-usuario").attr("src", n.foto);
                    });
                    $("#profile-update-form").find(".label-floating").removeClass("is-empty");
                }
            });
        }


        $("#cambiaDatos").on("click", function () {

            var nick = $("#User-nick").val();
            var email = $("#User-email").val();
            var nombre = $("#User-nombre").val();
            var apellido1 = $("#User-apellido1").val();
            var apellido2 = $("#User-apellido2").val();
            var pass1 = $("#User-pass1").val();
            var pass2 = $("#User-pass2").val();
            var dni = $("#User-DNI").val();
            checkMail = {"email": email, "id_usuario": id};
            checkDNI = {"dni": dni, "id_usuario": id};
            validarPass = true;
            validarDNI = true;
            validarEmail = true;
            ///////////// Comprobación password ///////////////

            if (pass1 !== pass2) {
                $("#passCheck").empty();
                $("#passCheck").append("Ambas contraseñas tienen que ser iguales");
                validarPass = false;
                ;
            } else {
                $("#passCheck").empty();
                validarPass = true;
            }
            ///////////////Comporbación Email //////////////

            $.ajax({
                url: 'http://localhost/gospo/vendor/GospoAPI/updateEmail',
                dataType: 'json',
                type: 'PUT',
                data: JSON.stringify(checkMail),
                success: function (email) {
                    if (email.status === "success") {
                        $("#mailCheck").empty();
                        validarEmail = true;
                    } else {
                        $("#mailCheck").empty();
                        $("#mailCheck").append(email.message);
                        validarEmail = false;
                    }
                }
            });
            /////////////////Comprobación de DNI ////////////

            $.ajax({
                url: 'http://localhost/gospo/vendor/GospoAPI/updateDNI',
                dataType: 'json',
                type: 'PUT',
                data: JSON.stringify(checkDNI),
                success: function (dni) {
                    if (dni.status === "success") {
                        $("#dniCheck").empty();
                        validarDNI = true;
                    } else {
                        $("#dniCheck").empty();
                        $("#dniCheck").append(dni.message);
                        validarDNI = false;
                    }
                }
            });
            ////////////////// Cambio de datos ////////////

            var waitForIt = setInterval(myTimer, 500);
            function myTimer() {
                if (validarPass === true && validarDNI === true && validarEmail === true) {

                    $("#user-cambios-update").modal("show");
                    clearInterval(waitForIt);
                }
            }
            $("#user-update").on("click", function () {
                ////////////////INSERT CON PASS ////////////
                if ($("#User-pass1").val() !== "") {
                    usuario = {"id_usuario": id, "dni": dni, "nombre": nombre, "apellido1": apellido1,
                        "apellido2": apellido2, "nick": nick, "password": pass1, "email": email};
                    $.ajax({
                        url: 'http://localhost/gospo/vendor/GospoAPI/usuario',
                        dataType: 'json',
                        type: 'PUT',
                        data: JSON.stringify(usuario),
                        success: function (user) {
                            carga();
                            $("#User-pass1").val("");
                            $("#User-pass2").val("");
                        }
                    });
                } else {
                    ////////////////INSERT SIN PASS //////////////
                    usuarioNP = {"id_usuario": id, "dni": dni, "nombre": nombre, "apellido1": apellido1,
                        "apellido2": apellido2, "nick": nick, "email": email};
                    $.ajax({
                        url: 'http://localhost/gospo/vendor/GospoAPI/usuarioNoPass',
                        dataType: 'json',
                        type: 'PUT',
                        data: JSON.stringify(usuarioNP),
                        success: function (user) {
                            carga();
                        }
                    });
                }
                //////// CANCELAR MODIFICACIÓN /////////
            });
            $("#Cancel-user-update").on("click", function () {
                carga();
            });
        });

        ////////////////// Imagen de usuario ////////////
        $("#selectedFile").change(function () {
            var file_data = $('#selectedFile').prop('files')[0];
            var ruta = '../../../resources/img/usuarios/' + file_data["name"];
         
            var form_data = new FormData();
            form_data.append('file', file_data);
            $.ajax({
                url: '../../../model/admin/users/img-user.php', // point to server-side PHP script
                dataType: 'text', // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (php_script_response) {
// alert(php_script_response); // display response from the PHP script, if any
                    $("#imagen-usuario").attr("src", '../../../resources/img/usuarios/' + file_data["name"]);
                    var jsonImg = {"id_usuario": id, "foto": ruta};
                    $.ajax({
                        url: 'http://localhost/gospo/vendor/GospoAPI/usuarioFoto', // point to server-side PHP script
                        dataType: 'json', // what to expect back from the PHP script, if anything
                        data: JSON.stringify(jsonImg),
                        type: 'PUT',
                        success: function (php_script_response) {

                        },
                        error: function (error) {
                            alert(JSON.stringify(jsonImg));
                        }
                    });
                },
                error: function (error) {
                    alert(error.responseText);
                }

            });
        });
    });
</script>