<?php
/*
Baimendutako Irteera Balioa Sortu: 
PHP erabiliz, sortu baimendutako_mezua izena duen aldagaia balio huts batekin. 
Ondoren, erabiltzailearen adina 18 urte edo gehiagokoa bada gorde aldagai horretan “Gure lokalera sartu zaitezke” mezua,
bestela gorde “Ezin zara sartu” mezua. Azkenik, erakutsi aldagaiaren balioa pantailatik.
*/

$baimendutako_mezua = ""; // Baimendutako mezua aldagai hutsarekin sortu
$adina = 20; // Erabiltzailearen adina

if ($adina >= 18) {
    $baimendutako_mezua = "Gure lokalera sartu zaitezke";
} else {
    $baimendutako_mezua = "Ezin da sartu";
}

echo $baimendutako_mezua;

?>