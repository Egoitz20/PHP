<?php

class Vehiculo
{
    protected $marca;
    protected $modelo;
    protected $precio;

    public function __construct($marca = null, $modelo = null, $precio = null)
    {
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->precio = $precio;
    }
}
