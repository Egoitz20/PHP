<?php
require_once "./konexioa/Db.php";
require_once "./konexioa/Kontsultak.php";
require_once "./klaseak/Taldea.php";

$db = new Db;
$db->konektatu();

$taldeak = new Kontsultak($db);
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talde zerrenda</title>
</head>

<body>
    <div>
        <h1>Sailkapena</h1>
        <div>
            <table border="1px">
                <tr>
                    <th>ID</th>
                    <th>IZENA</th>
                    <th>PUNTUAK</th>
                    <th>BOTOI ALDAKETA</th>
                    <th>BOTOI EZABAKETA</th>
                    <th>BOTOI GOGOKOENA</th>
                </tr>
                <tr>
                    <?php
                    foreach ($taldeak->sailkapenaBistaratu() as $erakTalde) {
                        echo "<td>" . $erakTalde->id . "</td>";
                        echo "<td><a href='./pages/partaideak.php'>" . $erakTalde->izena . "</a></td>";
                        echo "<td>" . $erakTalde->puntuak . "</td>";
                    ?>
                        <form action="./prozesatu/botoiKonfiguraketa.php" method="post">
                            <?php
                            echo "<th> <input type='submit' name='akzioa' value='Aldatu'> </th>";
                            echo "<th> <input type='submit' name='akzioa' value='Ezabatu'> </th>";
                            echo "<th> <input type='submit' name='akzioa' value='Gogokoena'> </th>";
                            ?>
                        </form>
                    <?php
                    }
                    ?>
                </tr>
            </table>
        </div>
    </div>

    <div>
        <h2>Gehitu taldea</h2>
        <div>
            <form action="./prozesatu/taldeaProzesatu.php" method="post">
                <label>Izena: </label>
                <input type="text" name="izena">
                <br /><br />
                <label>Puntuak: </label>
                <input type="number" name="puntuak">
                <br /><br />
                <input type="submit" value="Bidali">
            </form>
        </div>
    </div>
</body>

</html>