<?php

/**
 * MySQL/MariaDB datu-base baten konexioa kudeatzen du PDO erabiliz.
 */
class DB {
    private ?PDO $konexioa = null;
    private string $host;
    private string $db;
    private string $user;
    private string $pass;

    /**
     * Eraikitzailea.
     */
    public function __construct()
    {
        $this->host = "localhost";
        $this->db   = "hackaton";
        $this->user = "wesuser";
        $this->pass = "123456";
    }

    /**
     * Konexioa ireki eta gorde atributu moduan.
     */
    public function konektatu(): PDO
    {
        // DSN-a: motorra, zerbitzaria, datu-basea eta karaktere-jokoa.
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4";

        $aukerak = [
            // Erroreak salbuespen (exception) moduan jaurti.
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            // Emaitzak array asoziatibo moduan itzuli lehenetsita.
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            // Zerbitzariko prepared statement errealak erabili.
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->konexioa = new PDO($dsn, $this->user, $this->pass, $aukerak);
        } catch (PDOException $e) {
            // Errore bat egon bada, bukatu aplikazioa.
            printf("Konexio errorea: %s\n", $e->getMessage());
            die();
        }

        return $this->konexioa;
    }

    /**
     * Bueltatu konexio atributua.
     */
    public function getKonexioa(): PDO
    {
        return $this->konexioa;
    }
}