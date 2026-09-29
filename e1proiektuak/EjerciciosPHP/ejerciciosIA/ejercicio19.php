<?php
/* 
19. Sistema de notas
Dado un array de notas:
$notas = [7, 9, 4, 8, 6];
Calcular:

Nota media
Nota máxima
Nota mínima

Objetivo: combinar arrays y bucles.

*/

$notas = [7, 9, 4, 8, 6];

$max = $notas[0];
$min = $notas[0];
$suma = $notas[0];

for ($i = 1; $i < count($notas); $i++) {
    if ($notas[$i] > $max) {
        $max = $notas[$i];
    }

    if ($notas[$i] < $min) {
        $min = $notas[$i];
    }

    $suma += $notas[$i];
}

$media = $suma / count($notas);


echo "Valor máximo: " . $max . "<br>";
echo "Valor minimo: " . $min . "<br>";
echo "Media: " . $media;
