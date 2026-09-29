<?php
/*
17. Buscar el valor máximo
Dado:
$numeros = [12, 8, 45, 21, 3];
Encontrar manualmente el número mayor.
Objetivo: recorrer arrays y comparar.
*/

$numeros = [12, 8, 45, 21, 3];

$max = $numeros[0];

for ($i = 1; $i < count($numeros); $i++) {
    if ($numeros[$i] > $max) {
        $max = $numeros[$i];
    }
}

echo $max;
