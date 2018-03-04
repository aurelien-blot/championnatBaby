<?php

include 'utilCompil.php';
$j1 = Joueur::findJoueur(1, $bdd);
$j2 = Joueur::findJoueur(2, $bdd);
$j3 = Joueur::findJoueur(3, $bdd);
$j4 = Joueur::findJoueur(4, $bdd);
$j5 = Joueur::findJoueur(5, $bdd);
$j6 = Joueur::findJoueur(6, $bdd);

$tabTest = array();
$tabTest[]= $j5;
$tabTest[]= $j4;
$tabTest[]= $j2;
$tabTest[]= $j3;
$tabTest[]= $j1;
$tabTest[]= $j6;

foreach($tabTest as $test){
    echo($test->getIdJoueur());
}

function trierTab($obj1, $obj2){
    $a=$obj1->getIdJoueur();
    $b=$obj2->getIdJoueur();
    return strcasecmp($b, $a);
}
uasort($tabTest, "trierTab");

foreach($tabTest as $test){
    echo($test->getIdJoueur());
}
?>
