<?php

class Ikasle
{
    private $izena;
    private $notak;

    public function __construct($izena, $notak)
    {
        $this->izena = $izena;
        $this->notak = $notak;
    }

    public function batazBestekoa()
    {

        $notak = $this->notak;

        $batuketa = 0;

        foreach ($notak as $n) {
            $batuketa = $batuketa + $n;
        }

        $media = $batuketa / count($this->notak);

        echo "Batazbestekoa: " . $media;
    }

    public function erakutsiNotak()
    {
        $ikasle = $this->izena;
        $notak = $this->notak;
        $moduluak = array("WES", "DIW", "DAW", "WEC", "EIE");

        echo $ikasle . ": <br>";
        echo "<ul>";
        for ($i = 0; $i < count($moduluak); $i++) {
            echo "<li>" . $moduluak[$i] . ": " . $notak[$i] . "</li>";
        }
        echo "</ul>";
    }
}
