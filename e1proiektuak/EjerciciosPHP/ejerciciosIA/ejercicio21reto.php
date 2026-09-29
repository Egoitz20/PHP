<?php
/* 
Reto final (extra)
Cuando completes los 20 ejercicios, intenta hacer una aplicación de consola que permita:

Registrar usuarios.
Listarlos.
Buscar usuarios.
Eliminar usuarios.
Guardar los datos en un archivo JSON.

Con este proyecto practicarás:

Variables
Condicionales
Bucles
Funciones
Arrays
Ficheros
JSON

Es un excelente puente entre nivel principiante e intermedio en PHP.


*/

$archivo = "usuarios.json";

/* Cargar usuarios */
if (file_exists($archivo)) {
    $listaDeUsuarios = json_decode(file_get_contents($archivo), true) ?? [];
} else {
    $listaDeUsuarios = [];
}

/* Registrar usuario */
if (isset($_POST["registrar"])) {

    $nuevoUsuario = [
        "nombre" => trim($_POST["nombre"]),
        "contrasenia" => trim($_POST["contrasenia"])
    ];

    $listaDeUsuarios[] = $nuevoUsuario;

    file_put_contents(
        $archivo,
        json_encode($listaDeUsuarios, JSON_PRETTY_PRINT)
    );
}

/* Buscar usuario */
$resultadoBusqueda = null;

if (isset($_POST["buscar"])) {

    $nombreBuscado = trim($_POST["nombre_buscar"]);

    foreach ($listaDeUsuarios as $usuario) {
        if ($usuario["nombre"] === $nombreBuscado) {
            $resultadoBusqueda = $usuario;
            break;
        }
    }
}

/* Eliminar usuario */
if (isset($_POST["eliminar"])) {

    $nombreEliminar = trim($_POST["nombre_eliminar"]);

    foreach ($listaDeUsuarios as $indice => $usuario) {

        if ($usuario["nombre"] === $nombreEliminar) {

            unset($listaDeUsuarios[$indice]);

            $listaDeUsuarios = array_values($listaDeUsuarios);

            file_put_contents(
                $archivo,
                json_encode($listaDeUsuarios, JSON_PRETTY_PRINT)
            );

            break;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
</head>
<body>

<h2>Registrar usuario</h2>

<form method="post">
    <label>Nombre:</label>
    <input type="text" name="nombre" required>

    <br><br>

    <label>Contraseña:</label>
    <input type="password" name="contrasenia" required>

    <br><br>

    <button type="submit" name="registrar">
        Registrar
    </button>
</form>

<hr>

<h2>Ver usuarios</h2>

<form method="post">
    <button type="submit" name="ver">
        Ver usuarios
    </button>
</form>

<?php
if (isset($_POST["ver"])) {

    echo "<pre>";
    print_r($listaDeUsuarios);
    echo "</pre>";
}
?>

<hr>

<h2>Buscar usuario</h2>

<form method="post">
    <input
        type="text"
        name="nombre_buscar"
        placeholder="Nombre"
        required
    >

    <button type="submit" name="buscar">
        Buscar
    </button>
</form>

<?php
if (isset($_POST["buscar"])) {

    if ($resultadoBusqueda) {

        echo "<h3>Usuario encontrado:</h3>";

        echo "<pre>";
        print_r($resultadoBusqueda);
        echo "</pre>";

    } else {

        echo "<p>Usuario no encontrado.</p>";
    }
}
?>

<hr>

<h2>Eliminar usuario</h2>

<form method="post">
    <label>Nombre:</label>
    <input type="text" name="nombre_eliminar" required>

    <button type="submit" name="eliminar">
        Eliminar
    </button>
</form>