<?php
/**
 * Created by PhpStorm.
 * User: aurelien.blot
 * Date: 20/02/2018
 * Time: 15:40
 */
function loadClasses(){
    require 'include/class/ConnexionBdd.php';
    require 'include/class/Tournoi.php';
    require 'include/class/Joueur.php';
    require 'include/class/Equipe.php';
    require 'include/class/Match.php';
}

spl_autoload_register('loadClasses');
?>