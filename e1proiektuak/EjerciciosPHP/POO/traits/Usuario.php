<?php

// 2. Clase Usuario (Usa el Trait)
class Usuario
{
    // Importamos el código del trait directamente
    use Loggable;

    public function __construct(private string $nombre) {}

    public function registrarAcceso(): void
    {
        // Ejecución de la lógica de negocio
        echo "👤 El usuario $this->nombre ha iniciado sesión.<br>";

        // Llamamos al método del Trait como si fuera de la propia clase
        $this->registrarLog("Acceso exitoso para el usuario: $this->nombre");
    }
}
