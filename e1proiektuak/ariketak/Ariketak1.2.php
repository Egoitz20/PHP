<?php
/*
Baldintzak: Azaldu PHP-n baldintza sententzia bat (if eta else) erabiliz. Adibidez, aldagai bat ($balioa) sortu eta kasu bakoitzean pantailaratu “Balioa handia da” edo 
“Balioa txikia da” baldintzaren arabera (Adibidez 10 baino txikiago izatea).
*/

$balioa = 8;

if ($balioa < 10){
    echo "Balioa txikia da";
} else {
    print "Balioa handia da";
}
?>