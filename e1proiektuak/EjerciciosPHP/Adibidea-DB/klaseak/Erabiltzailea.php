<?php

/**
 * Erabiltzaile bat adierazten du (erabiltzaileak taulako errenkada bat).
 *
 * Propietateen izenak taulako zutabeen izen berdinak izan behar dira,
 * PDO::FETCH_CLASS-ek zutabe bakoitza izen bereko propietatean gordetzen baitu.
 */
class Erabiltzailea {
    // null izan daiteke: erabiltzaile berri batek ez du id-rik datu-basean gorde arte.
    public ?int $id = null;
    public string $izena = '';

    function __construct($i = "") {
        $this->izena = $i;

    }
}
