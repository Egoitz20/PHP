<?php
session_start();

// Si el usuario ya ha iniciado sesión, redirigir al panel principal
if (isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$error = $_GET['error'] ?? '';
$mensaje = $_GET['mensaje'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>

    <?php if (!empty($error)): ?>
        <p><strong>Error:</strong> <?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php if (!empty($mensaje)): ?>
        <p><strong>Mensaje:</strong> <?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>

    <form method="POST" action="proceso/procesoLogin.php">
        <p>
            <label for="usuario">Usuario:</label><br>
            <input type="text" id="usuario" name="usuario" required>
        </p>
        <p>
            <label for="password">Contraseña:</label><br>
            <input type="password" id="password" name="password" required>
        </p>
        <p>
            <input type="submit" value="Iniciar Sesión">
        </p>
    </form>
</body>
</html>
