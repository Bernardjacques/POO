<?php

require 'voiture.php';
require 'date.php';

$audi = new voiture();
$audi->name ='Audi';
$audi->name();
$audi->modele();
$audi->kilometre();
$audi->weight();
$audi->immatriculation();
$audi->datecirculation();
echo "<br>-------------<br>";

$mercedes = new voiture("vw", "golf", "champagne", "350 000", "1 Tonne 8");
$mercedes->name = 'Vw';
echo $mercedes->name;

?>