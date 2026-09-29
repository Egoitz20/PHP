<?php
/* 
Nivel 4: Funciones
Función de saludo
Crear:
function saludar($nombre)
Que devuelva:
Hola, Pedro
Objetivo: parámetros.
*/

if (isset($_POST["nombre"])) {
    $nombre = $_POST["nombre"];

    function saludar($nombre1)
    {
        echo "<p>Hola, " . $nombre1 . "</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 13</title>
</head>

<body>
    <form method="post">
        <label>Introduce tu nombre por favor</label>
        <input type="text" name="nombre">
        <button type="submit">Enviar</button>
    </form>

    <?php saludar($nombre); ?>
</body>

</html>