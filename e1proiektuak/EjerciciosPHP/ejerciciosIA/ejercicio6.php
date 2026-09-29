<?php
//Dada una edad, indicar si la persona es:
// Mayor de edad
// o
/// Menor de edad
// Objetivo: comparaciones.

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
</head>

<body>
    <form method="post">
        <input type="numer" name="edad">
        <button type="submit">Calcular</button>

    </form>


</body>

</html>

<?php
$edad = $_POST["edad"];

if ($edad >= 18) {
    echo "Eres mayor de edad ";
} else {
    echo "Eres menor de edad";
}

?>