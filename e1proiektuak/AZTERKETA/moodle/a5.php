<?php
header("Content-Type: application/json; charset=UTF-8");

require_once "db.php";

$db = new DB;
$db->konektatu();

const LURRALDEAK = ['Araba', 'Bizkaia', 'Gipuzkoa'];
$metodoa = $_SERVER['REQUEST_METHOD'];

switch ($metodoa) {
    case 'GET':
        $mendiakBistaratu = [];

        foreach ($db->selectAll() as $mendiak) {
            if (in_array($mendiak['lurraldea'], LURRALDEAK, true)) {
                $mendiakBistaratu[] = [
                    "id" => $mendiak['id'],
                    "izena" => $mendiak['izena'],
                    "lurraldea" => $mendiak['lurraldea'],
                    "altuera" => $mendiak['altuera'],
                    "distantzia" => $mendiak['distantzia'],
                    "desnibela" => $mendiak['desnibela']
                ];
            }
        }
        http_response_code(200);
        echo json_encode($mendiakBistaratu, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        break;

    case 'DELETE':
        /*
        DELETE eskaeraren gorputza (adibidea):
        {"ezabatu": [{"id": 3}, {"id": 8}, {"id": 99}]}

        DELETE eskaeraren erantzuna (adibidea):
        {"ezabatuak": [3, 8], "ez_daudenak": [99]}
        */
        $gorputza = json_decode(file_get_contents("php://input"), true);

        if (!is_array($gorputza) || !isset($gorputza['ezabatu']) || !is_array($gorputza['ezabatu'])) {
            http_response_code(400);
            echo json_encode(["errorea" => "Eskaeraren formatua okerra da."], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            break;
        }

        $ezabatuak = [];
        $ezDaudenak = [];

        foreach ($gorputza['ezabatu'] as $elementua) {
            if (!is_array($elementua) || !isset($elementua['id']) || !is_numeric($elementua['id'])) {
                continue;
            }

            $id = (int) $elementua['id'];
            if ($db->selectById($id) !== false) {
                $db->delete($id);
                $ezabatuak[] = $id;
            } else {
                $ezDaudenak[] = $id;
            }
        }

        http_response_code(200);
        echo json_encode([
            "ezabatuak" => $ezabatuak,
            "ez_daudenak" => $ezDaudenak
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        break;

    default:
        http_response_code(405);
        echo json_encode(["errorea" => "Metodoa ez da onartzen."], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        break;
}
