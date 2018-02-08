<?php
echo "<h2>PÁGINA DE MANTENIMIENTO</h2>";
session_start();
$usuario = $_SESSION['usuario'];

if(isset($_SESSION['usuario'])){

	echo "<form action='' method='post'>";
	echo "<h2>Nos alegramos de verle de nuevo ".$usuario."</h2><br/>";
	echo "<input type='submit' id='cerrar' name='cerrarsesion' value='Cerrar sesión'></input>";
	echo "</form>";

	if(isset($_POST['cerrarsesion'])){
		session_unset();
		session_destroy();
		header("Location: ../../../index.html");
	}

		
		

}else{
	echo "<h2>No está autorizado para acceder.</h2>";
	//header("Location: ../login.html");
}




?>