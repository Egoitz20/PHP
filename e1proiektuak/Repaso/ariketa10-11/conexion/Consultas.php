<?php

class Consultas
{

    private db $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    function mostrarClasificacion()
    {
        $sql = "SELECT * FROM taldea";

        $stmt = $this->db->getKonexioa()->query($sql);

        $resultado = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Grupo::class);

        return $resultado;
    }
}
