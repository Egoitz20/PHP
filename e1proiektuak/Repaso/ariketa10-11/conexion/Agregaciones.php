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

    public function agregarParticipantes(Participante $p)
    {

        $sql = "INSERT INTO partaideak (izena, herrialdea, taldea_id)
        VALUES (:nombre, :ciudad, :id_grupo)";

        $stmt = $this->db->getKonexioa()->prepare($sql);
        $stmt->execute(
            [
                'nombre' => $p->izena,
                'ciudad' => $p->herrialdea,
                'id_grupo' => $p->taldea_id
            ]
        );
    }
}
