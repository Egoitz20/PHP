<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ariketak1</title>
</head>

<body>
    <header>
        <h1>Ariketak2</h1>
    </header>

    <main>
        <div>
            <h2>Ariketa 2.1</h2>
            <!-- date funtzioa erabiliz lortu asteko egun zenbakia eta ondoren idatzi zein egunari dagokion (Adibidez 1 → astelehena, etab). if eta elseif erabiliz:-->
            <?php
            
            $egunZenbakia = date("N");

            if ($egunZenbakia == 1) {
                echo "Astelehena";
            } elseif ($egunZenbakia == 2) {
                echo "Asteartea";
            } elseif ($egunZenbakia == 3) {
                echo "Asteazkena";
            } elseif ($egunZenbakia == 4) {
                echo "Osteguna";
            } elseif ($egunZenbakia == 5) {
                echo "Ostirala";
            } elseif ($egunZenbakia == 6) {
                echo "Larunbata";
            } elseif ($egunZenbakia == 7) {
                echo "Igandea";
            }
            ?>

        </div>

        <div>
            <h2>Ariketa 2.2</h2>
            <!-- Ingeles klaseko notak bistaratu (switch eta case erabiliz): 
                nota F bada “oso gutxi”, D “gutxi”, C “nahiko”, B “ondo”, A “oso ondo” (nota aldagai batean gorde). -->


                <h3>switch</h3>
            <?php

            $nota = "F";

            echo "Zure nota: " . $nota . " da." ;

            echo "<br>";

            switch ($nota) {
                case "F":
                    echo "oso gutxi";
                    break;
                case "D":
                    echo "gutxi";
                    break;
                case "C":
                    echo "nahiko";
                    break;
                case "B":
                    echo "ondo";
                    break;
                case "A":
                    echo "oso ondo";
                    break;
            }

            ?>

            <br>

            <h3>match (PHP 8+ -- alternativa a switch)</h3>

            <?php
                $nota2 = "A";
                echo "Zure nota: " . $nota2 . " da." ;

                echo "<br>";

                $emaitza = match($nota2) {
                    "F" => "Oso gutxi",
                    "D" => "Gutxi",
                    "C" => "Nahiko",
                    "B" => "Ondo",
                    "A" => "Oso ondo",
                    default => "Ez da existitzen karaktere hori"
                };

                echo $emaitza;

            ?>


        </div>

        <div>
            <h2>Ariketa 2.3</h2>
            <!-- Gutxieneko eta Gehienezko Kopurua Bistaratu (if erabiliz): 
                rand funtzioa erabiliz lortu 0 eta 30 bitarteko zenbakia eta esan zenbakia 0-10 artean dagoen 10 eta 20 artean edo 20 eta 30 artean dagoen.-->
            <?php

            $zenbakia = rand(0, 30);
            if ($zenbakia >= 0 && $zenbakia <= 10) {
                echo "0-10 artean";
            } elseif ($zenbakia >= 10 && $zenbakia <= 20) {
                echo "10-20 artean";
            } elseif ($zenbakia >= 20 && $zenbakia <= 30) {
                echo "20-30 artean";
            }

            ?>

        </div>
    </main>

</body>

</html>