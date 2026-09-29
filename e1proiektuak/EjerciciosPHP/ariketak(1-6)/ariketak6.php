<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ariketak 6</title>
</head>

<body>
    <header>
        <h1>Ariketak 6</h1>
    </header>

    <main>
        <div>
            <h2>Ariketa 6.1</h2>
            <!-- Array Batura Funtzioarekin: egin ondorengo zenbakien batuketa funtzio batean: 
             4, 8, 15, 16, 23, 42. 
             Funtzioak array bat jasoko du parametrotan eta honen batuketa bueltatuko du-->

            <?php
            function arrayBatura($ray)
            {
                $batuketa = 0;
                for ($i = 0; $i < count($ray); $i++) {
                    $batuketa = $batuketa + $ray[$i];
                }
                return $batuketa;
            }

            $zbk = array(4, 8, 15, 16, 23, 42);
            echo arrayBatura($zbk);

            ?>


        </div>

        <div>
            <h2>Ariketa 6.2</h2>
            <!-- Array Multzoak Konbinatu Funtzioarekin: Egin funtzio bat bi array jasotzen dituena eta konbinatu egiten duen. 
             Funtzioak ez du ezer bueltatuko, bertan bistaratuko du pantailatik HTML taula baten. Ondoren erabili zuen funtzioa nahi duzuen adibidearekin.
              Adi, array_merge funtzioa erabili dezakezue.-->

            <?php
            function arrayKonbinaketa($ray1, $ray2)
            {
                $kombi = array_merge($ray1, $ray2);
                foreach ($kombi as $elementuak) {
                    echo $elementuak . " ";
                }
            }

            $s1 = array(1, 3, 6, 9);
            $s2 = array(2, 4, 6, 8, 10);

            echo arrayKonbinaketa($s1, $s2);

            ?>
        </div>

        <div>
            <h2>Ariketa 6.3</h2>
            <!-- Array Multidimentsionalak Bistaratu Funtzioarekin:
              Sortu funtzio bat bistaratzeko taula baten ondorengo balioak duen array multidimentsionala:  
             array("ikaslea" => "Jon", "nota" => 8),     
             array("ikaslea" => "Ane", "nota" => 9),  
             array("ikaslea" => "Markel", "nota" => 7) -->

            <?php
            $ikasleak = array(
                array("ikaslea" => "Jon", "nota" => 8),
                array("ikaslea" => "Ane", "nota" => 9),
                array("ikaslea" => "Markel", "nota" => 7)
            );

            function arrayTaulaBistaratu($multi)
            {
                echo "<table border=1px>";
                echo "<tr>";
                echo "<th> Izena </th>";
                echo "<th> Nota </th>";
                echo "</tr>";


                foreach ($multi as $e) {
                    echo "<tr>";
                    echo "<td>" . $e["ikaslea"] . "</td>";
                    echo "<td>" . $e["nota"] . "</td>";
                    echo "/<tr>";
                }

                echo "</table>";
            }

            arrayTaulaBistaratu($ikasleak);
            ?>

        </div>

        <div>
            <h2>Ariketa 6.4</h2>
            <!-- Faktoriala Kalkulatu Funtzioarekin: 
             sortu funtzio bat 1 eta 10 arteko ausazko zenbaki bat jasotzen duena, 
             bere faktoriala kalkulatzen duena eta egindako biderketa bakoitza array batean gordetzen duena. 
             (Faktoriala da zenbaki bat baino txikiagoa edo berdina diren zenbakien biderketa, 0 kenduta). 
             Ondoren, erakutsi emaitza eta egindako biderketa danak zerrenda baten (ul eta li etiketak erabiliz).-->

            <?php
            $zenbakiAleatorioa = rand(1, 10);
            faktoriala($zenbakiAleatorioa);


            function faktoriala($zbk)
            {

                $emaitzaArray = array();
                $emaitza = 0;

                for ($i = $zbk; $i >= 0; $i--) {
                    echo $i;
                    echo " * ";
                    $emaitza = $i * ($i - 1);
                    $emaitzaArray[$i] = $emaitza;
                }
                echo "<br>";

                echo "<ul>";
                for ($i = 1; $i <= $zbk; $i++) {
                    echo "<li>" . $emaitzaArray[$i] . "</li>";
                }
                echo "</ul>";
            }

            ?>
        </div>
    </main>


</body>

</html>