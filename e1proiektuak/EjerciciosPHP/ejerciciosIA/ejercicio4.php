<?php
// 4. Conversor de temperaturas
// Convierte grados Celsius a Fahrenheit.
// Fórmula:
// F = (C × 9 / 5) + 32

// Objetivo: cálculos simples.

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>

<body>

    <form method="post">
        <input type="number" name="C"><br><br>
        <button type="submit">Calcular</button>
    </form>

</body>

</html>

<?php 
$C = $_POST["C"];
$F = 0;

$F = ($C * 9 / 5) + 32;

echo $F;

?>