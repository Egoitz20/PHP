<?php
require_once '../konexioa/Db.php';
require_once '../konexioa/Txertaketak.php';
require_once '../klaseak/Taldea.php';


// Erroreak erakusten dira. 
/*ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1); */

$db = new Db;
$db->konektatu();

$taldeTxertaketa = new Txertaketak($db);

$erroreIzena = "";
$errorePuntuak = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $izena = htmlspecialchars($_POST["izena"]);
    $puntuak = (int) $_POST["puntuak"];

    if (empty($izena)) {
        $erroreIzena = "Izen bat egon behar da!";
    }
    if (empty($puntuak)) {
        $errorePuntuak = "Puntuak ipini behar dira!";
    }

    if (!empty($erroreIzena) && !empty($errorePuntuak)) {
        header("Location: ../index.php?erroreIzena=$erroreIzena&errorePuntuak=$errorePuntuak");
        exit();
    } else {
        $taldeTxertaketa->txertatuTaldea(new Taldea($izena, $puntuak));

        header("Location: ../index.php");
        exit();
    }
}
