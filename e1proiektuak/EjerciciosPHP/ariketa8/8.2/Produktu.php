<?php

class Produktu
{
    private $izenburua;
    private $prezioa;

    public function __construct($izenburua, $prezioa)
    {
        $this->izenburua = $izenburua;
        $this->prezioa = $prezioa;
    }


    public function aukeratu($kopurua)
    {
        $prezioTotala = $this->prezioa * $kopurua;
        $this->pantailaratu($kopurua, $prezioTotala);
    }

    private function pantailaratu($kopurua, $prezioTotala)
    {
        echo "Produktua: " . $this->izenburua . "<br>";
        echo "Prezio unitate: " . $this->prezioa . "<br>";
        echo "Kopurua: " . $kopurua . "<br>";
        echo "Totala: " . $prezioTotala . "<br>";
    }
}
