<?php

require_once "db.php";

$db = new DB;

$mendiak = [
    ["izena" => "Anboto",               "lurraldea" => "Bizkaia",  "altuera" => 1331, "distantzia" => 9.0,  "desnibela" => 1080],
    ["izena" => "Hiru Erregeen Mahaia", "lurraldea" => "Nafarroa", "altuera" => 2428, "distantzia" => 12.0, "desnibela" => 1300],
    ["izena" => "Mugarra",              "lurraldea" => "Bizkaia",  "altuera" => 964,  "distantzia" => 7.5,  "desnibela" => 610],
    ["izena" => "Ortzanzurieta",        "lurraldea" => "Nafarroa", "altuera" => 1567, "distantzia" => 9.0,  "desnibela" => 650],
    ["izena" => "Pagoeta",              "lurraldea" => "Gipuzkoa", "altuera" => 676,  "distantzia" => 6.0,  "desnibela" => 450],
    ["izena" => "Txindoki",             "lurraldea" => "Gipuzkoa", "altuera" => 1346, "distantzia" => 10.0, "desnibela" => 1050],
    ["izena" => "Saioa",                "lurraldea" => "Nafarroa", "altuera" => 1418, "distantzia" => 11.0, "desnibela" => 900],
    ["izena" => "Untzillaitz",          "lurraldea" => "Bizkaia",  "altuera" => 935,  "distantzia" => 6.5,  "desnibela" => 580],
    ["izena" => "Erlo",                 "lurraldea" => "Gipuzkoa", "altuera" => 1026, "distantzia" => 9.0,  "desnibela" => 780],
    ["izena" => "Ezkaba",               "lurraldea" => "Nafarroa", "altuera" => 895,  "distantzia" => 7.0,  "desnibela" => 450],
    ["izena" => "Udalaitz",             "lurraldea" => "Gipuzkoa", "altuera" => 1117, "distantzia" => 7.5,  "desnibela" => 620],
    ["izena" => "Orhi",                 "lurraldea" => "Nafarroa", "altuera" => 2021, "distantzia" => 6.0,  "desnibela" => 700],
    ["izena" => "Adi",                  "lurraldea" => "Nafarroa", "altuera" => 1458, "distantzia" => 8.5,  "desnibela" => 700],
    ["izena" => "Murumendi",            "lurraldea" => "Gipuzkoa", "altuera" => 868,  "distantzia" => 8.0,  "desnibela" => 640],
    ["izena" => "Aldamin",              "lurraldea" => "Araba",    "altuera" => 1376, "distantzia" => 10.0, "desnibela" => 760],
];
?>
<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A2</title>
</head>

<body>
    <table border="1">
        <tr>
            <th>Izena</th>
            <th>Lurraldea</th>
            <th>Altuera (m)</th>
            <th>Distantzia (km)</th>
            <th>Desnibela (m)</th>
        </tr>
        <?php
        $mezuak = [];
        $badago = false;

        foreach ($mendiak as $mendi) {
            if ($mendi["altuera"] >= 1000) {
                $badago = true;
                echo "<tr>";
                echo "<td>" . htmlspecialchars($mendi['izena']) . "</td>";
                echo "<td>" . htmlspecialchars($mendi['lurraldea']) . "</td>";
                echo "<td>" . (int) $mendi['altuera'] . "</td>";
                echo "<td>" . (float) $mendi['distantzia'] . "</td>";
                echo "<td>" . (int) $mendi['desnibela'] . "</td>";
                echo "</tr>";

                if ($db->existitzenDa($mendi['izena'])) {
                    $mezuak[] = htmlspecialchars($mendi['izena']) . ": dagoeneko erregistratuta dago.";
                } else {
                    $db->insert(
                        $mendi['izena'],
                        $mendi['lurraldea'],
                        $mendi['altuera'],
                        $mendi['distantzia'],
                        $mendi['desnibela']
                    );
                    $mezuak[] = htmlspecialchars($mendi['izena']) . ": datu-basean txertatu da.";
                }
            }
        }
        ?>
    </table>

    <?php
    if (!$badago) {
        echo "<p>Ez dago 1000 metrotik gorako mendirik.</p>";
    } elseif (!empty($mezuak)) {
        echo "<ul>";
        foreach ($mezuak as $mezua) {
            echo "<li>$mezua</li>";
        }
        echo "</ul>";
    }
    ?>
</body>

</html>