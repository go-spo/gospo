<?php

if(isset($_REQUEST['secure'])){
    session_start();
    if(isset($_SESSION['id_user_pag_principal'])){
        $response['establecida']='true';
        $response['codigousuario']= $_SESSION['id_user_pag_principal'];
        $response['usuario']= $_SESSION['usuario'];
        echo json_encode($response);
    }else{
        $response['establecida']='false';
        echo json_encode($response);
    }
}else{
    $response['status'] = 'error'; 
    $response['message'] = 'Acceso no autorizado';
    echo json_encode($response);
    header("Location: ../../../login.html");
}

        
?>