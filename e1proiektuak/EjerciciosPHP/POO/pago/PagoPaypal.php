<?php

class PagoPaypal implements MetodoPago
{
    public function __construct(private string $correo) {}

    public function procesarPago(float $monto): void
    {
        echo "Pago de $$monto procesado con PayPal ($this->correo). Redirigiendo a la API...<br>";
    }
}
