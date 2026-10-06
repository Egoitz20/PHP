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

        //fetchAll() erabiltzen da, lerro bat baino gehiago itzultzen delako
        $emaitza = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Partaidea::class);

        return $emaitza;
    }

    public function taldeakPartaideakBistaratu($id): ?array
    {
        // talde baten informazioa bistartzen du partaideekin
        $sql = "SELECT 
                    t.izena AS TALDE_IZENA, 
                    t.puntuak AS TALDE_PUNTUAK, 
                    p.izena AS PARTAIDE_IZENA, 
                    p.herrialdea AS PARTAIDE_HERRIALDEA 
                FROM taldea t 
                INNER JOIN partaideak p ON t.id = p.taldea_id 
                WHERE t.id = :id";

        $stmt = $this->db->getKonexioa()->prepare($sql);
        $stmt->execute(
            [
                'id' => $id
            ]
        );

        $emaitza = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, PartaideTaldeak::class);

        return $emaitza;
    }
}
