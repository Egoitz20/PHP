<?php

// 1. Definición del Trait
trait Loggable
{
    // Los traits pueden tener métodos, atributos y usar niveles de acceso
    public function registrarLog(string $mensaje): void
    {
        $fecha = date('Y-m-d H:i:s');
        // Simulamos la escritura en un archivo de texto o consola
        echo "[LOG] [$fecha] -> $mensaje\n";
    }
}
