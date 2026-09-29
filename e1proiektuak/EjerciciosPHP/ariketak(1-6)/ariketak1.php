<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ariketak1</title>
</head>

<body>
    <header>
        <h1>Ariketak1</h1>
    </header>

    <main>
        <div>
            <h2>Ariketa 1.1</h2>
            <!-- Aldagaia eta Iruzkina: Sortu aldagai bat ($zenbaki) eta iruzkin batekin (// Iruzkina) azaldu kodea. 
 Kodeak zenbaki bat pantailaratu behar du, eta iruzkinaren bidez adierazi behar da zein da aldagaiaren helburua.-->

            <?php
            $zenbaki = 10;
            echo $zenbaki;
            ?>

        </div>

        <div>
            <h2>Ariketa 1.2</h2>
            <!-- Baldintzak: Azaldu PHP-n baldintza sententzia bat (if eta else) erabiliz. 
              Adibidez, aldagai bat ($balioa) sortu eta kasu bakoitzean pantailaratu “Balioa handia da” edo 
“Balioa txikia da” baldintzaren arabera (Adibidez 10 baino txikiago izatea). -->
            <?php
            $balioa = 10;
            if ($balioa < 10) {
                echo "Balioa txikia da";
            } else {
                echo "Balioa handia da";
            }

            echo "<br>";

            echo $balioa < 10 ? "Balioa txikia da" : "Balioa handia da";

            ?>


        </div>

        <div>
            <h2>Ariketa 1.3</h2>
            <!-- Erosketa Kopurua Handiagoa bada Mezua Erakutsi: PHP erabiliz, 
             erabilzaileak 10 baino gehiagoko erosketa egiten badu, mezu bat erakutsi (sortu $erosketa aldagai bat balioa gordetzeko).-->
            <?php
            $erosketa = 11;
            if ($erosketa > 10) {
                echo "Erosketa handia da";
            }
            ?>

        </div>

        <div>
            <h2>Ariketa 1.4</h2>
            <!-- Kontua Blokeatu Balio Batetik: PHP erabiliz, erabiltzaile batek sartutako PIN zenbakia zuzena edo okerra den adierazi 
             (sartutako PINa aldagai baten gordeko da eta benetakoa beste baten). -->
            <?php
            $pinZuzena = 1234;
            $pinErabiltzaileak = 1234;
            if ($pinErabiltzaileak === $pinZuzena) {
                echo "Kontua desblokeatuta";
            } else {
                echo "Kontua blokeatuta";
            }
            ?>



        </div>

        <div>
            <h2>Ariketa 1.5</h2>
            <!-- Baimendutako Irteera Balioa Sortu: PHP erabiliz, sortu baimendutako_mezua izena duen aldagaia balio huts batekin. 
             Ondoren, erabiltzailearen adina 18 urte edo gehiagokoa bada gorde aldagai horretan “Gure lokalera sartu zaitezke” mezua, bestela gorde “Ezin zara sartu” mezua. 
             zkenik, erakutsi aldagaiaren balioa pantailatik. -->
            <?php
            $baimendutako_mezua = "";
            $adina = 18;
            if ($adina >= 18) {
                $baimendutako_mezua = "Gure lokalera sartu zaitezke";
            } else {
                $baimendutako_mezua = "Ezin zara sartu";
            }
            echo $baimendutako_mezua;
            ?>
        </div>
    </main>

</body>

</html>