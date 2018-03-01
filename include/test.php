<?php

include 'utilCompil.php';
$equipeX= Equipe::findEquipe(936, $bdd);
$equipeX->attribuerNumPoule(7, $bdd);
echo'OK';
?>
