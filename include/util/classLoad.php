<?php
/**
 * Created by PhpStorm.
 * User: aurelien.blot
 * Date: 20/02/2018
 * Time: 15:40
 */
function loadClasses(){
    require 'class/Tournoi.php';
    require 'class/Joueur.php';
    require 'class/Equipe.php';
    require 'class/Match.php';
    require 'class/ConnexionBdd.php';
    require 'class/EquipeInconnue.php';
    require 'class/JoueurInconnu.php';
}

spl_autoload_register('loadClasses');
?>