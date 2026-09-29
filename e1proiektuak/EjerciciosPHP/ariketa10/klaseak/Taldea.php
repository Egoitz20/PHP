<?php

class Taldea
{
    public ?int $id = null;
    public String $izena = "";
    public ?int $puntuak = null;

    public function __construct($i = "", $p = null)
    {
        print_r($i);
        print_r($p);
        
        $this->izena = $i;
        $this->puntuak = $p;
    }
}
