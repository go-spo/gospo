<?php
if(isset($_REQUEST['secure'])){
    session_start();
    
    if(isset($_SESSION['id_user_pag_principal'])){
        session_unset();
        session_destroy();
    
        $response['logout']='true';
        
        echo json_encode($response);
    }else{
        $response['logout']='false';
        echo json_encode($response);
    }
}else{
    $response['status'] = 'error'; 
    $response['message'] = 'Acceso no autorizado';
    echo json_encode($response);
    header("Location: ../../../login.html");
}
