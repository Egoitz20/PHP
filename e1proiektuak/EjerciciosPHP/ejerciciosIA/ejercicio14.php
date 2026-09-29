<?php 
/* 
14. Función para calcular el área de un círculo
Crear:
calcularArea($radio)
Fórmula:
π × radio²
Objetivo: retorno de valores.

*/ 


function calcularArea($radio) {

$resultado = M_PI * pow($radio,2);

return $resultado;

}

echo calcularArea(5);

?>