<?php
abstract class Forma
{
    protected $color;

    public function __construct($color = null)
    {
        $this->color = $color;
    }

    abstract public function calcularArea();
}
