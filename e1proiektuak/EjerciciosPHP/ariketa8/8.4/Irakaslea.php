<?php

include_once("Pertsona.php");

class Irakaslea extends Pertsona
{
    public function aurkeztu()
    {
        echo "Kaixo, ni " . $this->izena . " " . $this->abizenak . " naiz eta irakaslea naiz";
    }
}
