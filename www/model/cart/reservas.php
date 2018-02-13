<?php

include '../DBA/DBA.php';

if ($conection) {

    $carrito = $_POST["carro"];
    $carro = json_decode($carrito);
   

    foreach ($carro as $reserva) {
        $id_centro = $reserva->id_centro;
        $id_deporte = $reserva->id_deporte;
        $fecha = $reserva->fecha;
        $hora = $reserva->hora;
        $precio = $reserva->precio_hora;
        $pista = $reserva->pista;
        $usuario = 1;
        $stmt = $conection->prepare("INSERT INTO reservas VALUES (?, ?, ?,(select id_usuario from usuarios where nombre='asun'),?,?,null,?)");
        $stmt->bind_param("iiissd",$id_deporte,$id_centro,$pista,$fecha,$hora,$precio);
        $stmt->execute();
        
    }
}
?>