<?php

class PagoCrypto implements MetodoPago
{
    public function __construct(private string $walletAddress) {}

    public function procesarPago(float $monto): void
    {
        echo "Procesando $$monto en la red Blockchain a la billetera $this->walletAddress. Esperando confirmaciones.<br>";
    }
}
