<?php
include 'utilCompil.php';

$nbreJoueurs = intval($_GET['nbreJoueurs']);

$tournoiX = new Tournoi($_POST['nomChamp'],intval($_POST['nbreJoueurs']), $_POST['dateDebut'],$bdd);
$tournoiX->insererTournoi($bdd);

$reqIdC = $bdd->prepare('SELECT * FROM competitions WHERE nomChamp = ?');

$j1 = Joueur::findJoueur(1, $bdd);
$j2 = Joueur::findJoueur(2, $bdd);
$j3 = Joueur::findJoueur(3, $bdd);
$j4 = Joueur::findJoueur(4, $bdd);
$j5 = Joueur::findJoueur(5, $bdd);
$j6 = Joueur::findJoueur(6, $bdd);
$j7 = Joueur::findJoueur(7, $bdd);
$j8 = Joueur::findJoueur(8, $bdd);

$tournoiX->ajouterJoueur($j1);
$tournoiX->ajouterJoueur($j2);
$tournoiX->ajouterJoueur($j3);
$tournoiX->ajouterJoueur($j4);
$tournoiX->ajouterJoueur($j5);
$tournoiX->ajouterJoueur($j6);
$tournoiX->ajouterJoueur($j7);
$tournoiX->ajouterJoueur($j8);

$tournoiX->creerEquipes($bdd);

$tournoiX->organiserMatchs($bdd);

// CA MARCHE



header('location:../championnat.php?idC='.$tournoiX->getIdCompet());

?>