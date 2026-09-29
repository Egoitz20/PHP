<?php

function mayorEdad($edad)
{
    if ($edad >= 18) {
        echo "Es mayor de edad <br>";
    } else {
        echo "Es menor de edad <br>";
    }
}

function nombreCompleto($nombre, $apellidos)
{
    $nombreCompleto = $nombre . " " . $apellidos;
    return $nombreCompleto;
}

$nombre = "Egoitz";
$apellido = "Garaikoetxea";
$edad = 25;

include("Persona.php");

$persona = new Persona();
$persona2 = new Persona("Leo", "Melones", 15);

$persona->setNombre($nombre);
$persona->setApellidos($apellido);
$persona->setEdad($edad);

mayorEdad($persona->getEdad());
echo "Nombre completo: " . nombreCompleto($persona->getNombre(), $persona->getApellidos()) . "<br>";

mayorEdad($persona2->getEdad());
echo "Nombre completo: " . nombreCompleto($persona2->getNombre(), $persona2->getApellidos()) . "<br>";
