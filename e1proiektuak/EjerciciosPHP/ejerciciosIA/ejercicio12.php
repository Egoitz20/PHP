<?php
/*  12. Adivina el número
Genera un número aleatorio entre 1 y 10 y compara con un número introducido por el usuario.
Objetivo: funciones aleatorias.*/
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 12</title>
</head>

<body>

    <form method="post">
        <input type="number" name="n1" min="1" max="10">
        <button type="submit">Adivinar</button>
    </form>

    <?php

    if (isset($_POST["n1"])) {

        $n1 = $_POST["n1"];
        $nr = random_int(1, 10);

        echo "El número era: $nr <br>";

        if ($n1 == $nr) {
            echo "¡Adivinaste el número!";
        } else {
            echo "Has fallado.";
        }
    }

    ?>

</body>

</html>