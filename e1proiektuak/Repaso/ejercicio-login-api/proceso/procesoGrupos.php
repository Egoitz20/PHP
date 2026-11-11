<?php
session_start();

// Control de acceso: solo usuarios logueados pueden procesar datos
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php?error=Sesión no válida");
    exit();
}

require_once __DIR__ . "/../conexion/db.php";
require_once __DIR__ . "/../conexion/Consultas.php";

$db = new DB();
$db->konektatu();
$consultas = new Consultas($db);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $accion = $_POST["accion"] ?? "";

    // ── ACCIÓN 1: AÑADIR NUEVO GRUPO ──
    if ($accion === "crear") {
        $nombre = htmlspecialchars(trim($_POST["nombre"] ?? ""));
        $puntos = isset($_POST["puntos"]) && $_POST["puntos"] !== "" ? (int)$_POST["puntos"] : null;

        if (empty($nombre) || $puntos === null) {
            header("Location: ../index.php?error=Debes rellenar nombre y puntos");
            exit();
        }

        $consultas->insertarGrupo($nombre, $puntos);
        header("Location: ../index.php?mensaje=Grupo creado correctamente");
        exit();
    }

    // ── ACCIÓN 2: MODIFICAR PUNTUACIÓN ──
    if ($accion === "modificar") {
        $id = isset($_POST["id"]) ? (int)$_POST["id"] : null;
        $nuevosPuntos = isset($_POST["nuevosPuntos"]) && $_POST["nuevosPuntos"] !== "" ? (int)$_POST["nuevosPuntos"] : null;

        if ($id && $nuevosPuntos !== null) {
            $consultas->actualizarPuntos($id, $nuevosPuntos);
            header("Location: ../index.php?mensaje=Puntos actualizados");
            exit();
        } else {
            header("Location: ../index.php?error=Faltan datos para actualizar");
            exit();
        }
    }

    // ── ACCIÓN 3: BORRAR GRUPO ──
    if ($accion === "borrar") {
        $id = isset($_POST["id"]) ? (int)$_POST["id"] : null;
        if ($id) {
            $consultas->borrarGrupo($id);
            header("Location: ../index.php?mensaje=Grupo eliminado");
            exit();
        }
    }

    // ── ACCIÓN 4: MARCAR FAVORITO (SESIÓN Y COOKIE) ──
    if ($accion === "favorito") {
        $nombre = htmlspecialchars($_POST["nombre"] ?? "");
        if (!empty($nombre)) {
            // Guardamos en sesión
            $_SESSION['grupo_favorito'] = $nombre;
            // Guardamos en cookie durante 1 hora
            setcookie('grupo_favorito', $nombre, time() + 3600, "/");
            header("Location: ../index.php?mensaje=Grupo favorito guardado");
            exit();
        }
    }

    // Si no coincide ninguna acción
    header("Location: ../index.php");
    exit();

} else {
    header("Location: ../index.php");
    exit();
}
