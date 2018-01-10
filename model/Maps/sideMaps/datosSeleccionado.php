<?php

include '../../DBA/DBA.php';
session_start();

if ($conection) {
    if (isset($_GET["latitud"])) {

        $latitud = $_GET["latitud"];
        $longitud = $_GET["longitud"];
        $deporte = $_SESSION["deporte"];
        $ciudad = $_SESSION["ciudad"];


        $miCentro = [];
        $queryMiCentro = $conection->query("select c.*, p.hora_apertura,p.hora_cierre
        from centros c inner join pistas_deporte_centro p inner join deportes d
        on c.id_centro= p.id_centro and d.id_deporte = p.id_deporte
        where d.id_deporte = '$deporte' and c.coordenada_x='$latitud' and coordenada_y='$longitud'
        and p.id_centro in (select id_centro from centros where provincia='$ciudad');");



        while ($fila = $queryMiCentro->fetch_array(MYSQLI_ASSOC)) {
            array_push($miCentro, $fila);
        }
    }
}
echo json_encode($miCentro);
?>

