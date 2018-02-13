<?php

//header('Content-type: application/json');

if(isset($_POST['youremail']) && isset($_POST['yourpassword'])){
		
		$host = "localhost";
		$user ="root";
		$password = "root";
		$dbname = "gosport";
       
		$correo = $_POST['youremail'];
		$contrasenya = $_POST['yourpassword'];
		
		$conector = mysqli_connect($host,$user,$password,$dbname);
		mysqli_set_charset($conector,"utf-8");
                
                 if($conector){
                     
                        $query = "SELECT nick,email,password,tipo_usuario,id_usuario FROM usuarios WHERE email=?";
			$stmt = $conector->prepare($query);
			$stmt->bind_param('s',$correo);
			$stmt->execute();
			$result = $stmt->get_result();
			
			$datosusuario = $result->fetch_array(MYSQLI_ASSOC);
			
				if ($result->num_rows == 1){                
						
                                                $tipouser = $datosusuario['tipo_usuario'];
                                                $id_usuario = $datosusuario['id_usuario'];
						$usuario1 = $datosusuario['nick'];
						$usuario2 = $datosusuario['email'];
						$usuario2 = explode('@',$usuario2);
						$usuario2 = $usuario2[0]; //primera parte del email antes de @
						$hash_bd = $datosusuario['password'];
						$stmt->close();
						//comprobación de que la contraseña coincide con el hash que devuelve la base de datos.
						if(password_verify($contrasenya, $hash_bd) && ($tipouser==='gerente')){ 
												
                                                    session_start(); //iniciamos sesión
                                                    $_SESSION['usuario']=$usuario1; //creamos dato de sesión con el dato del nick (puede cambiarse por el correo)
                                                    $_SESSION['id_user_pag_principal']=$id_usuario;
                                                    $response['status'] = 'successgerente';
                                                    $response['usuario'] = $_SESSION['usuario'];
                                                    $response['id_user'] = $_SESSION['id_user_pag_principal'];
                                                    echo json_encode($response,JSON_PRETTY_PRINT);
                                                   
                                                    //header("Location: mantenimiento.php");

						}else if(password_verify($contrasenya, $hash_bd)){
                                                    session_start(); //iniciamos sesión
                                                    $_SESSION['usuario']=$usuario1; //creamos dato de sesión con el dato del nick (puede cambiarse por el correo)
                                                    $_SESSION['id_user_pag_principal']=$id_usuario;
                                                    $response['status'] = 'successuser';
                                                    $response['usuario'] = $_SESSION['usuario'];
                                                    $response['id_user'] = $_SESSION['id_user_pag_principal'];
                                                    $response['message'] = 'usuario registrado, hola!';
                                                    echo json_encode($response,JSON_PRETTY_PRINT);
                                                    
						}else{
                                                    $response['status'] = 'erroracceso'; 
                                                    $response['message'] = 'Datos de acceso incorrectos';
                                                    echo json_encode($response,JSON_PRETTY_PRINT);
                                                }

					}else{
						$response['status'] = 'errornoregistrado'; 
						$response['message'] = 'Correo no registrado..unase a Gospo';
						echo json_encode($response,JSON_PRETTY_PRINT);
					}
			
		
			mysqli_close($conector);
                }else{
                    $response['status'] = 'error'; 
                    $response['message'] = 'No se pudo conectar a la base de datos';
                    echo json_encode($response,JSON_PRETTY_PRINT);
                }
	}else{
		$response['status'] = 'error'; 
		$response['message'] = 'Acceso no autorizado';
		echo json_encode($response,JSON_PRETTY_PRINT);
		header("Location: ../../../index.html");
	}







/*PRUEBA FUNCIÓN HASHES Y VERIFICACIÓN
		$palabra = "estaclaveeslaleche";
		$hash = password_hash($palabra,PASSWORD_DEFAULT);

		if(password_verify($palabra,$hash)){
			echo "La contraseña coincide con el hash.";
		}else{
			echo "La contraseña NO coincide con el hash.";
        } */

/*
 * Este código evaluará el servidor para determinar el coste permitido.
 * Se establecerá el mayor coste posible sin disminuir demasiando la velocidad
 * del servidor. 8-10 es una buena referencia, y más es bueno si los servidores
 * son suficientemente rápidos. El código que sigue tiene como objetivo un tramo de
 * ≤ 50 milisegundos, que es una buena referencia para sistemas con registros interactivos.
 
$timeTarget = 0.05; // 50 milisegundos 

$coste = 8;
do {
    $coste++;
    $inicio = microtime(true);
    password_hash("test", PASSWORD_BCRYPT, ["cost" => $coste]);
    $fin = microtime(true);
} while (($fin - $inicio) < $timeTarget);

echo "Coste apropiado encontrado: " . $coste . "\n";

*/
        
?>