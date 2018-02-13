<?php

include '../../DBA/DBA.php';
session_start();

if ($conection) {
    if (isset($_GET["value"])) {

        $id = $_GET["value"];
        $deporte = $_SESSION["deporte"];

        $miCentro = [];
        $queryMiCentro = $conection->query("select c.*, p.hora_apertura,p.hora_cierre, 
        round((sum(p.puntuacion_total)/sum(p.votos))/2,2) as media,sum(p.votos) as votos,d.*,p.precio_hora,d.nombre as deporte
        from centros c inner join pistas_deporte_centro p inner join deportes d
        on c.id_centro= p.id_centro and d.id_deporte = p.id_deporte
        where d.id_deporte = '$deporte' and c.id_centro='$id';");



        while ($fila = $queryMiCentro->fetch_array(MYSQLI_ASSOC)) {
            array_push($miCentro, $fila);
        }
    }
}
echo json_encode($miCentro);
?>

