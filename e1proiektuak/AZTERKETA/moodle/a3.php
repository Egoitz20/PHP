<?php

require_once "db.php";

$mendiAurkituta = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $lurraldea = trim($_POST["lurraldea"]);
    $altueraMin = trim($_POST["altueraMin"]);
    $errore = "";


    if ($altueraMin < 0 || $altueraMin > 2500) {
        $errore = "Altuera minimoa 0 eta 2500 arteko zenbaki bat izan behar da.";
    } else {
        $db = new DB;
        $emaitzak = $db->selectAll();

        foreach ($emaitzak as $m) {
            if ($m['altuera'] >= $altueraMin && $m['lurraldea'] == $lurraldea) {
                $mendiAurkituta[] = $m;
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A3</title>
</head>

<body>
    <div style="border: 2px solid black; padding: 10px; margin-bottom: 15px;">
        <?php
        if (!empty($errore)) {
            echo $errore;
        } else {
            foreach ($emaitzak as $emaitza) {
                echo "<p>";
                echo "<strong>" . htmlspecialchars($emaitza['izena']) . "</strong> - ";
                echo htmlspecialchars($emaitza['lurraldea']) . " - ";
                echo (int) $emaitza['altuera'] . " m";
                echo "</p>";
            }
        }
        ?>
    </div>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label>Lurraldea: </label>

        <select name="lurraldea">
            <option value="">Guztiak</option>
            <option value="Araba">Araba</option>
            <option value="Bizkaia">Bizkaia</option>
            <option value="Gipuzkoa">Gipuzkoa</option>
            <option value="Nafarroa">Nafarroa</option>
        </select>
        <br>
        <label>Altuera minimoa (m): </label>

        <input type="text" name="altueraMin">
        <br>
        <input type="submit" value="Bilatu">
    </form>
</body>

</html>