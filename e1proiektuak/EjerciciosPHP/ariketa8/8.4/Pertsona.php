<?php

abstract class Pertsona
{
    protected $izena;
    protected $abizenak;

    public function __construct($izena, $abizenak)
    {
        $this->izena = $izena;
        $this->abizenak = $abizenak;
    }

    abstract public function aurkeztu();
}
