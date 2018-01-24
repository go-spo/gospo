<?php
 
include '../DBA/DBA.php';

if ($conection) {
   
      $carrito= $_POST["carro"];
      $carro= json_decode($carrito);
      
      
      
      foreach($carro as $reserva){
         $id_centro= $reserva->id_centro;
         $id_deporte= $reserva->id_deporte;
         $fecha= $reserva->fecha;
         $hora= $reserva->hora;
         $precio= $reserva->precio;
         $pista= $reserva->pista;
        $usuario = 1;
         echo $id;
      }
        
    
}

?>