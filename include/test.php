<?php
require 'class/Tournoi.php';
require 'class/Joueur.php';
require 'class/Equipe.php';

$tournoi1 = new Tournoi(8);
$j1 = new Joueur('j1');
$j2 = new Joueur('j2');
$j3 = new Joueur('j3');
$j4 = new Joueur('j4');
$j5 = new Joueur('j5');
$j6 = new Joueur('j6');
$j7 = new Joueur('j7');
$j8 = new Joueur('j8');

$tournoi1->ajouterJoueur($j1);
$tournoi1->ajouterJoueur($j2);
$tournoi1->ajouterJoueur($j3);
$tournoi1->ajouterJoueur($j4);
$tournoi1->ajouterJoueur($j5);
$tournoi1->ajouterJoueur($j6);
$tournoi1->ajouterJoueur($j7);
$tournoi1->ajouterJoueur($j8);

$list1=$tournoi1->getListeJoueurs();

foreach ($list1 as $jtest){
    echo($jtest->getNom());

}
/*
$tournoi1->creerEquipes();

echo(count($tournoi1->getListeEquipes()));
$compteur =1;
foreach ($tournoi1->getListeEquipes() as $eTest){
    echo('equipe '.$compteur);
    foreach($eTest->getJoueursEquipe() as $EP){
        echo($EP->getNom());
    };
    $compteur++;

}
*/
echo('TEST !!!');
$list2 =$tournoi1->melangerListeJoueurs($list1);
foreach($list2 as $tt){
    echo ($tt->getNom());
};

?>
