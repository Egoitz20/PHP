<?php

include("Vehiculo.php");
include("Coche.php");

$vehiculo = new Coche("Renault", "Megane", 50000, 5);

echo $vehiculo->mostrarInfo();
