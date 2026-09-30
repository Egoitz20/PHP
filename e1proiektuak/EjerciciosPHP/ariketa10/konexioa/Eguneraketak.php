<?php

class Eguneraketak
{
    private Db $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function puntuazioaAldatu($id, $puntuazioBerria)
    {
        $sql = "UPDATE taldea SET puntuak = :puntuazioBerria WHERE id = :id";

        $stmt = $this->db->getKonexioa()->prepare($sql);

        $stmt->execute(
            [
                'puntuazioBerria' => $puntuazioBerria,
                'id' => $id
            ]
        );
    }
}
