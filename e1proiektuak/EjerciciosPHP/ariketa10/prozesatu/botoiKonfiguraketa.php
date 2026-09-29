<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["akzioa"])) {
        $botoi_aukeratuta = $_POST["akzioa"];

        if ($botoi_aukeratuta === "Aldatu") {
            echo "aldatu botoia ukitu duzu";
        } else if ($botoi_aukeratuta === "Ezabatu") {
            echo "ezabatu botoia ukitu duzu";
        } else if ($botoi_aukeratuta === "Gogokoena") {
            echo "gogoko botoia ukitu duzu";
        }
    } else {
        echo "Ez da ezer ukitu";
    }




}