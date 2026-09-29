<?php
include "Forma.php";
include "Circulo.php";
include "Rectangulo.php";

$circulo = new Circulo("Rojo", 5);

echo "Area del circulo: " . $circulo->calcularArea() . "<br>";

$rectangulo = new Rectangulo("Verde", 10, 5);

echo "Area del rectangulo: " . $rectangulo->calcularArea() . "<br>";
