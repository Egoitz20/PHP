<?php
require_once '../konexioa/Db.php';
require_once '../konexioa/Eguneraketak.php';
require_once '../konexioa/Ezabaketak.php';

session_start();

$db = new Db;
$db->konektatu();

$puntuakAldatu = new Eguneraketak($db);
$taldeaEzabatu = new Ezabaketak($db);

$puntuaErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["akzioa"])) {

        $botoiAukeratuta = $_POST["akzioa"];

        // "Aldatu" botoia konfigurazioa
        if ($botoiAukeratuta === "Aldatu") {
            $idAukeratuta = $_POST["id"];
            // Erabiltzaileare formulario berri bat erakutsiko dio taldeko puntuak aldatzeko.
            // Funtzioaren kokapena: 57 linea
            puntuazioBerriaJaso($idAukeratuta);

            // "Ezabatu" botoia konfigurazioa
        } else if ($botoiAukeratuta === "Ezabatu") {
            $idAukeratuta = $_POST["id"];
            // Aukeratutako taldea id jasotzen du eta taldea eta barruko partaideak ezabatzen dira. 
            // Funtzioaren ruta: "../konexioa/Ezabaketak.php"
            $taldeaEzabatu->ezabatuTaldea($idAukeratuta);
            header("Location: ../index.php");
            exit();
            // "Gogokoena" botoia konfigurazioa
        } else if ($botoiAukeratuta === "Gogokoena") {
            $jasotakoIzena = $_POST["izena"];
            // Erabakitutako taldearen izena $_SESSION gordeko da. 
            $_SESSION["taldea"] = $jasotakoIzena;
            header("Location: ../index.php");
            exit();
        }
    } else {
        echo "Ez da ezer ukitu";
    }

    if (isset($_POST["puntuazioBerria"])) {
        $puntuazioaBerria = $_POST["puntuazioBerria"];
        $idAukeratuta2 = $_POST["id2"];

        if ($idAukeratuta2 !== null && $puntuazioaBerria !== "") {
            // Erabakitutako taldearen puntuazioa eguneratzen da erabiltzailearen ipinitutako puntuazio berriarekin
            // Funtzioaren ruta: "../konexioa/Eguneraketak.php"
            $puntuakAldatu->puntuazioaAldatu($idAukeratuta2, $puntuazioaBerria);
            header("Location: ../index.php");
            exit();
        } else {
            $puntuaErr = "Ez dago ezer idatzita!";
            header("Location: ../index.php?erroreIzena=$puntuaErr");
            exit();
        }
    }
}

// Puntuazio aldaketaren formularioa erakusten dio erabiltzaileari
function puntuazioBerriaJaso($jasotakoId)
{
?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label>Zein da puntuazio berria adostuta?</label>
        <input type="text" name="puntuazioBerria">
        <input type="hidden" name="id2" value="<?php echo $jasotakoId; ?>">
        <input type="submit" value="Ipini">
    </form>
<?php
}
