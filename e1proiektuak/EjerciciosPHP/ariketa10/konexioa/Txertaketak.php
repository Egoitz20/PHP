<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

class Txertaketak
{
    private Db $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function txertatuTaldea(Taldea $t)
    {
        $sql = "INSERT INTO taldea (izena, puntuak) VALUES (:izena, :puntuak)";

        $stmt = $this->db->getKonexioa()->prepare($sql);
        $stmt->execute(
            [
                'izena' => $t->izena,
                'puntuak' => $t->puntuak
            ]
        );
    }
}
