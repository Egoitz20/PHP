<?php

interface MetodoPago
{
    public function procesarPago(float $monto): void;
}
