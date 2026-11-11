<?php
// Endpoint REST para Grupos
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . "/../conexion/db.php";
require_once __DIR__ . "/../conexion/Consultas.php";

$db = new DB();
$db->konektatu();
$consultas = new Consultas($db);

$metodo = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

switch ($metodo) {

    // ── 1. GET: Obtener todos o uno por ID ──
    case 'GET':
        if ($id === null) {
            $grupos = $consultas->mostrarClasificacion();
            http_response_code(200);
            echo json_encode($grupos, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } else {
            $grupo = $consultas->obtenerGrupoPorId($id);
            if ($grupo) {
                http_response_code(200);
                echo json_encode($grupo, JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(404);
                echo json_encode(["error" => "Grupo no encontrado"]);
            }
        }
        break;

    // ── 2. POST: Crear un nuevo grupo recibiendo JSON en el cuerpo ──
    case 'POST':
        // Lectura del cuerpo crudo con php://input
        $datos = json_decode(file_get_contents("php://input"), true);

        if (!isset($datos['nombre'], $datos['puntos']) || trim($datos['nombre']) === "") {
            http_response_code(400); // 400 Bad Request
            echo json_encode(["error" => "Los campos 'nombre' y 'puntos' son obligatorios"]);
            exit();
        }

        $exito = $consultas->insertarGrupo(htmlspecialchars($datos['nombre']), (int)$datos['puntos']);
        if ($exito) {
            http_response_code(201); // 201 Created
            echo json_encode(["mensaje" => "Grupo creado con éxito mediante API"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Error al guardar en la base de datos"]);
        }
        break;

    // ── 3. PUT: Actualizar puntuación recibiendo JSON ──
    case 'PUT':
        if ($id === null) {
            http_response_code(400);
            echo json_encode(["error" => "El parámetro 'id' es obligatorio en la URL"]);
            exit();
        }

        $datos = json_decode(file_get_contents("php://input"), true);
        if (!isset($datos['puntos'])) {
            http_response_code(400);
            echo json_encode(["error" => "El campo 'puntos' es obligatorio"]);
            exit();
        }

        $exito = $consultas->actualizarPuntos($id, (int)$datos['puntos']);
        if ($exito) {
            http_response_code(200);
            echo json_encode(["mensaje" => "Puntuación actualizada correctamente"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Error al actualizar"]);
        }
        break;

    // ── 4. DELETE: Borrar por ID ──
    case 'DELETE':
        if ($id === null) {
            http_response_code(400);
            echo json_encode(["error" => "El parámetro 'id' es obligatorio en la URL"]);
            exit();
        }

        $exito = $consultas->borrarGrupo($id);
        if ($exito) {
            http_response_code(200);
            echo json_encode(["mensaje" => "Grupo eliminado correctamente"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Error al eliminar"]);
        }
        break;

    default:
        http_response_code(405); // 405 Method Not Allowed
        echo json_encode(["error" => "Método HTTP no permitido"]);
        break;
}

