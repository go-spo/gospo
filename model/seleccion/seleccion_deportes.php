<?php

include '../DBA/DBA.php';
if ($conection) {
    $deportesmoda = [];
    $queryModa = $conection->query("select d.*
FROM deportes d INNER JOIN pistas_deporte_centro p
ON d.id_deporte=p.id_deporte
group by d.id_deporte
order by sum(p.puntuacion_total) desc
Limit 5");

    while ($fila = $queryModa->fetch_array(MYSQLI_ASSOC)) {
        array_push($deportesmoda, $fila);
    }
}
echo json_encode($deportesmoda);
?>