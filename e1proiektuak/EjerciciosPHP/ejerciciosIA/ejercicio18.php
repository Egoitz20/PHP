<?php
/*  
18. Agenda de contactos
Crear un array asociativo:
$contactos = [
              "Ana" => "111111111",
              "Luis" => "222222222",
              "Pedro" => "333333333"
              ];
Mostrar nombre y teléfono.

*/

$contactos = [
    "Ana" => "111111111",
    "Luis" => "222222222",
    "Pedro" => "333333333"
];

foreach ($contactos as $nombre => $telefono) {
    echo "Nombre: " . $nombre . " Telefono: " . $telefono . "<br>";
}
