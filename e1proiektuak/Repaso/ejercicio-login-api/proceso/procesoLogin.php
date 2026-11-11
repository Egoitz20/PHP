<?php
// 1. REGLA DE ORO DE EXAMEN: session_start() siempre en la primera línea
session_start();

require_once __DIR__ . "/../conexion/db.php";
require_once __DIR__ . "/../conexion/Consultas.php";

// 2. Comprobar que la petición llegó mediante método POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 3. Sanitizar y recoger las entradas
    $usuario = trim($_POST["usuario"] ?? "");
    $password = trim($_POST["password"] ?? "");

    // 4. Validar campos obligatorios
    if (empty($usuario) || empty($password)) {
        header("Location: ../login.php?error=Debes rellenar todos los campos");
        exit();
    }

    // 5. Conectar y verificar credenciales
    $db = new DB();
    $db->konektatu();
    $consultas = new Consultas($db);

    if ($consultas->validarLogin($usuario, $password)) {
        // 6. ¡ÉXITO! Regenerar ID de sesión por seguridad contra fijación de sesión
        session_regenerate_id(true);

        // Guardar variables de sesión
        $_SESSION['usuario'] = $usuario;
        $_SESSION['login_time'] = time();

        // Redirección a la página privada protegida (index.php)
        header("Location: ../index.php");
        exit();
    } else {
        // Fallo de credenciales: devolver a login con mensaje
        header("Location: ../login.php?error=Usuario o contraseña incorrectos");
        exit();
    }

} else {
    // Si acceden directamente por URL (GET), redirigir a login
    header("Location: ../login.php");
    exit();
}

