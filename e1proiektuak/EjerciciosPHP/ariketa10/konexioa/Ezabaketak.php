<?php

class Ezabaketak
{
    private Db $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function ezabatuTaldea($id)
    {
        $sql = "DELETE FROM taldea WHERE id = :id";

        $stmt = $this->db->getKonexioa()->prepare($sql);

        $stmt->execute(
            [
                'id' => $id
            ]
        );
    }
}
