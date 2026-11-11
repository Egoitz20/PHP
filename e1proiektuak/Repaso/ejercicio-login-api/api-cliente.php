<?php
// Protección de sesión: obligatorio estar autenticado
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php?error=Debes iniciar sesión");
    exit();
}

// URL base de la API
$urlApi = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/api/grupos-api.php";
$mensaje = "";
$error = "";

// ═════════════════════════════════════════════════════════════════════
// 1. PROCESAMIENTO DE ACCIONES CON PHP PURO HACIA LA API
// ═════════════════════════════════════════════════════════════════════

// A) CREAR NUEVO GRUPO CON PHP PURO (file_get_contents + stream_context_create)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["accion"]) && $_POST["accion"] === "crear_stream") {
    $nombre = trim($_POST["nombre"] ?? "");
    $puntos = (int)($_POST["puntos"] ?? 0);

    $datosJson = json_encode(["nombre" => $nombre, "puntos" => $puntos]);

    $opciones = [
        "http" => [
            "method"  => "POST",
            "header"  => "Content-Type: application/json\r\nAccept: application/json\r\n",
            "content" => $datosJson,
            "ignore_errors" => true // Permite leer la respuesta aunque sea código 400 o 500
        ]
    ];
    $contexto = stream_context_create($opciones);
    $respuesta = file_get_contents($urlApi, false, $contexto);
    $resArray = json_decode($respuesta, true);

    if (isset($resArray["mensaje"])) {
        $mensaje = "API (stream): " . $resArray["mensaje"];
    } else {
        $error = "API (stream) Error: " . ($resArray["error"] ?? "Error desconocido");
    }
}

// B) ACTUALIZAR PUNTOS CON PHP PURO (cURL con método PUT)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["accion"]) && $_POST["accion"] === "actualizar_curl") {
    $id = (int)($_POST["id"] ?? 0);
    $puntos = (int)($_POST["puntos"] ?? 0);

    $datosJson = json_encode(["puntos" => $puntos]);
    $urlPut = $urlApi . "?id=" . $id;

    $ch = curl_init($urlPut);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datosJson);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Content-Length: " . strlen($datosJson)
    ]);

    $respuesta = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $resArray = json_decode($respuesta, true);
    if ($httpCode >= 200 && $httpCode < 300) {
        $mensaje = "API (cURL PUT): " . ($resArray["mensaje"] ?? "Actualizado con éxito");
    } else {
        $error = "API (cURL PUT) Error: " . ($resArray["error"] ?? "Error al actualizar");
    }
}

// C) BORRAR GRUPO CON PHP PURO (file_get_contents + stream_context_create con DELETE)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["accion"]) && $_POST["accion"] === "borrar_stream") {
    $id = (int)($_POST["id"] ?? 0);
    $urlDelete = $urlApi . "?id=" . $id;

    $opciones = [
        "http" => [
            "method" => "DELETE",
            "header" => "Accept: application/json\r\n",
            "ignore_errors" => true
        ]
    ];
    $contexto = stream_context_create($opciones);
    $respuesta = file_get_contents($urlDelete, false, $contexto);
    $resArray = json_decode($respuesta, true);

    if (isset($resArray["mensaje"])) {
        $mensaje = "API (stream DELETE): " . $resArray["mensaje"];
    } else {
        $error = "API (stream DELETE) Error: " . ($resArray["error"] ?? "Error al borrar");
    }
}

// ═════════════════════════════════════════════════════════════════════
// 2. OBTENER LISTADO MEDIANTE GET DESDE PHP
// ═════════════════════════════════════════════════════════════════════
$opcionesGet = [
    "http" => [
        "method" => "GET",
        "header" => "Accept: application/json\r\n"
    ]
];
$contextoGet = stream_context_create($opcionesGet);
$jsonRespuesta = @file_get_contents($urlApi, false, $contextoGet);
$grupos = $jsonRespuesta ? json_decode($jsonRespuesta, true) : [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cliente API en PHP Puro</title>
</head>
<body>
    <header>
        <p>
            Usuario: <strong><?= htmlspecialchars($_SESSION['usuario']) ?></strong> |
            <a href="index.php">Volver al Panel</a> |
            <a href="proceso/logout.php">Cerrar Sesión</a>
        </p>
    </header>

    <hr>

    <h1>Cliente de la API REST (Procesado 100% con PHP)</h1>

    <?php if (!empty($mensaje)): ?>
        <p><strong>Resultado:</strong> <?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <p><strong>Error:</strong> <?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <h2>1. Listado de Equipos Obtenido con GET (file_get_contents)</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Puntos</th>
                <th>Actualizar (PHP cURL PUT)</th>
                <th>Eliminar (PHP Stream DELETE)</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($grupos)): ?>
                <tr>
                    <td colspan="5">No se recibieron datos de la API</td>
                </tr>
            <?php else: ?>
                <?php foreach ($grupos as $g): ?>
                    <tr>
                        <td><?= htmlspecialchars($g['id']) ?></td>
                        <td><?= htmlspecialchars($g['nombre']) ?></td>
                        <td><?= htmlspecialchars($g['puntos']) ?></td>

                        <!-- Actualizar con PHP cURL PUT -->
                        <td>
                            <form method="POST" action="api-cliente.php">
                                <input type="hidden" name="accion" value="actualizar_curl">
                                <input type="hidden" name="id" value="<?= $g['id'] ?>">
                                <input type="number" name="puntos" placeholder="Nuevos pts" required>
                                <input type="submit" value="Actualizar (cURL)">
                            </form>
                        </td>

                        <!-- Borrar con PHP Stream DELETE -->
                        <td>
                            <form method="POST" action="api-cliente.php">
                                <input type="hidden" name="accion" value="borrar_stream">
                                <input type="hidden" name="id" value="<?= $g['id'] ?>">
                                <input type="submit" value="Borrar (Stream)">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <hr>

    <h2>2. Crear Equipo con POST JSON desde PHP (stream_context_create)</h2>
    <form method="POST" action="api-cliente.php">
        <input type="hidden" name="accion" value="crear_stream">
        <p>
            <label for="nombre">Nombre del Equipo:</label><br>
            <input type="text" id="nombre" name="nombre" required>
        </p>
        <p>
            <label for="puntos">Puntos:</label><br>
            <input type="number" id="puntos" name="puntos" required>
        </p>
        <p>
            <input type="submit" value="Enviar POST JSON a la API">
        </p>
    </form>
</body>
</html>
