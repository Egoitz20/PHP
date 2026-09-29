<?php

class Coche extends Vehiculo
{

    private $numPuertas;

    public function __construct($marca = null, $modelo = null, $precio = null, $numPuertas = null)
    {
        parent::__construct($marca, $modelo, $precio);
        $this->numPuertas = $numPuertas;
    }

    public function mostrarInfo()
    {
        return "Marca: " . $this->marca . "<br>Modelo: " . $this->modelo . "<br>Precio: " . $this->precio . "<br>Numero de puertas: " . $this->numPuertas;
    }
}
