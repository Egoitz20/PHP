<?php
require_once "../konexioa/Db.php";
require_once "../konexioa/Kontsultak.php";
require_once "../klaseak/Partaidea.php";

$db = new Db;
$db->konektatu();

$taldeak = new Kontsultak($db);

$taldeIzena = $_GET['taldea'];
$taldeId = $_GET['taldeId'];

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partaideak orria</title>
</head>

<body>
    <h1><?php echo $taldeIzena; ?> - Partaideak</h1>

    <?php if (!empty($_GET['error'])) {
        echo $_GET['error'];
    } ?>

    <table border="1px">
        <tr>
            <th>ID</th>
            <th>Izena</th>
            <th>Herrialdea</th>
        </tr>
        <?php
        foreach ($taldeak->partehartzaileakBistaratu($taldeIzena) as $partekideak) {
            echo "<tr>";
            echo "<td>$partekideak->id</td>";
            echo "<td>$partekideak->izena</td>";
            echo "<td>$partekideak->herrialdea</td>";
            echo "</tr>";
        }

        ?>
    </table>

    <h2>Gehitu partaidea</h2>

    <form action="../prozesatu/partaideakProzesatu.php" method="post">
        <label>Izena: </label>
        <input type="text" name="izena">
        <br /><br />
        <label>Herrialdea: </label>
        <input type="text" name="herrialdea">
        <br /><br />
        <input type="submit" value="Sortu">

        <input type="hidden" name="taldeaId" value="<?php echo $taldeId; ?>">
        <input type="hidden" name="taldeaIzena" value="<?php echo $taldeIzena; ?>">
    </form>

    <a href="../index.php">Itzuli</a>
</body>

</html>