<?php

include "Loggable.php";
include "Usuario.php";
include "Pedido.php";

$usuario = new Usuario("Carlos Gómez");
$usuario->registrarAcceso();

echo "<br>";

// Instancia de Pedido
$pedido = new Pedido(8402, 149.99);
$pedido->completarOrden();
