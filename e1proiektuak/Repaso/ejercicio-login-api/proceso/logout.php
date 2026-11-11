<?php
// Iniciar la sesión para poder acceder a ella y destruirla
session_start();

// Vaciar todas las variables de sesión del array $_SESSION
$_SESSION = [];

// Si se usan cookies de sesión, destruirla también en el navegador
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Destruir la sesión en el servidor
session_destroy();

// Redirigir al formulario de login con mensaje de confirmación
header("Location: ../login.php?mensaje=Has cerrado sesión correctamente");
exit();

