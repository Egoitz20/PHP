<?php

class Kontsultak {
    private Db $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function sailkapenaBistaratu(): array {

        $sql = "SELECT * FROM taldea";

        $stmt = $this->db->getKonexioa()->query($sql);

        $emaitza = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Taldea::class);

        return $emaitza;

    }
}