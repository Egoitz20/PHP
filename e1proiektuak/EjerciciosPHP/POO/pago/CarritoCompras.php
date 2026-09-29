<?php

class CarritoCompras
{
    private array $productos = [];

    public function agregarProducto(string $nombre, float $precio): void
    {
        $this->productos[] = ['nombre' => $nombre, 'precio' => $precio];
    }

    public function obtenerTotal(): float
    {
        return array_sum(array_column($this->productos, 'precio'));
    }

    // Inyección de dependencias: Obligamos a que use el contrato MetodoPago
    public function pagar(MetodoPago $sistemaPago): void
    {
        $total = $this->obtenerTotal();
        echo "Procesando el carrito de compras...<br>";
        $sistemaPago->procesarPago($total);
    }
}
