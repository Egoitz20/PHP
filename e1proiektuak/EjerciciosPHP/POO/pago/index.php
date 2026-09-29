<?php

include "MetodoPago.php";
include "PagoTarjeta.php";
include "PagoPaypal.php";
include "PagoCrypto.php";
include "CarritoCompras.php";

// Creamos un carrito y añadimos productos
$miCarrito = new CarritoCompras();
$miCarrito->agregarProducto("Laptop Pro", 1200.50);
$miCarrito->agregarProducto("Mouse Ergonómico", 45.00);

// Escenario A: El usuario elige pagar con PayPal
$paypal = new PagoPayPal("usuario@correo.com");
$miCarrito->pagar($paypal);

echo "<br>";

// Escenario B: El usuario cambia de opinión y elige Tarjeta
$tarjeta = new PagoTarjeta("4556123456789012", "Juan Pérez");
$miCarrito->pagar($tarjeta);

echo "<br>";

// Escenario C: El usuario prefiere pagar con Criptomonedas
$crypto = new PagoCrypto("0x71C...3A9");
$miCarrito->pagar($crypto);
