<?php

class Consultas
{

    private db $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function mostrarClasificacion(): array
    {
        $sql = "SELECT * FROM taldea";

        $stmt = $this->db->getKonexioa()->query($sql);

        $resultado = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Grupo::class);

        return $resultado;
    }

    public function mostrarParticipantes($nombreGrupo): array
    {

        $sql = "SELECT p.id, p.izena, p.herrialdea
        FROM partaideak AS p
        INNER JOIN taldea AS t
        ON p.taldea_id = t.id
        WHERE t.izena = :nombreGrupo";

        $stmt = $this->db->getKonexioa()->prepare($sql);

        $stmt->execute(
            [
                'nombreGrupo' => $nombreGrupo
            ]
        );

        $resultado = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Participante::class);

        return $resultado;
    }
}
