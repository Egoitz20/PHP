<?php
// Behar diren "require" idatzi.
require_once "db.php";
require_once "interface.php";

// Klase definizioa.
class Mendia implements Sailkagarria
{
    private ?DB $db = null;

    public ?int $id = null;
    public string $izena = "";
    public string $lurraldea = "";
    public int $altuera = 0;
    public float $distantzia = 0.0;
    public ?int $desnibela = null;

    public function __construct(
        ?DB $db = null,
        ?int $id = null,
        string $izena = "",
        string $lurraldea = "",
        int $altuera = 0,
        float $distantzia = 0.0,
        ?int $desnibela = null
    ) {
        $this->db = $db;
        $this->id = $id;
        $this->izena = $izena;
        $this->lurraldea = $lurraldea;
        $this->altuera = $altuera;
        $this->distantzia = $distantzia;
        $this->desnibela = $desnibela;
    }

    /**
     * Datu-baseko mendi guztiak Mendia objektuen array batean bueltatzen ditu.
     */
    public function selectAll(?DB $db = null): array
    {
        $dbKonexioa = $db ? $db->getKonexioa() : ($this->db ? $this->db->getKonexioa() : (new DB())->getKonexioa());
        $sql = "SELECT * FROM mendiak";
        $stmt = $dbKonexioa->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Mendia::class);
    }

    #[Override]
    public function zailtasunMaila(): string
    {
        if ($this->desnibela === null) {
            return "Ezezaguna";
        }

        if ($this->desnibela < 500) {
            return "Erraza";
        } elseif ($this->desnibela <= 999) {
            return "Ertaina";
        } else {
            return "Zaila";
        }
    }
}

// ── Datu-baseko konexioa ──
$db = new DB();

// "a4.php" orrian, taulan, mendiak bistaratuko dira.
$sql = "SELECT * FROM mendiak";

$stmt = $db->getKonexioa()->query($sql);

// Bistaratzen denez lerro bat baino gehiago, "Mendia" klaseko "fetchAll()" egingo da.
// Bistaratzen bada lerro bat bakarrik, "fetch()" erabili beharko da, eta "Mendia" objektua itzuliko da, ez array-a.
$mendiak = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Mendia::class);
?>


<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <title>A4</title>
</head>

<body>
    <table border="1">
        <tr>
            <th>Izena</th>
            <th>Lurraldea</th>
            <th>Altuera (m)</th>
            <th>Distantzia (km)</th>
            <th>Desnibela (m)</th>
            <th>Zailtasun maila</th>
        </tr>
        <?php foreach ($mendiak as $mendia): ?>
            <tr>
                <td><?= $mendia->izena; ?></td>
                <td><?= $mendia->lurraldea; ?></td>
                <td><?= $mendia->altuera; ?></td>
                <td><?= $mendia->distantzia; ?></td>
                <td><?= $mendia->desnibela; ?></td>
                <td><?= $mendia->zailtasunMaila(); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>