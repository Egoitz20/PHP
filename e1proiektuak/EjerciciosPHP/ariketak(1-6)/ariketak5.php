<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ariketak 5</title>
</head>

<body>

    <header>
        <h1>Ariketak 5</h1>
    </header>

    <main>
        <div>
            <h2>Ariketa 5.1</h2>
            <!-- Array Multidimentsionala Bistaratu (foreach erabiliz): 
                sortu array multidimentsional bat ondorengo idazleekin 
                "izena" => "Harry Potter", "autorea" => "J.K. Rowling", 
                "izena" => "Game of Thrones", "autorea" => "George R.R. Martin", 
                "izena" => "The Hobbit", "autorea" => "J.R.R. Tolkien"
                 eta bistaratu datuak. -->
            <?php
            $idazleak = array(
                array("izena" => "Harry Potter", "autorea" => "J.K Rowling"),
                array("izena" => "Game of Thrones", "autorea" => "George R.R. Martin"),
                array("izena" => "The Hobbit", "autorea" => "J.R.R. Tolkien")
            );
            ?>

            <table border=1px>
                <tr>
                    <th>Izena</th>
                    <th>Autorea</th>
                </tr>
                <?php
                foreach ($idazleak as $elementuak) {
                    echo "<tr>";
                    echo "<td>" . $elementuak["izena"] . "</td>";
                    echo "<td>" . $elementuak["autorea"] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>

        <div>
            <h2>Ariketa 5.2</h2>
            <!-- Array Multidimentsionalaren Elementua Bilketa (for erabiliz): 
                kalkulatu eta bistaratu ondorengo ikasleen batazbesteko nota; 
                "ikaslea" => "Jon", "nota" => 8, 
                "ikaslea" => "Ane", "nota" => 9, 
                "ikaslea" => "Markel", "nota" => 7. -->

            <?php
            $ikasleak = array(
                array("ikaslea" => "Jon", "nota" => 8),
                array("ikaslea" => "Ane", "nota" => 9),
                array("ikaslea" => "Markel", "nota" => 7)
            );

            ?>

            <table border=1px>
                <tr>
                    <th>Ikaslea</th>
                    <th>Nota</th>
                </tr>

                <?php
                $ikasleakLenght = count($ikasleak);

                for ($i = 0; $i < $ikasleakLenght; $i++) {
                    echo "<tr>";
                    echo "<td>" . $ikasleak[$i]["ikaslea"] . "</td>";
                    echo "<td>" . $ikasleak[$i]["nota"] . "</td>";
                    echo "</tr>";
                }

                $batazbestekoa = 0;
                $gehiketa = 0;

                for ($i = 0; $i < $ikasleakLenght; $i++) {
                    $gehiketa = $gehiketa + $ikasleak[$i]["nota"];
                }

                $batazbestekoa = $gehiketa / $ikasleakLenght;

                ?>

                <tr>
                    <td>
                        <?php echo "Batazbestekoa"; ?>
                    </td>
                    <td>
                        <?php echo $batazbestekoa; ?>
                    </td>
                </tr>

            </table>

        </div>

        <div>
            <h2>Ariketa 5.3</h2>
            <!--Array Multidimentsionala Baldintzak (foreach eta if erabiliz): 
                esan ondorengo ikasleek nota txarra, ona edo oso ona daukaten (<5 txarra, <7 ona, >7 oso ona). 
                    "ikaslea" => "Jon", "nota" => 8, 
                    "ikaslea" => "Ane", "nota" => 6, 
                    "ikaslea" => "Markel", "nota" => 3 -->


            <?php
            $ikasle = array(
                array("ikaslea" => "Jon", "nota" => 8),
                array("ikaslea" => "Ane", "nota" => 6),
                array("ikaslea" => "Markel", "nota" => 3)
            );
            ?>

            <table border=1px>
                <tr>
                    <th>Ikaslea</th>
                    <th>Nota</th>
                    <th>Egoera</th>
                </tr>

                <?php

                foreach ($ikasle as $e) {
                    echo "<tr>";
                    echo "<td>" . $e["ikaslea"] . "</td>";
                    echo "<td>" . $e["nota"] . "</td>";

                    if ($e["nota"] < 5) {
                        echo "<td> Txarra </td>";
                    } elseif ($e["nota"] < 7) {
                        echo "<td> Ona </td>";
                    } else {
                        echo "<td> Oso Ona </td>";
                    }
                    echo "</tr>";
                }

                ?>
            </table>
        </div>

        <div>
            <h2>Ariketa 5.4</h2>
            <!-- Array multidimentsionala (foreach erabiliz): 
                sortu array bat gordetzeko 3 ikasleen zerrenda bat. 
                Ikasle bakoitzeko bere izena, abizena, telefonoa eta adina gorde nahi da. 
                Ondoren, taula batean bistaratu. -->

            <?php
            $ikasleInfo = array(
                array("izena" => "Egoitz", "abizena" => "Guerras", "telefonoa" => 123456789, "adina" => 22),
                array("izena" => "Gorka", "abizena" => "Maroto", "telefonoa" => 987654321, "adina" => 23),
                array("izena" => "Ane", "abizena" => "Landa", "telefonoa" => 1133557799, "adina" => 19)
            );
            ?>

            <table border=1px>
                <tr>
                    <th>Izena</th>
                    <th>Abizena</th>
                    <th>Telefonoa</th>
                    <th>Adina</th>
                </tr>


                <?php
                foreach ($ikasleInfo as $e) {
                    echo "<tr>";
                    echo "<td>" . $e["izena"] . "</td>";
                    echo "<td>" . $e["abizena"] . "</td>";
                    echo "<td>" . $e["telefonoa"] . "</td>";
                    echo "<td>" . $e["adina"] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>

        <div>
            <h2>Ariketa 5.5</h2>
            <!-- Aurreko ariketa moldatu ondorengo datuak gordetzeko ere bai: 
             2 abizen, 2 telefono eta modulo bakoitzaren nota (3 gutxienez). -->
            <?php
            //Egoitz
            $ikasleInfo[0]["abizena2"] = "Rodriguez";
            $ikasleInfo[0]["telefonoa2"] = 111111111;
            $ikasleInfo[0]["nota1"] = 10;
            $ikasleInfo[0]["nota2"] = 10;
            $ikasleInfo[0]["nota3"] = 9;

            // Gorka
            $ikasleInfo[1]["abizena2"] = "Moto";
            $ikasleInfo[1]["telefonoa2"] = 222222222;
            $ikasleInfo[1]["nota1"] = 8;
            $ikasleInfo[1]["nota2"] = 5;
            $ikasleInfo[1]["nota3"] = 2;

            // Ane
            $ikasleInfo[2]["abizena2"] = "Manda";
            $ikasleInfo[2]["telefonoa2"] = 333333333;
            $ikasleInfo[2]["nota1"] = 5;
            $ikasleInfo[2]["nota2"] = 7;
            $ikasleInfo[2]["nota3"] = 4;
            ?>


            <table border=1px>
                <tr>
                    <th>Izena</th>
                    <th>Abizena</th>
                    <th>Abizena2</th>
                    <th>Telefonoa</th>
                    <th>Telefonoa2</th>
                    <th>Nota1</th>
                    <th>Nota2</th>
                    <th>Nota3</th>
                </tr>


                <?php
                foreach ($ikasleInfo as $e) {
                    echo "<tr>";
                    echo "<td>" . $e["izena"] . "</td>";
                    echo "<td>" . $e["abizena"] . "</td>";
                    echo "<td>" . $e["abizena2"] . "</td>";
                    echo "<td>" . $e["telefonoa"] . "</td>";
                    echo "<td>" . $e["telefonoa2"] . "</td>";
                    echo "<td>" . $e["nota1"] . "</td>";
                    echo "<td>" . $e["nota2"] . "</td>";
                    echo "<td>" . $e["nota3"] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </main>

</body>

</html>