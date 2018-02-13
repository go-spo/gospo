<?php

include '../../DBA/DBA.php';
session_start();

if ($conection) {
    $deporte = $_SESSION["deporte"];
    $ciudad = $_SESSION["ciudad"];
    $centros = [];

    $queryCentros = $conection->query("select  round((sum(p.puntuacion_total)/sum(p.votos)),2) as media,
        sum(p.votos)as votos, c.*, p.hora_apertura,p.hora_cierre
        from centros c inner join pistas_deporte_centro p inner join deportes d
        on c.id_centro= p.id_centro and d.id_deporte = p.id_deporte
        where d.id_deporte = '$deporte'
        and p.id_centro in (select id_centro from centros where provincia='$ciudad')
	group by id_centro;");



    while ($fila = $queryCentros->fetch_array(MYSQLI_ASSOC)) {
        array_push($centros, $fila);
    }
}
    echo json_encode($centros);
?>


