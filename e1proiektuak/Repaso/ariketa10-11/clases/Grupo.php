<?php

class Grupo
{

    public ?int $id = null;
    public String $izena = "";
    public ?int $puntuak = null;

    public function __construct($id = null, $nombre = "", $puntos = null)
    {
        $this->id = $id;
        $this->izena = $nombre;
        $this->puntuak = $puntos;
    }
}
