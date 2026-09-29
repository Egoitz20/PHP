<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ariketak 4</title>
</head>

<body>
    <main>
        <div>
            <h2>Ariketa 4.1</h2>
            <!-- Zenbakien Batura (array erabiliz): ausazko 5 zenbakien batura egin (1tik 100erako balioak izango dute). 
             Taula batean erakutsiko dituzue balioak eta azkenengo lerroan batuketaren emaitza agertuko da. -->

            <table border="1px">
                <tr>
                    <th>1. Zenbakia</th>
                    <th>2. Zenbakia</th>
                    <th>3. Zenbakia</th>
                    <th>4. Zenbakia</th>
                    <th>5. Zenbakia</th>
                </tr>

                <tr>
                    <?php
                    $zenbakiak = array();

                    for ($i = 0; $i <= 4; $i++) {
                        $zenbakiRandom = rand(1, 100);
                        echo "<td>" . $zenbakiRandom . "</td>";
                        $zenbakiak[$i] = $zenbakiRandom;
                    }

                    // Beste modu batera
                    //$zenbakiak = [];
                    //for ($i = 0; $i < 5; $i++){
                    //    zenbakiak[] = rand(1,100);
                    //}
                    // batura = array_sum($zenbakiak);

                    ?>
                </tr>
                <tr>
                    <td colspan="5">BATURA:
                        <?php
                        $batura = 0;
                        for ($i = 0; $i < count($zenbakiak); $i++) {
                            $batura += $zenbakiak[$i];
                        }

                        echo $batura;
                        ?>
                    </td>
                </tr>
            </table>
        </div>
        <div>
            <h2>Ariketa 4.2</h2>
            <!-- Arrayaren Elementuak Ordenatzea (sort funtzioa erabiliz): 
             ondorengo balioak ordenatu eta bistaratu - "EH", "Frantzia", "Alemania", "Italia".-->

            <table border="1px">
                <tr>
                    <th>1. Herrialdea</th>
                    <th>2. Herrialdea</th>
                    <th>3. Herrialdea</th>
                    <th>4. Herrialdea</th>
                </tr>
                <tr>
                    <?php
                    $herrialdeak = array("EH", "Frantzia", "Alemania", "Italia");
                    sort($herrialdeak);

                    foreach ($herrialdeak as $herrialde) {
                        echo "<td>" . $herrialde . "</td>";
                    }

                    ?>
                </tr>
            </table>
        </div>

        <div>
            <h2>Ariketa 4.3</h2>

            <!-- Arrayaren Elementuak Bikoitia edo Ez Bakoitia (foreach eta if erabiliz): 
            kargatu 6 ausazko zenbaki oso (1etik 100era) zerrenda batean eta bakoitzeko esan bikoitia den ala ez.-->

            <table border=1px>
                <tr>
                    <th>Zenbakia</th>
                    <th>Bikoitia</th>
                </tr>

                <?php

                $zbk = array();
                for ($i = 0; $i < 6; $i++) {
                    $zbk[$i] = rand(1, 100);
                }
                foreach ($zbk as $zenbaki) {
                    echo "<tr>";
                    echo "<td>" . $zenbaki . "</td>";

                    if ($zenbaki % 2 == 0) {
                        echo "<td>BAI</td>";
                    } else {
                        echo "<td>EZ</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </main>
</body>

</html>