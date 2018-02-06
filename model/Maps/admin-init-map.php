<?php

include '../DBA/DBA.php';
session_start();

if ($conection) {
    $deporte = $_SESSION["deporte"];
    $ciudad = $_SESSION["ciudad"];
    $markers = [];

    $queryMarkers = $conection->query("select id_centro,nombre, coordenada_x, coordenada_y 
    from centros;");

    while ($fila = $queryMarkers->fetch_array(MYSQLI_ASSOC)) {
        array_push($markers, $fila);
    }
}
echo json_encode($markers);
?>
