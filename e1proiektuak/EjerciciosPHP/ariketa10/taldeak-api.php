<?php
require_once "./konexioa/Db.php";
require_once "./konexioa/Kontsultak.php";
require_once "./konexioa/Txertakeak.php";
require_once "./konexioa/Eguneraketak.php";
require_once "./konexioa/Ezabakaetak.php";
require_once "./klaseak/Taldea.php";
require_once "./klaseak/PartaideTaldeak.php";


// Erantzuna JSON formatuan izango dela
header("Content-Type: application/json; charset=UTF-8");

$db = new DB;
$db->konektatu();

$taldeak = new Kontsultak($db);
$taldeInserts = new Txertaketak($db);
$taldeEguneraketa = new Eguneraketak($db);
$taldeEzabaketa = new Ezabaketak($db);

// Eskaeran erabili den HTTP metodoa gordetzen da
$metodoa = $_SERVER['REQUEST_METHOD'];

// URL-tik "id" parametroa heltzen bada, "int" bihurtuta gordetzen dugu, bestela "null"
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

switch ($metodoa) {
    // ------- GET --------
    case 'GET':
        // "id"rik ez bada heldu, talde GUZTIAK bueltatuko ditugu partaiderik gabe
        if ($id === null) {
            // Datuak hartzean array batean gorde
            $taldeaBistaratu = [];

            foreach ($taldeak->sailkapenaBistaratu() as $talde) {
                $taldeaBistaratu[] = [
                    "id" => $talde['id'] ?? null,
                    "izena" => $talde['izena'] ?? null,
                    "puntuak" => $talde['puntuak'] ?? null
                ];
            }

            // Itzuli datuak JSON-ean
            http_response_code(200); // 200: OK, eskaera ondo egin da
            // Array-a JSON bihurtu eta inprimatu; UNESCAPED_UNICODE-k letra bereziak ondo erakusten ditu
            echo json_encode($taldeaBistaratu, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } else {
            // "id" bat heldu bada, talde hori bakarrik bueltatuko dugu, bere partaideekin batera

            $taldea = null; // taldearen datuak gordetzeko aldagaia
            $partaideak = []; // partaideen zerrenda  gordetzeko aldagaia array batekin

            foreach ($taldeak->taldeakPartaideakBistaratu($id) as $t) {
                // Taldearen datuak behin bakarrik gordetzen ditugu (lehen errenkadan)
                if ($taldea === null) {
                    $taldea = [
                        "id"      => $t['TALDE_ID']      ?? $id,     // Ez badago IDrik, URL-koa erabili
                        "izena"   => $t['TALDE_IZENA']   ?? null,
                        "puntuak" => $t['TALDE_PUNTUAK'] ?? null
                    ];
                }
                // Partaide bakoitza zerrendara gehitzen dugu
                $partaideak[] = [
                    "izena"      => $t['PARTAIDE_IZENA']      ?? null,
                    "herrialdea" => $t['PARTAIDE_HERRIALDEA'] ?? null
                ];
            }

            // Taldea aurkitu ez bada, 404 bueltatu 
            if ($taldea === null) {
                http_response_code(404); // 404 Not Found
                echo json_encode(["error" => "Taldea ez da aurkitu"]);
                exit; // Garrantzitsua: exekuzioa hemen gelditu
            }

            // Partaideen zerrenda taldearen barruan txertatzen dugu
            $taldea["partaideak"] = $partaideak;
            http_response_code(200);
            echo json_encode($taldea, JSON_UNESCAPED_UNICODE);
        }
        break; // switch-etik atera

    // ------- POST --------
    case 'POST':
        // Eskaeraren gorputza (body) irakurri eta JSON-a array bihurtu
        // php://input erabiltzen da JSON-arekin $_POST ez delako funtzionatzen
        $body = json_decode(file_get_contents("php://input"), true);

        // Beharrezko eremuak falta badira, 400 errorea bueltatu
        if (!isset($body['izena'], $body['puntuak'])) {
            http_response_code(400);
            echo json_encode(["error" => "izena eta puntuak beharrezkoak dira"]);
            exit;
        }

        // talde berria datu-basean sortzen da
        $taldeInserts->txertatuTaldea($body['izena'], (int) $body['puntuak']);

        http_response_code(201); // 201 Created: Baliabide berria sortu da
        echo json_encode(["mezua" => "Taldea sortu da"]);
        break;

    // ------- PUT --------
    case 'PUT':
        // PUT egiteko "id" derrigorrezkoa da URL-an
        if ($id === null) {
            http_response_code(400);
            echo json_encode(["error" => "id beharrezkoa da"]);
            exit;
        }

        // Eskaeraren gorputza irakurri
        $body = json_decode(file_get_contents("php://input"), true);

        // "puntuak" eremua falta bada, 400 errorea
        if (!isset($body['puntuak'])) {
            http_response_code(400);
            echo json_encode(["error" => "puntuak beharrezkoa da"]);
            exit;
        }

        // taldearen puntuak datu-basean eguneratzen da
        $taldeEguneraketa->puntuazioaAldatu($id, (int) $body['puntuak']);

        http_response_code(200); // 200 OK
        echo json_encode(["mezua" => "Puntuak eguneratu dira"]);
        break;

    // ------- DELETE --------
    case 'DELETE':
        // DELETE egiteko "id" derrigorrezkoa da
        if ($id === null) {
            http_response_code(400);
            echo json_encode(["error" => "id beharrezkoa da"]);
            exit;
        }

        // Taldea datu-basetik ezabatu
        $taldeEzabaketa->ezabatuTaldea($id);

        http_response_code(200); // 200 OK 
        echo json_encode(["mezua" => "Taldea ezabatu da"]);
        break;

    // ---------------- Beste metodoak ----------------
    default:
        // GET, POST, PUT edo DELETE ez den metodoa heltzen bada, 405 bueltatu
        http_response_code(405); // 405 Method Not Allowed
        echo json_encode(["error" => "Metodo hau ez da onartzen"]);
        break;
}
