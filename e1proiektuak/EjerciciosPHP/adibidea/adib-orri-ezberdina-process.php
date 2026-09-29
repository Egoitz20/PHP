<?php
$izenaErr = $dataErr = "";
$izena = $data = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["izena"])) {
        $izenaErr = "Izena derrigorrezkoa da.";
    } else {
        $izena = htmlspecialchars($_POST["izena"]);
    }

    if (empty($_POST["data"])) {
        $dataErr = "Data derrigorrezkoa da.";
    } else {
        $data = htmlspecialchars($_POST["data"]);
    }

    if (empty($izenaErr) && empty($dataErr)) {
        echo "<p style='color: green;'>Dena ondo! Izena: $izena, Data: $data</p>";
    } else {
        // Itzuli formulariora errore mezuekin URL-an (horrela $_GET aldagai superglobalean egongo dira atzigarri).
        header("Location: adib-orri-ezberdina.php?izenaErr=$izenaErr&dataErr=$dataErr&izena=$izena&data=$data");
        exit();
    }
} else {
    header("Location: adib-orri-ezberdina.php");
    exit();
}
