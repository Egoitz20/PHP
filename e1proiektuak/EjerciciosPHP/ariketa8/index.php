  <!DOCTYPE html>
  <html lang="es">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Ariketak 8</title>
  </head>

  <body>

      <header>
          <h1>Ariketak 8</h1>
      </header>

      <main>
          <div>
              <h2>Ariketa 8.1</h2>
              <!-- -->
              <?php

                include("8.1/Ikasle.php");
                $objektu1 = new Ikasle("Egoitz", [10, 9, 10, 7, 6]);
                $objektu1->erakutsiNotak();
                $objektu1->batazBestekoa();
                ?>
          </div>

          <div>
              <h2>Ariketa 8.2</h2>
              <!-- -->
              <?php
                include("8.2/Produktu.php");
                $objektu2 = new Produktu("Sagarra", 10);
                $objektu2->aukeratu(5);
                ?>
          </div>

          <div>
              <h2>Ariketa 8.3</h2>
              <!-- -->
              <?php
                include("8.3/Liburua.php");
                include("8.3/LiburuKatalogo.php");
                $liburu1 = new Liburua("Star Wars", "Elpepi Nazo");
                $liburu2 = new Liburua("Harry Potter", "J.K. Rowling");
                $liburu3 = new Liburua("Fabrica de coca", "Alejandro Porros");

                $liburuKatalogo = new LiburuKatalogo();

                $liburuKatalogo->gehituLiburua($liburu1);
                $liburuKatalogo->gehituLiburua($liburu2);
                $liburuKatalogo->gehituLiburua($liburu3);

                $liburuKatalogo->katalogoaBistaratu();

                ?>
          </div>

          <div>
              <h2>Ariketa 8.4</h2>
              <!-- -->
              <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                  <label>Izena:</label>
                  <input type="text" name="izena" placeholder="izena">
                  <br>
                  <label>Abizenak:</label>
                  <input type="text" name="abizenak" placeholder="abizenak">
                  <br>
                  <label>Zeregina:</label>
                  <select name="zeregina">
                      <option value="ikaslea">Ikaslea</option>
                      <option value="irakaslea">Irakaslea</option>
                  </select>
                  <br>
                  <button name="bidali" type="submit">Bidali</button>

              </form>

              <?php
                if (isset($_POST['bidali'])) {
                    $izena = $_POST['izena'];
                    $abizenak = $_POST['abizenak'];
                    $zeregina = $_POST['zeregina'];

                    if ($zeregina == "ikaslea") {
                        include("8.4/Ikaslea.php");
                        $ikaslea = new Ikaslea($izena, $abizenak);
                        $ikaslea->aurkeztu();
                    } else {
                        include("8.4/Irakaslea.php");
                        $irakaslea = new Irakaslea($izena, $abizenak);
                        $irakaslea->aurkeztu();
                    }
                }
                ?>
          </div>

          <div>
              <h2>Ariketa 8.5</h2>
              <!-- -->
              <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                  <label>Animalia aukeratu:</label>
                  <select name="animalia">
                      <option value="txakurra">Txakurra</option>
                      <option value="katua">Katua</option>
                  </select>
                  <button name="soinua" type="submit">Soinua</button>

              </form>

              <?php

                include("8.5/ZarataEgin.php");

                if (isset($_POST['soinua'])) {
                    $animalia = $_POST['animalia'];

                    if ($animalia == "txakurra") {
                        include("8.5/Txakurra.php");
                        $objektua = new Txakurra();
                        $objektua->esan();
                    } else {
                        include("8.5/Katua.php");
                        $objektua = new Katua();
                        $objektua->esan();
                    }
                }

                ?>
          </div>
      </main>

  </body>

  </html>