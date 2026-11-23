<?php

require_once "../conexion/db.php";
require_once "../conexion/Agregaciones.php";
require_once "../conexion/Participante.php";

$db = new db;
$db->konektatu();

$agregarParticipantes = new Agregaciones($db);

$errorInserccion = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nombre']) && isset($_POST['ciudad'])) {
        $nombreParticipante = htmlspecialchars($_POST['nombre']);
        $ciudad = htmlspecialchars($_POST['ciudad']);

        $nombreGrupo = $_POST['nombreGrupo'];
        $idGrupo = $_POST['idGrupo'];

        if (!empty($nombreParticipante) && !empty($ciudad) && !empty($idGrupo)) {
            $agregarParticipantes->agregarParticipantes(new Participante($nombreParticipante, $ciudad, $idGrupo));
            header("Location: ../paginas/participantes.php?nombreGrupo=$nombreGrupo&idGrupo=$idGrupo");
            exit();
        } else {
            $errorInserccion = "La información no esta completa";
            header("Location: ../paginas/participantes.php?nombreGrupo=$nombreGrupo&idGrupo=$idGrupo&error=$errorInserccion");
            exit();
        }
    } else {
        header("Location: ../index.php");
        exit();
    }
}
