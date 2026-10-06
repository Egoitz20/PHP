<?php

class PartaideTaldeak
{

    // TALDE atributuak
    public ?int $idTaldea = null;
    public String $izenaTaldea = "";
    public ?int $puntuak = null;

    // PARTAIDE atributuak
    public ?int $idPartaidea = null;
    public String $izenaPartaidea = "";
    public String $herrialdea = "";
    public ?int $taldea_id = null;

    public function __construct($izenaTaldea = "", $puntuak = null, $izenaPartaidea = "", $herrialdea = "")
    {
        $this->izenaTaldea = $izenaTaldea;
        $this->puntuak = $puntuak;
        $this->izenaPartaidea = $izenaPartaidea;
        $this->herrialdea = $herrialdea;
    }
}
