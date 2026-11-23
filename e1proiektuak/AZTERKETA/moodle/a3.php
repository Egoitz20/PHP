<?php

require_once "db.php";

$db = new DB;

$lurraldea = "";
$altueraMin = "";
$errore = "";
$emaitzak = $db->selectAll();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $lurraldea = trim($_POST["lurraldea"] ?? "");
    $altueraMin = trim($_POST["altueraMin"] ?? "");

    if ($altueraMin !== "" && (!is_numeric($altueraMin) || (float) $altueraMin < 0 || (float) $altueraMin > 2500)) {
        $errore = "Altuera minimoa 0 eta 2500 arteko zenbaki bat izan behar da.";
        $emaitzak = [];
    } else {
        $emaitzak = array_filter($emaitzak, function (array $mendia) use ($lurraldea, $altueraMin): bool {
            if ($lurraldea !== "" && $mendia["lurraldea"] !== $lurraldea) {
                return false;
            }
            if ($altueraMin !== "" && (int) $mendia["altuera"] < (int) $altueraMin) {
                return false;
            }
            return true;
        });

        if (empty($emaitzak)) {
            $errore = "Ez dago baldintzak betetzen dituen mendirik";
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
            echo "<p>" . htmlspecialchars($errore) . "</p>";
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
            <option value="" <?php if ($lurraldea === "") echo "selected"; ?>>Guztiak</option>
            <option value="Araba" <?php if ($lurraldea === "Araba") echo "selected"; ?>>Araba</option>
            <option value="Bizkaia" <?php if ($lurraldea === "Bizkaia") echo "selected"; ?>>Bizkaia</option>
            <option value="Gipuzkoa" <?php if ($lurraldea === "Gipuzkoa") echo "selected"; ?>>Gipuzkoa</option>
            <option value="Nafarroa" <?php if ($lurraldea === "Nafarroa") echo "selected"; ?>>Nafarroa</option>
        </select>
        <br>
        <label>Altuera minimoa (m): </label>

        <input type="text" name="altueraMin" value="<?php echo htmlspecialchars($altueraMin); ?>">
        <br>
        <input type="submit" value="Bilatu">
    </form>
</body>

</html>