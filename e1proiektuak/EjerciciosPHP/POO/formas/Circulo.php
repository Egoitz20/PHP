<?php

class Circulo extends Forma
{
    private $radio;

    public function __construct($color, $radio)
    {
        parent::__construct($color);
        $this->radio = $radio;
    }

    public function calcularArea()
    {
        // area = pi * radio^2
        $area = pi() * ($this->radio * $this->radio);
        return $area;
    }
}
