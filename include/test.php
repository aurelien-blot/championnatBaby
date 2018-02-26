<?php

include 'utilCompil.php';
$matchY = Match::findMatch(123, $bdd);
echo($matchY->getEquipe1()->getNomEquipe());
?>
