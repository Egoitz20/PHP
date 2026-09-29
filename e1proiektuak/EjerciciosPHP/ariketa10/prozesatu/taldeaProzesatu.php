<?php
require_once '../konexioa/Db.php';
require_once '../konexioa/Txertaketak.php';
require_once '../konexioa/Kontsultak.php';
require_once '../klaseak/Taldea.php';


// Erroreak erakusten dira. 
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

$db = new Db;
$db->konektatu();

$taldeTxertaketa = new Txertaketak($db);

$erroreIzena = "";
$errorePuntuak = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $izena = htmlspecialchars($_POST["izena"]);
    $puntuak = htmlspecialchars($_POST["puntuak"]);

    if (!isset($izena)) {
        $erroreIzena = "Izen bat egon behar da!";
        header("Location: ../index.php?erroreIzena=$erroreIzena");
        exit();
    } else if (!isset($puntuak) || $puntuak === 0) {
        $errorePuntuak = "Puntuak ipini behar dira!";
        header("Location: ../index.php?erroreIzena=$errorePuntuak");
        exit();
    } else {

        $taldeTxertaketa->txertatuTaldea(new Taldea($izena, $puntuak));

        header("Location: ../index.php");
        exit();
    }
}
