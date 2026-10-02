<?php

class Kontsultak
{
    private Db $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function sailkapenaBistaratu(): array
    {

        $sql = "SELECT * FROM taldea";

        $stmt = $this->db->getKonexioa()->query($sql);

        $emaitza = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Taldea::class);

        return $emaitza;
    }

    public function partehartzaileakBistaratu($taldeIzena): array
    {

        $sql = "SELECT p.id, p.izena, p.herrialdea 
        FROM partaideak AS p 
        INNER JOIN taldea AS t
        ON p.taldea_id = t.id
        WHERE t.izena = :taldeIzena";

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
