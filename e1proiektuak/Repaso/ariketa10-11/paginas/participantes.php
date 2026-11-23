<?php
require_once "../conexion/db.php";
require_once "../conexion/Consultas.php";
require_once "../clases/Participante.php";

$db = new db;
$db->konektatu();

$participantes = new Consultas($db);

$nombreGrupo = $_GET['nombreGrupo'];
$idGrupo = $_GET['idGrupo'];

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participantes</title>
</head>

<body>
    <main>
        <h1>
            Participantes de - <?php echo $nombreGrupo; ?>
        </h1>

        <?php 
        if (!empty($_GET['error'])) {
            echo $_GET['error'];
        }
        ?>

        <table border="1px">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Ciudad</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($participantes->mostrarParticipantes($nombreGrupo) as $personas) {
                    echo "<tr>";
                    echo "<td>" . $personas->id . "</td>";
                    echo "<td>" . $personas->izena . "</td>";
                    echo "<td>" . $personas->herrialdea . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <h2>Añadir participante</h2>

        <form action="../proceso/procesoParticipantes.php" method="post">
            <label>Nombre: </label>
            <input type="text" name="nombre">
            <br>
            <label>Ciudad: </label>
            <input type="text" name="ciudad">
            <br>
            <input type="submit" value="Crear">

            <input type="hidden" name="taldeaId" value="<?php echo $idGrupo; ?>">
            <input type="hidden" name="taldeaIzena" value="<?php echo $nombreGrupo; ?>">
        </form>

        <a href="../index.php">Volver</a>
    </main>
</body>

</html>