<?php

class Grupo
{

    public ?int $id = null;
    public String $nombre = "";
    public ?int $puntos = null;

    public function __construct($id = null, $nombre = "", $puntos = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->puntos = $puntos;
    }
}
