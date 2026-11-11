<?php

class Agregaciones
{
    private db $db;

    public function __construct(db $db)
    {
        $this->db = $db;
    }

    public function agregarGrupo(Grupo $g)
    {
        $sql = "INSERT INTO taldea (izena, puntuak) VALUES (:izena, :puntuak)";

        $stmt = $this->db->getKonexioa()->prepare($sql);
        $stmt->execute([
            'izena' => $g->izena,
            'puntuak' => $g->puntuak
        ]);
    }
}
