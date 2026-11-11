<?php

require_once "../conexion/db.php";
require_once "../clases/Grupo.php";
require_once "../clases/Agregaciones.php";

$db = new db;
$db->konektatu();

$agregacionDeGrupos = new Agregaciones($db);

$nombreError = "";
$puntosError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST["izena"]);
    $puntos = (int) $_POST["puntuak"];

    if (empty($izena)) {
        $nombreError = "Tiene que haber un nombre";
    }
    if (empty($puntos)) {
        $puntosError = "Se tienen que poner puntos!";
    }

    if (!empty($nombreError) && !empty($puntosError)) {
        header("Location: ../index.php?nombreError=$nombreError&errorPuntos=$puntosError");
        exit();
    } else {
        $agregacionDeGrupos->agregarGrupo(new Grupo($nombre, $puntos));
        header("Location: ../index.php");
    }
}
