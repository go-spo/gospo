<?php

include '../DBA/DBA.php';
session_start();

if ($conection) {
    $deporte = $_SESSION["deporte"];
    $ciudad = $_SESSION["ciudad"];
    $markers = [];

    $queryMarkers = $conection->query("select id_centro,nombre, coordenada_x, coordenada_y, url_img 
    from centros
    where id_centro in (select id_centro from pistas_deporte_centro where id_deporte = (select id_deporte from deportes where id_deporte='$deporte') and
    id_centro in (select id_centro from centros where provincia ='$ciudad'));");

    while ($fila = $queryMarkers->fetch_array(MYSQLI_ASSOC)) {
        array_push($markers, $fila);
    }
}
echo json_encode($markers);
?>
