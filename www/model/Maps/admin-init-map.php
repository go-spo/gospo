<?php

include '../DBA/DBA.php';

if ($conection) {

    $markers = [];

    $queryMarkers = $conection->query("select id_centro,nombre, coordenada_x, coordenada_y 
    from centros;");

    while ($fila = $queryMarkers->fetch_array(MYSQLI_ASSOC)) {
        array_push($markers, $fila);
    }
}
echo json_encode($markers);
?>
