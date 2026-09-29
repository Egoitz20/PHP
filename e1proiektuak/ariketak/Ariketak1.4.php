<?php
/* Kontua Blokeatu Balio Batetik: 
PHP erabiliz, erabiltzaile batek sartutako PIN zenbakia zuzena edo okerra den adierazi 
(sartutako PINa aldagai baten gordeko da eta benetakoa beste baten).*/ 

$erabiltzailePin = 1234; // Erabiltzaileak sartutako PINa
$benetakoPin = 5678; // Benetako PINa

if ($erabiltzailePin == $benetakoPin) {
    echo "PIN zuzena da";
} else {
    echo "PIN okerra da";
}

?>