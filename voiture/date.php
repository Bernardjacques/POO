<?php

$date_debut = new DateTime("2017-11-14");
$date_fin = new DateTime();
$interval = $date_fin->diff($date_debut);
echo $interval->format('%a jour(s) %h heure(s) %i minute(s) %s seconde(s)');

?>