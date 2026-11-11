<?php

class Usuario
{
    public ?int $id = null;
    public string $usuario = "";
    public string $email = "";
    public ?string $rol = null;

    public function __construct(?int $id = null, string $usuario = "", string $email = "", ?string $rol = "user")
    {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->email = $email;
        $this->rol = $rol;
    }
}

