<?php

class Taldea
{
    public ?int $id = null;
    public String $izena = "";
    public ?int $puntuak = null;

    public function __construct($izena = "", $puntuak = null)
    {
        $this->izena = $izena;
        $this->puntuak = $puntuak;
    }
}
