<?php
// Pide dos números (o defínelos en variables) y muestra:
// Suma
// Resta
// Multiplicación
// División
// Objetivo: operadores aritméticos.
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>

<body>
    <form method="post">
        <input type="number" name="num1"><br><br>
        <input type="number" name="num2"><br><br>
        <button type="submit">Calcular</button>
    </form>
</body>

</html>

<?php

$num1 = $_POST["num1"];
$num2 = $_POST["num2"];

echo "Suma: " . ($num1 + $num2) . "<br>";
echo "Resta: " . ($num1 - $num2) . "<br>";
echo "Multiplicación: " . ($num1 * $num2) . "<br>";
echo "División: ";

if ($num2 == 0) {
    echo "...No se puede dividir entre 0...";
} else {
    echo $num1 / $num2;
}
"<br>";
?>
