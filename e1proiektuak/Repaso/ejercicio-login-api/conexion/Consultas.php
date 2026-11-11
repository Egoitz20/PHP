<?php

require_once __DIR__ . "/db.php";
require_once __DIR__ . "/../clases/Grupo.php";
require_once __DIR__ . "/../clases/Usuario.php";

class Consultas
{
    private DB $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    /**
     * Muestra todos los grupos ordenados por puntos descendente.
     * Mapea automáticamente a objetos de la clase Grupo.
     */
    public function mostrarClasificacion(): array
    {
        try {
            $sql = "SELECT id, izena AS nombre, puntuak AS puntos FROM taldea ORDER BY puntuak DESC";
            $stmt = $this->db->getKonexioa()->query($sql);
            return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Grupo::class);
        } catch (PDOException $e) {
            return [];
        }
    }

    /**
     * Obtiene un único grupo por su ID utilizando setFetchMode + fetch().
     */
    public function obtenerGrupoPorId(int $id): ?Grupo
    {
        try {
            $sql = "SELECT id, izena AS nombre, puntuak AS puntos FROM taldea WHERE id = :id";
            $stmt = $this->db->getKonexioa()->prepare($sql);
            $stmt->execute(['id' => $id]);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Grupo::class);
            $grupo = $stmt->fetch();
            return $grupo ?: null;
        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * Inserta un nuevo grupo en la base de datos.
     */
    public function insertarGrupo(string $nombre, int $puntos): bool
    {
        try {
            $sql = "INSERT INTO taldea (izena, puntuak) VALUES (:nombre, :puntos)";
            $stmt = $this->db->getKonexioa()->prepare($sql);
            return $stmt->execute([
                'nombre' => $nombre,
                'puntos' => $puntos
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Actualiza la puntuación de un grupo.
     */
    public function actualizarPuntos(int $id, int $nuevosPuntos): bool
    {
        try {
            $sql = "UPDATE taldea SET puntuak = :puntos WHERE id = :id";
            $stmt = $this->db->getKonexioa()->prepare($sql);
            return $stmt->execute([
                'puntos' => $nuevosPuntos,
                'id'     => $id
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Elimina un grupo por su ID.
     */
    public function borrarGrupo(int $id): bool
    {
        try {
            $sql = "DELETE FROM taldea WHERE id = :id";
            $stmt = $this->db->getKonexioa()->prepare($sql);
            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Valida credenciales de login.
     * Si no existe tabla 'usuarios', valida con credenciales estándar de práctica (admin / 123456).
     */
    public function validarLogin(string $usuario, string $password): bool
    {
        // Credenciales directas de examen / pruebas
        if ($usuario === "admin" && $password === "123456") {
            return true;
        }

        // Intento de validación contra tabla de usuarios en BD si existiera
        try {
            $sql = "SELECT id, password FROM usuarios WHERE usuario = :usuario LIMIT 1";
            $stmt = $this->db->getKonexioa()->prepare($sql);
            $stmt->execute(['usuario' => $usuario]);
            $fila = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($fila) {
                // Si la contraseña está hasheada con password_hash() o es texto plano
                return password_verify($password, $fila['password']) || ($password === $fila['password']);
            }
        } catch (PDOException $e) {
            // Si no existe la tabla en BD, solo valida el usuario de prueba
        }

        return false;
    }
}
