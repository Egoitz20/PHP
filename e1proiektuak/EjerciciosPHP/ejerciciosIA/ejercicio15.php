<?php
/* 
15. Función esPrimo()
Determinar si un número es primo.
Ejemplos:
7 → Primo
8 → No primo
Objetivo: lógica y reutilización.

*/

if (isset($_POST["numero"])) {
    $numero = $_POST["numero"];
    function esPrimo($numero1)
    {
        if ($numero1 < 2) {
            return false;
        }

        for ($i = 2; $i <= sqrt($numero1); $i++) {
            if ($numero1 % $i == 0) {
                return false;
            }
        }

        return true;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 15</title>
</head>

<body>

    <form method="post">
        <input type="number" name="numero">
        <button type="submit">Definir</button>
    </form>

    <?php
    $respuesta = esPrimo($numero);

    if ($respuesta == true) {
        echo "Primo";
    } else {
        echo "No primo";
    }
    ?>



</body>

</html>