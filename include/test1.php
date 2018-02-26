<?php
/**
 * Created by PhpStorm.
 * User: aurelien.blot
 * Date: 23/02/2018
 * Time: 10:37
 */

include 'utilCompil.php';

$tournoi1 = new Tournoi('testB3', 8, '2021-01-01', $bdd);
$tournoi1->insererTournoi($bdd);

$j1 = Joueur::findJoueur(1, $bdd);
$j2 = Joueur::findJoueur(2, $bdd);
$j3 = Joueur::findJoueur(3, $bdd);
$j4 = Joueur::findJoueur(4, $bdd);
$j5 = Joueur::findJoueur(5, $bdd);
$j6 = Joueur::findJoueur(6, $bdd);
$j7 = Joueur::findJoueur(7, $bdd);
$j8 = Joueur::findJoueur(8, $bdd);

$tournoi1->ajouterJoueur($j1);
$tournoi1->ajouterJoueur($j2);
$tournoi1->ajouterJoueur($j3);
$tournoi1->ajouterJoueur($j4);
$tournoi1->ajouterJoueur($j5);
$tournoi1->ajouterJoueur($j6);
$tournoi1->ajouterJoueur($j7);
$tournoi1->ajouterJoueur($j8);

$tournoi1->creerEquipes($bdd);
echo("insertEquipe : ok");


$tournoi1->organiserMatchs($bdd);



?>