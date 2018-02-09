<?php
	header('Content-Type: application/JSON');
if ( isset($_REQUEST['email']) && !empty($_REQUEST['email']) ) {

        $host = "localhost";
	$user ="root";
	$password = "root";
        $dbname = "gosport";

        $conector = mysqli_connect($host,$user,$password,$dbname);
		mysqli_set_charset($conector,"utf-8");
		
		$email = $_REQUEST['email'];
		
		$query = "SELECT dni FROM usuarios WHERE email=?";
		$stmt = $conector->prepare($query);
		$stmt->bind_param('s',$email);
		if($stmt->execute()){
			$stmt->store_result();    
			//print_r($stmt);
                        if ($stmt->num_rows == 1) {  //sÍ existe 
                            $response = (array('data' => 'existe'));

                        } else {
                            $response = (array('data' => 'success'));

                        }
                }
                
     echo json_encode($response,JSON_PRETTY_PRINT);           
                
                
}else{

	echo "Acceso denegado.";
}



?>