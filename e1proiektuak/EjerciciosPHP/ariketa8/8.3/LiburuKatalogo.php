<?php

class LiburuKatalogo
{

    private array $liburuArray;

    public function __construct()
    {
        $this->liburuArray = [];
    }

    public function gehituLiburua($liburua)
    {
        $this->liburuArray[] = $liburua;
    }

    public function katalogoaBistaratu()
    {
        $liburuak = $this->liburuArray;

        echo "<ul>";
        foreach ($liburuak as $liburua) {
            echo "<li>";
            echo $liburua->izena;
            echo " (Egilea: ";
            echo $liburua->egilea;
            echo ")";
            echo "</li>";
        }
        echo "</ul>";
    }
}
