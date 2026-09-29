<?php
// Según una variable llamada $operacion, realizar:
// suma
// resta
// multiplicación
// división

// Usa switch.
// Objetivo: estructuras de control.

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 8</title>
</head>

<body>

    <p>Pon "+", "-", "*", "/"</p>
    <form method="post">
        <input type="numer" name="n1">
        <input type="numer" name="n2">
        <input type="text" name="operador">
        <button type="submit"></button>
    </form>
</body>

</html>

<?php

$n1 = $_POST["n1"];
$n2 = $_POST["n2"];
$operador = $_POST["operador"];

switch ($operador) {
    case "+":
        echo "La suma es: " . ($n1 + $n2);
        break;
    case "-":
        echo "La resta es: " . ($n1 - $n2);
        break;
    case "*":
        echo "La multiplicación es: " . ($n1 * $n2);
        break;
    case "/":
        if ($n2 != 0) {
            echo "La división es: " . ($n1 / $n2);
        } else {
            echo "No se puede dividir entre 0!!!!";
        }
        break;
    
}

?>