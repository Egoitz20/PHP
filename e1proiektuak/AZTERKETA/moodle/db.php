<?php

class DB
{
    private ?PDO $konexioa = null;
    private string $host;
    private string $user;
    private string $pass;
    private string $db;

    /**
     * Eraikitzailea.
     */
    public function __construct()
    {
        $this->host = "localhost";
        $this->user = "wesuser";
        $this->pass = "123456";
        $this->db   = "e1azterketa";
    }

    /**
     * Konexioa ireki eta gorde atributu moduan.
     */
    public function konektatu(): PDO
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=utf8mb4";
        $aukerak = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
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
     * Bueltatu konexio atributua (irekita ez badago, ireki).
     */
    public function getKonexioa(): PDO
    {
        if ($this->konexioa === null) {
            $this->konektatu();
        }
        return $this->konexioa;
    }

    /**
     * Destruktorea: PDO-n konexioa ixteko nahikoa da null esleitzea.
     */
    public function __destruct()
    {
        $this->konexioa = null;
    }

    //
    // 1. ARIKETA: GARATU BEHAR DIREN METODOAK
    // Kontsulta guztiek prepared statement-ak erabili behar dituzte.
    //

    // INSERT INTO mendiak (izena, lurraldea, altuera, distantzia, desnibela) VALUES (:izena, :lurraldea, ...)
    // Txertatutako erregistroaren id-a bueltatuko du.
    public function insert(string $izena, string $lurraldea, int $altuera, float $distantzia, int $desnibela): int
    {
        $sql = "INSERT INTO mendiak (izena, lurraldea, altuera, distantzia, desnibela)
                VALUES (:izena, :lurraldea, :altuera, :distantzia, :desnibela)";

        $stmt = $this->getKonexioa()->prepare($sql);
        $stmt->execute([
            'izena' => $izena,
            'lurraldea' => $lurraldea,
            'altuera' => $altuera,
            'distantzia' => $distantzia,
            'desnibela' => $desnibela,
        ]);

        return (int) $this->getKonexioa()->lastInsertId();
    }

    // SELECT * FROM mendiak
    // Mendi guztiak bueltatuko ditu array asoziatiboen array batean.
    public function selectAll(): array
    {
        $sql = "SELECT * FROM mendiak";

        $stmt = $this->getKonexioa()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // SELECT * FROM mendiak WHERE id = :id
    // Mendia array asoziatibo moduan bueltatuko du, edo false ez badago.
    public function selectById(int $id): array|false
    {
        $sql = "SELECT * FROM mendiak WHERE id = :id";

        $stmt = $this->getKonexioa()->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch();
    }

    // SELECT * FROM mendiak WHERE izena = :izena
    // true bueltatuko du izen hori duen mendirik badago, false bestela.
    public function existitzenDa(string $izena): bool
    {
        $sql = "SELECT * FROM mendiak WHERE izena = :izena";

        $stmt = $this->getKonexioa()->prepare($sql);
        $stmt->execute(['izena' => $izena]);

        return $stmt->fetch() !== false;
    }

    // DELETE FROM mendiak WHERE id = :id
    public function delete(int $id): void
    {
        $sql = "DELETE FROM mendiak WHERE id = :id";

        $stmt = $this->getKonexioa()->prepare($sql);
        $stmt->execute(['id' => $id]);
    }
}
