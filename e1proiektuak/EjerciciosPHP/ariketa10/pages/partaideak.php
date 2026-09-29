<?php
$taldea = "";

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partaideak orria</title>
</head>

<body>
    <h1><?php $taldea ?> - Partaideak</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Izena</th>
            <th>Herrialdea</th>
        </tr>
        <tr>

        </tr>
    </table>

    <h2>Gehitu partaidea</h2>

    <form action="" method="post">
        <label>Izena: </label>
        <input type="text" name="izena">
        <br /><br />
        <label>Herrialdea: </label>
        <input type="text" name="herrialdea">
        <br /><br />
        <input type="submit" value="Sortu">
    </form>

    <a href="../index.php">Itzuli</a>
</body>

</html>