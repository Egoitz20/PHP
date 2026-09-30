<?php

require_once "../konexioa/Db.php";
require_once "../konexioa/Txertaketak.php";
require_once "../klaseak/Partaideak.php";

$db = new Db;
$db->konektatu();

$partaideakTxertatu = new Txertaketak($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['izena']) && isset($_POST['herrialdea'])) {
        $izena = htmlspecialchars($_POST['izena']);
        $herrialdea = htmlspecialchars($_POST['herrialdea']);

        $tIzena = $_POST['taldeaIzena'];
        $tId = $_POST['taldeaId'];

        $partaideakTxertatu->txertatuPartaideak(new Partaideak($izena, $herrialdea, $tId));

        header("Location: ../pages/partaideak.php?taldea=$tIzena&taldeId=$tId");
        exit();
    } else {
        header("Location: ../index.php");
        exit();
    }
}
