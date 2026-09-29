<?php
/* 
Calcula:
1 + 2 + 3 + ... + 100
Objetivo: acumuladores.
*/

$total = 0;

for ($i = 1; $i <= 100; $i++) {
   echo $total . " + " . $i . " = " . ($total = $total + $i) . "<br>";
}

echo $total;


