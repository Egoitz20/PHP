<?php
require_once '../konexioa/Db.php';
require_once '../konexioa/Txertaketak.php';
require_once '../klaseak/Taldea.php';

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

    //Erroreak badagoen idatsita, errore mezua bidaliko da formulariorantz
    if (!empty($erroreIzena) && !empty($errorePuntuak)) {
        header("Location: ../index.php?erroreIzena=$erroreIzena&errorePuntuak=$errorePuntuak");
        exit();
    } else {

        // Formulariotik informazioa jasota, taldea txertatuko da taulan
        // Funtzio ruta: "../konexioa/Txertaketak.php"
        $taldeTxertaketa->txertatuTaldea(new Taldea($izena, $puntuak));

        header("Location: ../index.php");
        exit();
    }
}
