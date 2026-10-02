<?php

class Txertaketak
{
    private Db $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function txertatuTaldea(Taldea $t)
    {
        // ":izena" eta ":puntuak" "index.php" formulariotik jasotzean, taldea sortuko da.
        $sql = "INSERT INTO taldea (izena, puntuak) 
        VALUES (:izena, :puntuak)";

        $stmt = $this->db->getKonexioa()->prepare($sql);
        $stmt->execute(
            [
                'izena' => $t->izena,
                'puntuak' => $t->puntuak
            ]
        );
    }

    public function txertatuPartaideak(Partaidea $p)
    {

        // ":izena", ":herrialdea" eta "taldea_id" "partaideak.php" formulariotik jasotzean, partaidea sortuka da taldearen barruan. 
        $sql = "INSERT INTO partaideak (izena, herrialdea, taldea_id) 
        VALUES (:izena, :herrialdea, :taldea_id)";

        $stmt = $this->db->getKonexioa()->prepare($sql);
        $stmt->execute(
            [
                'izena' => $p->izena,
                'herrialdea' => $p->herrialdea,
                'taldea_id' => $p->taldea_id
            ]
        );
    }
}
