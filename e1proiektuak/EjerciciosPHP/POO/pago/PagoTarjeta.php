<?php

class PagoTarjeta implements MetodoPago
{
    public function __construct(
        private string $numeroTarjeta,
        private string $titular
    ) {}

    public function procesarPago(float $monto): void
    {
        // Ocultamos los primeros dígitos por seguridad
        $tarjetaOculta = "**** **** **** " . substr($this->numeroTarjeta, -4);
        echo "Cobrando $$monto a la tarjeta $tarjetaOculta de $this->titular. Transacción autorizada.<br>";
    }
}
