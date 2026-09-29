<?php

class Rectangulo extends Forma
{
    private $ancho;
    private $alto;

    public function __construct($color, $ancho, $alto)
    {
        parent::__construct($color);
        $this->ancho = $ancho;
        $this->alto = $alto;
    }

    public function calcularArea()
    {
        // area = base * altura
        $area = $this->ancho * $this->alto;
        return $area;
    }
}
