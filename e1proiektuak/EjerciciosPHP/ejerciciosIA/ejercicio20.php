<?php
/* 20. Mini gestor de usuarios
Crear un array con usuarios:
$usuarios = [
    ["nombre" => "Ana", "edad" => 20],
    ["nombre" => "Luis", "edad" => 17],
    ["nombre" => "Pedro", "edad" => 25]
];
Mostrar solo los mayores de edad.
Objetivo: arrays multidimensionales y filtros.
*/

$usuarios = [
    ["nombre" => "Ana", "edad" => 20],
    ["nombre" => "Luis", "edad" => 17],
    ["nombre" => "Pedro", "edad" => 25]
];

for ($i = 0; $i < count($usuarios); $i++) {

    if ($usuarios[$i]["edad"] >= 18) {
        echo $usuarios[$i]["nombre"] . " - " . $usuarios[$i]["edad"] . " años<br>";
    }

}

?>