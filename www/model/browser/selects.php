<?php
include '../DBA/DBA.php';

if ($conection) {
   if(isset($_GET["value"])){
     
   $valor = $_GET["value"];
    $misCiudades = [];
   
    $queryCiudades = $conection->query("SELECT DISTINCT provincia FROM centros where id_centro in(select id_centro from pistas_deporte_centro where id_deporte = $valor );");
    while ($fila =$queryCiudades->fetch_array(MYSQLI_ASSOC)) {
        array_push($misCiudades, $fila);
}}}
    
     echo json_encode($misCiudades);