<?php
/**
 * Created by PhpStorm.
 * User: Aurélien Blot
 * Date: 28/02/2018
 * Time: 11:17
 */
include 'utilCompil.php';

$joueurZ = new Joueur($_POST['nom'],$_POST['prenom'],$_POST['surnom'],$_POST['defaut'],$_POST['qualite'],'img/photo_default.png',0);
$joueurZ->insertJoueur($bdd);
header('location:../joueurs.php');

?>