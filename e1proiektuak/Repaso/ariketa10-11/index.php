<?php
require_once "./conexion/db.php";
require_once "./conexion/Consultas.php";
require_once "./clases/Grupo.php";

$db = new db;
$db->konektatu();

$grupos = new Consultas($db);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de grupos</title>
</head>

<body>
    <main>
        <h1>Puntuaciones</h1>

        <table border="1px" solid black>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>PUNTOS</th>
                    <th>ACTUALIZAR PUNTOS</th>
                    <th>BORRAR</th>
                    <th>FAVORITO</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($grupos->mostrarClasificacion() as $mc) {
                    echo "<tr>";
                    echo "<td>" . $mc->id . "</td>";
                    echo "<td><a href='./paginas/participantes.php?nombreGrupo=$mc->izena&idGrupo=$mc->id'>" . $mc->izena . "</td>";
                    echo "<td>" . $mc->puntuak . "</td>";
                ?>

                    <td>
                        <form action="./proceso/configuracionBotones.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $mc->id; ?>">
                            <input type="submit" name="accion" value="Cambiar">
                        </form>
                    </td>
                    <td>
                        <form action="./proceso/configuracionBotones.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $mc->id; ?>">
                            <input type="submit" name="accion" value="Borrar">
                        </form>
                    </td>
                    <td>
                        <form action="./proceso/configuracionBotones.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $mc->izena; ?>">
                            <input type="submit" name="accion" value="Favorito">
                        </form>
                    </td>
                <?php
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <h2>Añadir grupo</h2>
        <form action="./proceso/procesoGrupos.php">
            <label>Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Tu nombre...">
            <?php if (!empty($_GET['nombreError'])) {
                echo $_GET['nombreError'];
            } ?>
            <br>
            <label>Puntos:</label>
            <input type="number" name="puntos" id="puntos" placeholder="Puntos del grupo...">
            <?php if (!empty($_GET['errorPuntos'])) {
                echo $_GET['errorPuntos'];
            } ?>
            <br>
            <input type="button" value="Enviar">
        </form>
    </main>
</body>

</html>