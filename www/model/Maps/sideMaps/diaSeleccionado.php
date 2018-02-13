<?php

include '../../DBA/DBA.php';
session_start();

if ($conection) {
    if (isset($_POST["id_deporte"])) {

        $id_deporte = $_POST["id_deporte"];
        $id_centro = $_POST["id_centro"];
        $fecha =$_POST["fecha"];

        $horasReservadas = [];
        $queryMiCentro = $conection->query("SELECT 
            SUBSTRING(hora_inicio_reserva, 1, 2) AS horas_reservadas
            FROM reservas
            WHERE id_deporte=$id_deporte AND id_centro=$id_centro AND fecha='$fecha';");

        while ($fila = $queryMiCentro->fetch_array(MYSQLI_NUM)) {
            array_push($horasReservadas, (int)$fila[0]);
        }
    }
}
echo json_encode($horasReservadas);
?>