<?php
// Dados dos números, indicar cuál es mayor.
// Si son iguales, indicarlo.
// Objetivo: múltiples condiciones.

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7</title>
</head>

<body>
    <form method="post">
        <input type="number" name="numero1">
        <input type="number" name="numero2">
        <button type="submit">Calcular</button>
    </form>
</body>

</html>

<?php
$numero1 = $_POST["numero1"];
$numero2 = $_POST["numero2"];

if ($numero1 == $numero2) {
    echo "Los numero son iguales";
} else if ($numero1 > $numero2) {
    echo "El numero " . $numero1 . " es mayor"; 
} else {
    echo "El numero " . $numero2 . " es mayor";
}


?>