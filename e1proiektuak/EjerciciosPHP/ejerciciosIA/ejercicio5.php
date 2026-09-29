<?php 
// 5. Número par o impar
// Determina si un número es:
//Par
//Impar

// Pista:
// $numero % 2
// Objetivo: usar if.

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
</head>
<body>
    
<form method="post">
    <input type="number" name="numero"><br><br>
    <button type="submit">Calcular</button>
</form>

</body>
</html>

<?php 
$numero = $_POST["numero"];

if ($numero % 2 == 0) {
    echo "Este numero es par";
} else {
    echo "Este numero es impar";
}


?>