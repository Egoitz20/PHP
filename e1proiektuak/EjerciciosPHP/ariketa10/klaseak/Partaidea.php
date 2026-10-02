<?php

class Partaidea
{

    public ?int $id = null;
    public String $izena = "";
    public String $herrialdea = "";
    public ?int $taldea_id = null;


    public function __construct($izena = "", $herrialdea = "", $taldea_id = null)
    {
        $this->izena = $izena;
        $this->herrialdea = $herrialdea;
        $this->taldea_id = $taldea_id;
    }
}
