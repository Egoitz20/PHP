<?php
require_once "./konexioa/Db.php";
require_once "./konexioa/Kontsultak.php";
require_once "./klaseak/Taldea.php";

// SESSION gordetzen den informazioa gordetzen da.
session_start();

$db = new Db;
$db->konektatu();

$taldeak = new Kontsultak($db);

// Taldea izena ez badago hutsik, gordetuko da nabigatzailean cookie batean 3600 segundu.
if (isset($_SESSION["taldea"])) {
    setcookie('taldea_cookie', $_SESSION['taldea'], time() + 3600);
}
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
                    <th>PUNTU ALDAKETA</th>
                    <th>EZABAKETA</th>
                    <th>GOGOKOENA</th>
                </tr>

                <?php

                //Dinamikoki sortutako taldeak erakusten dira. 
                foreach ($taldeak->sailkapenaBistaratu() as $erakTalde) {
                    echo "<tr>";
                    echo "<td>" . $erakTalde->id . "</td>";
                    // Talde izenaren esteka emanez gero, "partaideak.php" joango da, eta erabakitutako taldearen izena eta id-a jasoko du "partaideak.php"
                    echo "<td><a href='./pages/partaideak.php?taldea=$erakTalde->izena&taldeId=$erakTalde->id'>" . $erakTalde->izena . "</a></td>";
                    echo "<td>" . $erakTalde->puntuak . "</td>";
                ?>
                    <td>
                        <form action="./prozesatu/botoiKonfiguraketa.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $erakTalde->id; ?>">
                            <input type="submit" name="akzioa" value="Aldatu">
                        </form>
                    </td>

                    <td>
                        <form action="./prozesatu/botoiKonfiguraketa.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $erakTalde->id; ?>">
                            <input type="submit" name="akzioa" value="Ezabatu">
                        </form>
                    </td>

                    <td>
                        <form action="./prozesatu/botoiKonfiguraketa.php" method="post">
                            <input type="hidden" name="izena" value="<?php echo $erakTalde->izena; ?>">
                            <input type="submit" name="akzioa" value="Gogokoena">
                        </form>
                    </td>
                <?php
                    echo "</tr>";
                }
                ?>

            </table>
        </div>
    </div>

    <div>
        <h2>Gehitu taldea</h2>
        <div>
            <form action="./prozesatu/taldeaProzesatu.php" method="post">
                <label>Izena: </label>
                <input type="text" name="izena">

                <?php if (!empty($_GET['erroreIzena'])) {
                    echo $_GET['erroreIzena'];
                } ?>

                <br /><br />
                <label>Puntuak: </label>
                <input type="number" name="puntuak">

                <?php if (!empty($_GET['errorePuntuak'])) {
                    echo $_GET['errorePuntuak'];
                } ?>

                <br /><br />
                <input type="submit" value="Bidali">
            </form>
        </div>
    </div>

    <div>
        <?php
        // "Gogokoena" botoairi emanez gero, taldearen izena hartzen da eta aukeratuko taldea mesua erakusten da. 
        if (isset($_SESSION["taldea"])) {
            echo "Zure talde gustokoena: " . $_SESSION["taldea"];
        } else {
            echo "Ez daukazu horaindik talde gustokoena. ";
        }
        ?>
    </div>
</body>

</html>