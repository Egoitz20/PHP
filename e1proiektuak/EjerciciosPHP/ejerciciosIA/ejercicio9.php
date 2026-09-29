<?php
/*
Mostrar la tabla del 7.
Ejemplo:
7 x 1 = 7 
7 x 2 = 14
Objetivo: bucle for
*/

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 9</title>
</head>

<body>
    <form method="post">
        <label>Introduce un numero para generar la tabla</label><br>
        <input type="number" name="n1"><br>
        <button type="submit">Tabla</button>
    </form>
</body>

</html>

<?php
if (isset($_POST["n1"])) {
    $n1 = $_POST["n1"];

    for ($i = 1; $i < 11; $i++) {
        echo $n1 . " * " . $i . " = " . ($n1 * $i) . "<br>";
    }
}


?>