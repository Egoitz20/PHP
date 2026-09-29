<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario adibidea</title>
</head>

<body>
    <h1>Formulario adibidea</h1>
    <?php
    $izenaErr = $dataErr = "";
    $izena = $data = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["izena"])) {
            $izenaErr = "Izena derrigorrezkoa da.";
        } else {
            $izena = htmlspecialchars($_POST["izena"]);
        }

        if (empty($_POST["data"])) {
            $dataErr = "Data derrigorrezkoa da.";
        } else {
            $data = htmlspecialchars($_POST["data"]);
        }

        if (empty($izenaErr) && empty($dataErr)) {
            echo "<p style='color: green;'>Dana ondo! Izena: $izena, data: $data</p>";
        }
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="izena">Izena:</label>
        <input type="text" id="izena" name="izena" value="<?php echo $izena; ?>">
        <span style="color: red;"><?php echo $izenaErr; ?></span><br><br>

        <label for="data">Data:</label>
        <input type="date" id="data" name="data" value="<?php echo $data; ?>">
        <span style="color: red;"><?php echo $dataErr; ?></span><br><br>

        <input type="submit" value="Bidali">
    </form>
</body>

</html>