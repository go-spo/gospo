<?php

include '../DBA/DBA.php';

if ($conection) {

    $imgCarrusel = [];

    $queryCiudades = $conection->query("SELECT * FROM imagenes where descripcion != '' ;");
    while ($row = $queryCiudades->fetch_array(MYSQLI_ASSOC)) {
        array_push($imgCarrusel, $row);
    }
}

echo json_encode($imgCarrusel);

