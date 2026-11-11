<?php
// 1. REGLA DE ORO: session_start() al inicio del archivo
session_start();

// 2. CONTROL DE ACCESO (PROTECCIÓN DE PÁGINA)
// Si no existe la variable de sesión 'usuario', redirigir a login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php?error=Acceso denegado. Inicia sesión primero.");
    exit();
}

require_once __DIR__ . "/conexion/db.php";
require_once __DIR__ . "/conexion/Consultas.php";

$db = new DB();
$db->konektatu();
$consultas = new Consultas($db);

$grupos = $consultas->mostrarClasificacion();

$error = $_GET['error'] ?? '';
$mensaje = $_GET['mensaje'] ?? '';

// Leer favorito desde sesión o desde cookie como alternativa
$favorito = $_SESSION['grupo_favorito'] ?? $_COOKIE['grupo_favorito'] ?? null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Grupos</title>
</head>
<body>
    <header>
        <p>
            Bienvenido/a, <strong><?= htmlspecialchars($_SESSION['usuario']) ?></strong> |
            <a href="api-cliente.php">Consumir API REST (PHP)</a> |
            <a href="proceso/logout.php">Cerrar Sesión</a>
        </p>
    </header>

    <hr>

    <h1>Clasificación de Grupos</h1>

    <?php if ($favorito): ?>
        <p>⭐ Tu grupo favorito actual es: <strong><?= htmlspecialchars($favorito) ?></strong></p>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <p><strong>Error:</strong> <?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php if (!empty($mensaje)): ?>
        <p><strong>Mensaje:</strong> <?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>

    <!-- Tabla con PHP puro -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Puntos</th>
                <th>Actualizar Puntos</th>
                <th>Borrar</th>
                <th>Favorito</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($grupos)): ?>
                <tr>
                    <td colspan="6">No hay grupos registrados</td>
                </tr>
            <?php else: ?>
                <?php foreach ($grupos as $g): ?>
                    <tr>
                        <td><?= htmlspecialchars($g->id) ?></td>
                        <td><?= htmlspecialchars($g->nombre) ?></td>
                        <td><?= htmlspecialchars($g->puntos) ?></td>

                        <!-- Actualizar Puntos -->
                        <td>
                            <form method="POST" action="proceso/procesoGrupos.php">
                                <input type="hidden" name="accion" value="modificar">
                                <input type="hidden" name="id" value="<?= $g->id ?>">
                                <input type="number" name="nuevosPuntos" placeholder="Puntos" required>
                                <input type="submit" value="Guardar">
                            </form>
                        </td>

                        <!-- Borrar -->
                        <td>
                            <form method="POST" action="proceso/procesoGrupos.php">
                                <input type="hidden" name="accion" value="borrar">
                                <input type="hidden" name="id" value="<?= $g->id ?>">
                                <input type="submit" value="Eliminar">
                            </form>
                        </td>

                        <!-- Guardar Favorito en Sesión y Cookie -->
                        <td>
                            <form method="POST" action="proceso/procesoGrupos.php">
                                <input type="hidden" name="accion" value="favorito">
                                <input type="hidden" name="nombre" value="<?= htmlspecialchars($g->nombre) ?>">
                                <input type="submit" value="Favorito">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <hr>

    <!-- Formulario Añadir Grupo -->
    <h2>Añadir Nuevo Grupo</h2>
    <form method="POST" action="proceso/procesoGrupos.php">
        <input type="hidden" name="accion" value="crear">
        <p>
            <label for="nombre">Nombre del Grupo:</label><br>
            <input type="text" id="nombre" name="nombre" required>
        </p>
        <p>
            <label for="puntos">Puntos Iniciales:</label><br>
            <input type="number" id="puntos" name="puntos" required>
        </p>
        <p>
            <input type="submit" value="Añadir Grupo">
        </p>
    </form>
</body>
</html>
