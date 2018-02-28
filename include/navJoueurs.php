<?php include'include/menuPrincipal.php' ?>
<ul>
    <li><a href="joueurs.php?idJ=">Moi !</a></li>
    <li><?php if(isset($_GET['X'])){
        echo ('<a href="nouveauJoueur.php">Ajouter un nouveau joueur</a>');
    }?></li>
    <li><a></a></li>
    <li><a></a></li>
</ul>
