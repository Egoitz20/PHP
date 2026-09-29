<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ariketak3</title>
</head>

<body>
    <header>
        <h1>Ariketak3</h1>
    </header>

    <main>
        <div>
            <h2>Ariketa 3.1</h2>
            <!-- Egin 10 ausazko zenbakien (1tetik 10era) batura while erabiliz (rand funtzioa erabili). -->

            <?php

            $numeros = 1;
            $suma = 0;

            while ($numeros <= 10) {

                $suma += rand(1,10);
                $numeros++;

            }

            echo "Números generados: <br>";
            print_r($numeros);

            echo "<br><br>Suma total: " . $suma;

            ?>

        </div>

        <div>
            <h2>Ariketa 3.2</h2>
            <!-- 5eko Biderketa (for erabiliz): bide rkatu 5 zenbakiak osatzen dituen zenbaki guztiak (1,2,3,4 eta 5). -->

            <?php

            $zenbaki = 5;

            for ($i = 1; $i <= 5; ++$i) {
                $emaitza = $zenbaki * $i;
                echo "$zenbaki x $i = $emaitza <br>";
            }

            ?>
        </div>

        <div>
            <h2>Ariketa 3.3</h2>
            <!-- 3ko gehiketak (do..while erabiliz): erakutsi 3tik 30era dauden zenbakiak baina hirunaka gehituz. -->


            <?php

            $zenbakiak = 3;

            do {
                echo $zenbakiak . "<br>";
                $zenbakiak += 3;
            } while ($zenbakiak <= 30);

            ?>

        </div>

        <div>
            <h2>Ariketa 3.4</h2>
            <!--  Array Elementuak Bistaratu (foreach erabiliz): 
                array sinple bat honela definitzen da: $herrialdeak = array("EH", "Frantzia", "Alemania", "Italia"); -->
            <?php
            $herrialdeak = array("EH", "Frantzia", "Alemania", "Italia");

            foreach ($herrialdeak as $herrialdea) {
                echo $herrialdea . "<br>";
            }
            ?>



        </div>

        <div>
            <h2>Ariketa 3.5</h2>
            <!--1 eta 100 artean dauden zenbaki lehenak (primoak) erakutsi eta zenbatu (for eta if erabiliz). 
            Zenbaki lehena den jakiteko: 1 edo bera ez den beste edozein zenbakirekin zatitzen baduzu, zero ez den beste hondar bat lortzen da. -->
            <?php
            $primotik = 0;

            for ($i = 1; $i <= 100; $i++) {
                if ($i % 2 != 0) {
                    $primotik++;
                    echo $i . "<br>";
                }
            }

            ?>
        </div>
    </main>

</body>

</html>