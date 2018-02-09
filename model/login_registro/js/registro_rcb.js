$(document).ready(function () {

    console.log(document.referrer);

    comprobarSesionEstablecida();

    $.ajaxSetup({// establece el código a ejecutar en caso de error en todas las llamadas ajax que se realicen

        error: function (jqXHR, textStatus, errorThrown) {

            switch (jqXHR.status) {

                case 0 :
                    alert('Not connect: Verify Network.');
                    break;
                case 404 :
                    alert('Requested page not found [404]');
                    break;
                case 500:
                    alert('Internal Server Error [500].');
                    break;
                case 301:
                    alert('Redirección permanente [301].');
                    break;
                case 302:
                    alert('Redirección temporal [302].');
                    break;
                case 'parsererror':
                    alert('Requested JSON parse failed.');
                    break;
                case 'timeout':
                    alert('Time out error.');
                    break;
                case 'abort':
                    alert('Ajax request aborted.');
                    break;
                    // default: alert('Uncaught Error: ' + 'responseText: '+ jqXHR.responseText + 'errorThrown: '+ errorThrown + 'textStatus: '+ textStatus);
                    //    break;
            }

        }
    });


    // evento desencadena llamada ajax para login
    $('#btn-login').on('click', function () {
        enviarDatosLogin();
        //$(idBoton).remove('click');
    });

    // evento desencadena llamada ajax para logout
    $('#salir').on('click', function () {

        if ($('#label-user').text() === "") {
            $('#salir').remove('click');
        } else {
            logout();
        }

    });

    inputs = $('#form-sign-up input');
    console.log(inputs);
    console.log(inputs.length);
    inputs_ = $('#form-sign-in input');
    console.log(inputs_);
    console.log(inputs_.length);

    // limpiar formulario login y registro

    function limpiarDatosForms() {
        //resetear formularios

        $.each(inputs, function (idx, val) {

            $(this).val('');
        });
        $.each(inputs_, function (idx, val) {

            $(this).val('');
        });

        //mostrar todas las etiquetas
        $('label.etiqueta').show();

    }

    //abrir login landpage
    $('#abrir').on('click', function () {

        $('#modalLRForm').modal('show');

        inputs = $('#form-sign-up input');
        inputs_ = $('#form-sign-in input');

        vincularEventos();
        vincularEventos_();

        $('#btn-login').attr("disabled", "disabled");


    });


    // vincular eventos
    function vincularEventos() {

        $.each(inputs, function (idx, val) {

            $(this).on('focusin', function () {
                $(this).next().hide();
            });
        });

        $.each(inputs, function (idx, val) {

            $(this).on('focusout', function () {
                if ($(this).val() !== "") {
                    // no hacer nada
                } else {
                    $(this).next().show();
                }

            });
        });
    }

    function desvincularEventos() {

        $.each(inputs, function (idx, val) {

            $(this).off('focusin');
        });

        $.each(inputs, function (idx, val) {

            $(this).on('focusout');
        });

    }

    // vincular eventos
    function vincularEventos_() {

        $.each(inputs_, function (idx, val) {

            $(this).on('focusin', function () {
                $(this).next().hide();
            });
        });

        $.each(inputs_, function (idx, val) {

            $(this).on('focusout', function () {
                if ($(this).val() !== "") {
                    // no hacer nada
                } else {
                    $(this).next().show();
                }

            });
        });
    }

    function desvincularEventos_() {

        $.each(inputs_, function (idx, val) {

            $(this).off('focusin');
        });

        $.each(inputs_, function (idx, val) {

            $(this).on('focusout');
        });

    }


    //gestión de los links enlazados en ambos formularios

    $('#registrate').on('click', function () {
        $('#tabregistro').attr("class", "nav-link active");
        $('#panel7').attr("class", "tab-pane fade");
        $('#tablogin').attr("class", "nav-link");
        $('#panel8').attr("class", "tab-pane fade in show active");
    });

    $('#linklogin').on('click', function () {
        $('#tablogin').attr("class", "nav-link active");
        $('#panel8').attr("class", "tab-pane fade");
        $('#tabregistro').attr("class", "nav-link ");
        $('#panel7').attr("class", "tab-pane fade in show active");
    });

    //cerrar ventana modal registro
    $('#cerrar').on('click', function () {
        desvincularEventos();
        limpiarDatosForms();
        $('#modalLRForm').fadeOut('3000');
        location.reload(true);
    });

    //cerrar ventana modal login
    $('#cerrarlogin').on('click', function () {
        desvincularEventos_();
        limpiarDatosForms();
        $('#modalLRForm').fadeOut('3000');
        location.reload(true);
    });

    /* LOCAL STORAGE
     
     localStorage.setItem('label-usuario', 'Usuario');
     //rellenar div con nombre e icono
     labelusuario = localStorage.getItem('label-usuario');
     $('#label-user').text(" " + labelusuario);
     
     */


    function comprobarSesionEstablecida() {
        var text = 'enviado';

        var url = "";
        url = '../model/login_registro/php/checksession.php';

        $.ajax({

            url: url,
            type: 'post',
            dataType: 'json',
            data: {secure: text},
            success: function (sesion) {
                console.log(sesion);
                if (sesion.establecida === 'true') {
                    var valorusuario = sesion.usuario;
                //    $('#label-user').text(" " + valorusuario);   DESCOMENTAR PARA USUARIOS DEPORTISTAS
                    //return true;
                } else {

                    //return false;
                }
            }

        });
    }

    //enviar login
    function enviarDatosLogin() {

        var emailenviar = $('#youremail').val();
        var passenviar = $('#yourpassword').val();
        var datosEnviar = {youremail: emailenviar, yourpassword: passenviar};
        var url = "";
        url = '../model/login_registro/php/login2.php';

        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: datosEnviar,
            success: function (data) {
                if (data.status === 'successgerente') {
                    limpiarDatosForms();
                    desvincularEventos();
                    $('#modalLRForm').modal('hide');  //fadeOut('3000')
                    window.location = "admin/centros/admin-index.php";
                } else if (data.status === 'successuser') {
                    //alert(data.message);
                  //  var usuario = data.usuario;
                    //rellenar div con nombre e icono
                  //  $('#label-user').text(" " + usuario);  DESCOMENTAR PARA LOGIN USUARIOS DEPORTISTA
                    limpiarDatosForms();
                    desvincularEventos_();
                    $('#modalLRForm').modal('hide');
                    location.reload(true);
                    // window.location = window.location.href;

                } else if (data.status === 'erroracceso') {
                    alert(data.message);
                    limpiarDatosForms();
                    //$("#info-email").hide();
                    //$("#info-pwd").hide();
                   // desvincularEventos_();
                   // $('#modalLRForm').modal('hide');
                   // window.location = window.location.href;
                   // location.reload(true);

                } else if (data.status === 'errornoregistrado') {
                    alert(data.message);
                    limpiarDatosForms();
                    //$("#info-email").hide();
                    //$("#info-pwd").hide();
                   // desvincularEventos_();
                   // $('#modalLRForm').modal('hide');
                   // window.location = window.location.href;
                   // location.reload(true);
                   setTimeout(function () {
                        $("#form-sign-in").trigger('reset');
                        $('#tabregistro').attr("class", "nav-link active");
                        $('#panel7').attr("class", "tab-pane fade");
                        $('#tablogin').attr("class", "nav-link");
                        $('#panel8').attr("class", "tab-pane fade in show active");
                        // $('#modalLRForm').modal('hide');
                        //location.reload(true);
                    }, 1000);
                }

            }
        });
    }


    function logout() {
        var text = 'enviado';
        var url = '';
        url = '../model/login_registro/php/unsetsession.php';

        $.ajax({

            url: url,
            type: 'post',
            dataType: 'json',
            data: {secure: text},
            success: function (sesion) {
                console.log("lasesión es " + sesion);
                if (sesion.logout === 'true') {
                    $('#label-user').text(" ");
                    $("#carrito__contenido").html("");
                    localStorage.removeItem("carro");
                    $(".nav-item__carro__contador").text("");
                    $("#Modal__carrito").modal("hide");

                } else {

                    //nothing
                }
            }

        });

    }

    /*     
     * 
     *   ,
     error: function(php_script_response){
     
     //alert(php_script_response);
     }                        
     setTimeout(function(){
     $("#form-sign-in").trigger('reset');
     $('#tabregistro').attr("class", "nav-link active");
     $('#panel7').attr("class", "tab-pane fade");
     $('#tablogin').attr("class", "nav-link");
     $('#panel8').attr("class", "tab-pane fade in show active");
     // $('#modalLRForm').modal('hide');
     //location.reload(true);
     }, 1500);  */




    // ======================================================================================================                     

    //METODOS DE VALIDACIÓN 
    regexPWD = /(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,12}$/;
    //regexPWD = /(?=.*d)(?=.*[a-z])(?=.*[A-Z]).{8,12}$/;
    regexNombre = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/;
    regexEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    // validación password
    function passwordchecker(value) {
        return regexPWD.test(value);
    }
    ;

    // validación nombre y apellidos
    function namechecker(value) {
        return regexNombre.test(value);
    }

    // validación email
    function emailchecker(value) {
        return regexEmail.test(value);
    }
    ;

    // validación dni
    function dnichecker(value) {
        return validar(value);
    }


    function validar(value) {

        var validChars = 'TRWAGMYFPDXBNJZSQVHLCKET';
        var nifRexp = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKET]$/i;
        var nieRexp = /^[XYZ][0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKET]$/i;
        var str = value.toString().toUpperCase();

        if (!nifRexp.test(str) && !nieRexp.test(str))
            return false;

        var nie = str
                .replace(/^[X]/, '0')
                .replace(/^[Y]/, '1')
                .replace(/^[Z]/, '2');

        var letter = str.substr(-1);
        var charIndex = parseInt(nie.substr(0, 8)) % 23;

        if (validChars.charAt(charIndex) === letter)
            return true;

        return false;
    }


    $('#youremail').on('keypress focusout', function () {
        var texto = $('#youremail').val();
       checkForm("#btn-login");
        if (texto === "") {
            $('#info-email').text('Campo requerido');
            $('#info-email').attr("class", "error");
            checkForm("#btn-login");
        } else {
            emailOK = emailchecker(texto);
            if (!emailOK) {
                $('#info-email').text('La dirección de email debe contener @ y .');
                $('#info-email').attr("class", "error");
                checkForm("#btn-login");
            } else {
                
                $('#info-email').text('ok');
                $('#info-email').attr("class", "valid");
                checkForm("#btn-login");
            }
        }

    });

    $('#yourpassword').on('keyup focusout', function () {
        var texto1 = $('#yourpassword').val();
        checkForm("#btn-login");
        if (texto1 === "") {
            $('#info-pwd').text('Campo requerido');
            $('#info-pwd').attr("class", "error");
            checkForm("#btn-login");
        } else {
            pwdOK = passwordchecker(texto1);
            if (!pwdOK) {
                $('#info-pwd').text('Mínimo de 8 caracteres, mayúscula, minúscula y número');
                $('#info-pwd').attr("class", "error");
                checkForm("#btn-login");

            } else {
                pwdOK = true;
                $('#info-pwd').text('ok');
                $('#info-pwd').attr("class", "valid");
                checkForm("#btn-login");
            }
        }

    });

    // activación desactivación del submit

    function enableSubmit(idBoton) {
        $(idBoton).removeAttr("disabled");
    }

    function disableSubmit(idBoton) {
        $(idBoton).attr("disabled", "disabled");
    }

    /*
     function preventDef(event) {
     event.preventDefault();
     }
     */

    // checkeo del formulario para activar/desactivar botón envío
    function checkForm(idBoton) {
        correctoEmail = $('#youremail').val();
        correctaPass = $('#yourpassword').val();
        if (emailchecker(correctoEmail) && passwordchecker(correctaPass)) {
            enableSubmit(idBoton);

        } else {
            disableSubmit(idBoton);
        }
    }
    ;



    // ===============================================================
    // ===============================================================

    $('#email').on('keyup focusout focusin', function () {
        var texto = $('#email').val();
        checkForm2("#btn-registro");
        if (texto === "") {
            $('#iemail').text('Campo requerido');
            $('#iemail').attr("class", "error");
            checkForm2("#btn-registro");
        } else {
            var emailB = emailchecker(texto);
            if (!emailB) {
                $('#iemail').text('La dirección de email debe contener @ y .');
                $('#iemail').attr("class", "error");
                checkForm2("#btn-registro");

            } else {

                $('#iemail').text('ok');
                $('#iemail').attr("class", "valid");
                checkForm2("#btn-registro");
            }
        }

    });

   /*
    $("#email").on('focusout', function () {  //TODO ELEGIR EVENTO
        var datoEmail = $("#email").val();
        comprobarEmailBD(datoEmail);    
    });
*/

