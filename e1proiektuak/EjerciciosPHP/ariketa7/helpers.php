<?php

function validarEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function letraCorrectaDNI($dni)
{
    $letras = "TRWAGMYFPDXBNJZSQVHLCKE";

    $numero = substr($dni, 0, 8);
    $resto = $numero % 23;

    return $letras[$resto];
}

function validarDNI($dni)
{
    if (!preg_match("/^[0-9]{8}[A-Za-z]$/", $dni)) {
        return false;
    }

    $letraIntroducida = strtoupper(substr($dni, -1));
    $letraCorrecta = letraCorrectaDNI($dni);

    return $letraIntroducida === $letraCorrecta;
}

function calcularFechaDevolucion($fecha)
{
    $devolucion = new DateTime($fecha);
    $devolucion->modify("+10 days");

    return $devolucion->format("Y-m-d");
}
