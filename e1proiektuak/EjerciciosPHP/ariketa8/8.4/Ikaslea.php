<?php

include_once("Pertsona.php");

class Ikaslea extends Pertsona
{
    public function aurkeztu()
    {
        echo "Kaixo, ni " . $this->izena . " " . $this->abizenak . " naiz eta ikaslea naiz";
    }
}
