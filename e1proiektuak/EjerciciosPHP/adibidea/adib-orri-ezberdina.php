<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario adibidea</title>
</head>

<body>
    <h1>Formulario adibidea</h1>
    <form method="post" action="adib-orri-ezberdina-process.php">
        <label for="izena">Izena:</label>
        <input type="text" id="izena" name="izena">
        <?php if (isset($_GET['izenaErr'])) { ?>
            <span style="color: red;"><?php echo $_GET['izenaErr']; ?></span><br><br>
        <?php } ?>
        <br><br>
        <label for="data">Data:</label>
        <input type="date" id="data" name="data">
        <?php if (isset($_GET['dataErr'])) { ?>
            <span style="color: red;"><?php echo $_GET['dataErr']; ?></span><br><br>
        <?php } ?>
        <br><br>
        <input type="submit" value="Bidali">
    </form>
</body>

</html>