<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Consigna 1, nros consecutivos del 1 al 100.
for ($i = 1; $i <= 100; $i++) {
    echo $i . "<br>";
}

//consigna 2,muestra nros pares.
for ($i = 2; $i <= 100; $i += 2) {
    echo $i . "<br>";
}

//consigna 3, cuando llega al 60 se interrumpe con break.
for ($i = 2; $i <= 100; $i += 2) {
    echo $i . "<br>";
    if ($i == 60) {
        break;
    }
}

?>