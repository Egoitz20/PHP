<?php

require_once "../konexioa/Db.php";
require_once "../konexioa/Txertaketak.php";
require_once "../klaseak/Partaidea.php";

$db = new Db;
$db->konektatu();

$partaideakTxertatu = new Txertaketak($db);

$txertaketaError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['izena']) && isset($_POST['herrialdea'])) {
        $partaideIzena = htmlspecialchars($_POST['izena']);
        $herrialdea = htmlspecialchars($_POST['herrialdea']);

        $tIzena = $_POST['taldeaIzena'];
        $tId = $_POST['taldeaId'];

        if (!empty($partaideIzena) && !empty($herrialdea) && !empty($tId)) {
            // Formulariotik informazioa jasota, taldearen partaidea txertatuko da taulan
            // Funtzio ruta: "../konexioa/Txertaketak.php"
            $partaideakTxertatu->txertatuPartaideak(new Partaidea($partaideIzena, $herrialdea, $tId));
            header("Location: ../pages/partaideak.php?taldea=$tIzena&taldeId=$tId");
            exit();
        } else {
            $txertaketaError = "Ez dago informazio beteta!";
            header("Location: ../pages/partaideak.php?taldea=$tIzena&taldeId=$tId&error=$txertaketaError");
            exit();
        }
    } else {
        header("Location: ../index.php");
        exit();
    }
}
