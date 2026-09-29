<?php

/**
 * Erabiltzaileak taula kudeatzen duen klasea.
 */
class ErabiltzaileaDB {
    private DB $db;

    /**
     * Datu-base objektu bat pasatzen zaio eraikitzailean.
     */
    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    /**
     * Erabiltzaile guztiak bueltatzen ditu array asoziatibo batean.
     */
    public function getAll(): array
    {
        // SELECT kontsulta exekutatu (parametrorik ez dagoenez, query() nahikoa da).
        $stmt = $this->db->getKonexioa()->query("SELECT * FROM erabiltzaileak");
        // Errenkada bakoitza Erabiltzailea objektu bat izango da.
        return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Erabiltzailea::class);
    }

    /**
     * Lortu erabiltzaile bakar bat bere id atributuaren arabera.
     */
    public function get(int $userId): ?Erabiltzailea
    {
        $stmt = $this->db->getKonexioa()->prepare("SELECT id, izena FROM erabiltzaileak WHERE id = :id");
        $stmt->execute(['id' => $userId]);
        // Adierazi emaitza Erabiltzailea objektu bihurtu behar dela.
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Erabiltzailea::class);
        // fetch()-ek false itzultzen du errenkadarik ez badago.
        $e = $stmt->fetch();
        return $e === false ? null : $e;
    }


    /**
     * Erabiltzaile berri bat sortzen du eta bere id-a bueltatzen du.
     * Objektuaren id atributua ere eguneratzen da.
     */
    public function create(Erabiltzailea $e): int
    {
        $stmt = $this->db->getKonexioa()->prepare("INSERT INTO erabiltzaileak (izena) VALUES (:izena)");
        $stmt->execute(['izena' => $e->izena]);
        // Txertatutako azken erregistroaren id-a lortu eta objektuan gorde.
        $e->id = (int) $this->db->getKonexioa()->lastInsertId();
        return $e->id;
    }


    /**
     * Ezabatu erabiltzailea.
     */
    public function delete(int $id): bool
    {
        $stmt = $this->db->getKonexioa()->prepare("DELETE FROM erabiltzaileak WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    /**
     * EZ SEGURUA: Lortu erabiltzaile bakar bat bere id atributuaren arabera.
     * SQL injekzioa erakusteko adibidea. EZ ERABILI HONELA!
     */
    public function getEzSegurua($userId): ?Erabiltzailea
    {
        // Parametroa zuzenean kateatzen da SQL-an: injekzioa posible da.
        $stmt = $this->db->getKonexioa()->query("SELECT id, izena FROM erabiltzaileak WHERE id = " . $userId);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Erabiltzailea::class);
        $e = $stmt->fetch();
        return $e === false ? null : $e;
    }
}
