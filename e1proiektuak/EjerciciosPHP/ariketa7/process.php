<?php

require_once 'helpers.php';

$erroreak = [];

$emaila = $_POST["emaila"] ?? "";
$alokairuData = $_POST["alokeraData"] ?? "";
$nan = strtoupper($_POST["nan"] ?? "");


// EMAIL
if (empty($emaila)) {
    $erroreak[] = "Emaila hutsik dago.";
} elseif (!validarEmail($emaila)) {
    $erroreak[] = "Emaila ez da zuzena.";
}


// FECHA
if (empty($alokairuData)) {
    $erroreak[] = "Alokairu data bete behar da.";
}


// DNI
if (empty($nan)) {

    $erroreak[] = "NAN bete behar da.";
} elseif (!validarDNI($nan)) {

    $letraZuzena = letraCorrectaDNI($nan);

    $erroreak[] =
        "NAN ez da zuzena. Letra zuzena izango litzateke: "
        . $letraZuzena;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Emaitzak</title>
</head>

<body>

    <h1>Emaitzak</h1>

    <?php if (count($erroreak) == 0) : ?>

        <p>Mail zuzena: <?= $emaila ?></p>

        <p>
            Itzulketa-data:
            <?= calcularFechaDevolucion($alokairuData) ?>
        </p>

        <p>NAN zuzena: <?= $nan ?></p>

    <?php else : ?>

        <h3>Erroreak:</h3>

        <?php
        foreach ($erroreak as $errorea) {
            echo "<p>$errorea</p>";
        }
        ?>

        <a href="index.php">Bueltatu formulariora</a>

    <?php endif; ?>

</body>

</html>