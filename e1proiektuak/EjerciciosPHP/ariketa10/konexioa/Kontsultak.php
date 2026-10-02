<?php

class Kontsultak
{
    private Db $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    // 
    public function sailkapenaBistaratu(): array
    {

        // "index.php" orrian, taulan, taldeak bistaratuko dira. 
        $sql = "SELECT * FROM taldea";

        $stmt = $this->db->getKonexioa()->query($sql);

        // Bistaratzen denez lerro bat baino gehiago, "Taldea" klaseko "fetchAll()" egingo da. 
        // Bistaratzen bada lerro bat bakarrik, "fetch()" erabili beharko da, eta "Taldea" objektua itzuliko da, ez array-a.    
        $emaitza = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Taldea::class);

        return $emaitza;
    }

    public function partehartzaileakBistaratu($taldeIzena): array
    {
        // "partaideak.php" orrian, taldearen partaideak bistaratuko dira.
        $sql = "SELECT p.id, p.izena, p.herrialdea 
        FROM partaideak AS p 
        INNER JOIN taldea AS t
        ON p.taldea_id = t.id
        WHERE t.izena = :taldeIzena";

        // "query()" ez da erabiltzen, kontsulta kampo espezifiko erakusten denez, "prepare()" erabiliko da segurtasunagaitik.
        $stmt = $this->db->getKonexioa()->prepare($sql);

        $stmt->execute(
            [
                'taldeIzena' => $taldeIzena
            ]
        );

        $emaitza = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Partaidea::class);

        return $emaitza;
    }
}
