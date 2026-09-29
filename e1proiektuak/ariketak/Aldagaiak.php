<?php
$nombre1 = "Egoitz"; // variable de tipo string
$nombre2 = "Guerras"; // variable de tipo string
$nivel = 22; // variable de tipo integer
$profe = TRUE; // variable de tipo boolean
$_sueldo = "poco"; // variable de tipo string, aunque el nombre de la variable empiece por un guion bajo, sigue siendo una variable normal
echo $nombre1.$nombre2.$nivel.$profe.$_sueldo; 
?>
<br>
<?php
echo "$nombre1, $nombre2, $nivel, $profe, $_sueldo"; // interpolación de variables, se pueden interpolar variables de diferentes tipos, aunque no es recomendable, para que funcione la interpolación, las variables deben estar entre comillas dobles, si están entre comillas simples, no se interpola la variable, sino que se muestra el nombre de la variable
?>