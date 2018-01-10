<?php

include '../DBA/DBA.php';

if ($conection) {
    $misCategorias = [];
    $misDeportes = [];
    $misCiudades = [];
    $queryDeportes = $conection->query("SELECT id_deporte,nombre FROM deportes ORDER BY nombre ASC");
    while ($row = $queryDeportes->fetch_array(MYSQLI_ASSOC)) {
        array_push($misDeportes, $row);
    }
    $queryCiudades = $conection->query("SELECT DISTINCT provincia FROM centros ORDER BY provincia ASC");
    while ($fila = $queryCiudades->fetch_array(MYSQLI_ASSOC)) {
        array_push($misCiudades, $fila);
    }

    array_push($misCategorias, $misDeportes);
    array_push($misCategorias, $misCiudades);
    echo json_encode($misCategorias);
}
?>
