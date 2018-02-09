<?php
header('Content-type: application/json');

if( isset($_POST['dni']) && isset($_POST['email']) && isset($_POST['password']) ){
    $response = array();
    $host = "localhost";
    $user = "root";
    $password = "root";
    $dbname = "gosport";
    
    $conector = mysqli_connect($host,$user,$password,$dbname);
    mysqli_set_charset($conector,"utf-8");

    if($conector){
 
    $dni = $_POST['dni'];
    $correo = $_POST['email'];
    $contrasenya = $_POST['password'];
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $nick = $_POST['nick'];
    
    $tipo_usuario="deportista"; //por defecto se registran como deportistas
    
    //Generamos el hash a partir de la contraseña para almacenarlo en la base de datos
    $hash = password_hash ($contrasenya , PASSWORD_DEFAULT);
    
    $query = "INSERT INTO usuarios(dni,nombre,apellido1,apellido2,nick,password,email,tipo_usuario) VALUES(?,?,?,?,?,?,?,?)";
    $stmt=$conector->prepare($query);
   
    $stmt->bind_param('ssssssss',$dni,$nombre,$apellido1,$apellido2,$nick,$hash,$correo,$tipo_usuario);
   //if(!$stmt->execute()) echo $stmt->error;
   
    
    if ( $stmt->execute() ) {
        $response['status'] = 'success';
        $response['message'] = 'Su registro se ha realizado con éxito';
    } else {
        $response['status'] = 'error'; 
        $response['message'] = 'El registro no se ha realizado correctamente, inténtelo de nuevo más tarde...';
    }

    $stmt->close();	

    echo json_encode($response,JSON_PRETTY_PRINT);
    }
}else{
    echo "Algo falla con las variables";
    // diseñar página error por acceso no autorizado al recursos
}



?>