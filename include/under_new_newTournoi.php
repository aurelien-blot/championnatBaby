<?php
/**
 * Created by PhpStorm.
 * User: aurelien.blot
 * Date: 20/02/2018
 * Time: 15:36
 */

include 'utilCompil.php';

$tournoiX = new Tournoi($_POST['nbreJoueurs'], $_POST['nomChamp']);

$tournoiX->ajouterJoueur();
$tournoiX->creerEquipes();
$tournoiX->organiserMatchs();

$tournoiX
?>