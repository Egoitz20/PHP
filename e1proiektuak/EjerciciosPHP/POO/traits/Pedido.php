<?php

// 3. Clase Pedido (También usa el Trait)
class Pedido
{
    use Loggable;

    public function __construct(
        private int $idPedido,
        private float $total
    ) {}

    public function completarOrden(): void
    {
        // Ejecución de la lógica de negocio
        echo "📦 Procesando el pago del pedido #$this->idPedido por $$this->total.<br>";

        // Reutilizamos el mismo método del Trait
        $this->registrarLog("Pedido #$this->idPedido marcado como PAGADO y COMPLETADO.");
    }
}