function comprobarEmailBD(datoEmail){
        
        var emailG = emailchecker(datoEmail);
        var datosjson = {'email': datoEmail};
        var datos = JSON.stringify(datosjson);
        if (emailG) {

            $.ajax({
                url: 'http://localhost/gospo/vendor/GospoAPI/checkEmail',  //ruta amigable API
                //url: "model/login_registro/php/emailchecker.php",  
                type: "POST",
                data: datos,
                success: function (resp) {

                    if (resp.status === "success") {
                       return true;

                    } else {
                        $('#iemail').text('Email ya registrado');
                        return false;
                        
                    }
                }
            });
        }
}

    $('#password').on('keyup focusout focusin', function () {
        var texto1 = $('#password').val();
        checkForm2("#btn-registro");
        if (texto1 === "") {
            $('#ipassword').text('Campo requerido');
            $('#ipassword').attr("class", "error");
            checkForm2("#btn-registro");
        } else {
            var pwdB = passwordchecker(texto1);
            if (!pwdB) {
                $('#ipassword').text('Mínimo de 8 caracteres, mayúscula, minúscula y número');
                $('#ipassword').attr("class", "error");
                checkForm2("#btn-registro");

            } else {
                
                $('#ipassword').text('ok');
                $('#ipassword').attr("class", "valid");
                checkForm2("#btn-registro");
            }
        }

    });
    
    

    $('#dni').on('keyup focusout focusin', function () {
        var texto1 = $('#dni').val();
        checkForm2("#btn-registro");
        if (texto1 === "") {
            $('#idni').text('Campo requerido');
            $('#idni').attr("class", "error");
            checkForm2("#btn-registro");
        } else {
            var dniOK = dnichecker(texto1);
            if (!dniOK) {
                $('#idni').text('El dni no tiene el formato adecuado o es incorrecto');
                $('#idni').attr("class", "error");
                checkForm2("#btn-registro");

            } else {
                dniOK = true;
                $('#idni').text('ok');
                $('#idni').attr("class", "valid");
                checkForm2("#btn-registro");
            }
        }

    });

    $('#nombre').on('keyup focusout focusin', function () {
        var texto1 = $('#nombre').val();
        checkForm2("#btn-registro");
        if (texto1 === "") {
            $('#inombre').text('Campo requerido');
            $('#inombre').attr("class", "error");
            checkForm2("#btn-registro");
        } else {
            var nameOK = namechecker(texto1);
            if (!nameOK) {
                $('#inombre').text('El nombre no debe contener números');
                $('#inombre').attr("class", "error");
                checkForm2("#btn-registro");

            } else {
                nameOK = true;
                $('#inombre').text('ok');
                $('#inombre').attr("class", "valid");
                checkForm2("#btn-registro");
            }
        }

    });

 $('#apellido1').on('keyup focusout focusin', function () {
        var texto1 = $('#apellido1').val();
        checkForm2("#btn-registro");
        if (texto1 === "") {
            $('#iapellido1').text('Campo requerido');
            $('#iapellido1').attr("class", "error");
            checkForm2("#btn-registro");
        } else {
            var nameOK = namechecker(texto1);
            if (!nameOK) {
                $('#iapellido1').text('El apellido no debe contener números');
                $('#iapellido1').attr("class", "error");
                checkForm2("#btn-registro");

            } else {

                $('#iapellido1').text('ok');
                $('#iapellido1').attr("class", "valid");
                checkForm2("#btn-registro");
            }
        }

    });

    $('#apellido2').on('keyup focusout focusin', function () {
        var texto1 = $('#apellido1').val();
        checkForm2("#btn-registro");
        if (texto1 === "") {
            $('#iapellido2').text('Campo requerido');
            $('#iapellido2').attr("class", "error");
            checkForm2("#btn-registro");
        } else {
            var nameOK = namechecker(texto1);
            if (!nameOK) {
                $('#iapellido2').text('El apellido no debe contener números');
                $('#iapellido2').attr("class", "error");
                checkForm2("#btn-registro");

            } else {

                $('#iapellido2').text('ok');
                $('#iapellido2').attr("class", "valid");
                checkForm2("#btn-registro");
            }
        }

    });


    // evento desencadena llamada ajax para registro
    $('#btn-registro').on('click', function () {
        submitForm();
        //$(idBoton).remove('click');
    });

    //checkeo del formulario para activar/desactivar botón envío
    function checkForm2(idBoton) {
        var dni = $('#dni').val();
        var nombre = $('#nombre').val();
        var apellido1 = $('#apellido1').val();
        var apellido2 = $('#apellido2').val();
        //var nick = $('#nick').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var password2 = $('#password2').val();
       // var control = comprobarEmailBD(email);   // control &&
        
        if (password === password2){
            coinciden = true;
        }else{
            coinciden = false;
        }
        
        if( $('#iemail').text() === 'Nuevo usuario' ){
             control = true;
        }else{
            control = false;
        }
            
        if ( dnichecker(dni) &&
            emailchecker(email) && 
            passwordchecker(password) && coinciden &&
            namechecker(apellido1) &&
            namechecker(apellido2) &&
            namechecker(nombre))
        {
            enableSubmit(idBoton);

        } else {
            disableSubmit(idBoton);
        }
    }

    // activación desactivación del submit

    function enableSubmit(idBoton) {
        $(idBoton).removeAttr("disabled");
    }

    function disableSubmit(idBoton) {
        $(idBoton).attr("disabled", "disabled");
    }


    //enviar registro

    function submitForm() {

       var dnienviar = $('#dni').val();
        var nombreenviar = $('#nombre').val();
        var apellido1enviar = $('#apellido1').val();
        var apellido2enviar = $('#apellido2').val();
        var nickenviar = $('#nick').val();
        var emailenviar = $('#email').val();
        var passwordenviar = $('#password').val();

        var datosEnviar = {'dni': dnienviar, 'nombre': nombreenviar, 'apellido1': apellido1enviar, 
            'apellido2': apellido2enviar, 'nick': nickenviar, 'email': emailenviar, 'password': passwordenviar};
        //datos = JSON.stringify(datosEnviar);
        $.ajax({
            url: 'model/login_registro/php/registro.php',
            type: 'POST',
            dataType: 'json',
            data: datosEnviar,
            success: function (datos) {
                //alert(datos);
                    limpiarDatosForms();
                    desvincularEventos();
                    $('#modalLRForm').modal('hide');
                    location.reload(true);
            },
            error: function (datos) {
               // alert(datos);
                alert("Se ha producido un error inesperado, inténtelo de nuevo más tarde");

            }

        });
        /*   setTimeout(function(){
         $('#tablogin').attr("class", "nav-link active");
         $('#panel8').attr("class", "tab-pane fade");
         $('#tabregistro').attr("class", "nav-link ");
         $('#panel7').attr("class", "tab-pane fade in show active");
         
         
         }, 2000);  */

    }







});
    