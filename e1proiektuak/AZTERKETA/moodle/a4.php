<?php
// Behar diren "require" idatzi.
require_once "db.php";
require_once "interface.php";

// Klase definizioa.
class Mendia implements Sailkagarria
{
    private DB $db;

    private ?int $id;
    private string $izena;
    private string $lurraldea;
    private int $altuera;
    private float $distantzia;
    private ?int $desnibela;

    public function __construct(
        DB $db,
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

    public function getIzena(): string
    {
        return $this->izena;
    }

    public function getLurraldea(): string
    {
        return $this->lurraldea;
    }

    public function getAltuera(): int
    {
        return $this->altuera;
    }

    public function getDistantzia(): float
    {
        return $this->distantzia;
    }

    public function getDesnibela(): ?int
    {
        return $this->desnibela;
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

$db = new DB();
$mendiak = [];
foreach ($db->selectAll() as $erregistroa) {
    $mendiak[] = new Mendia(
        $db,
        (int) $erregistroa['id'],
        $erregistroa['izena'],
        $erregistroa['lurraldea'],
        (int) $erregistroa['altuera'],
        (float) $erregistroa['distantzia'],
        (int) $erregistroa['desnibela']
    );
}
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
                <td><?php echo htmlspecialchars($mendia->getIzena()); ?></td>
                <td><?php echo htmlspecialchars($mendia->getLurraldea()); ?></td>
                <td><?php echo $mendia->getAltuera(); ?></td>
                <td><?php echo $mendia->getDistantzia(); ?></td>
                <td><?php echo $mendia->getDesnibela(); ?></td>
                <td><?php echo htmlspecialchars($mendia->zailtasunMaila()); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>