<?php include'include/menuPrincipal.php' ?>
<ul>
    <li class="lienMenuPrincipal"><a href="joueurs.php?idJ=">Moi !</a></li>
    <li class="lienMenuPrincipal"><?php if(isset($_GET['X'])){
        echo ('<a href="nouveauJoueur.php">Ajouter un nouveau joueur</a>');
    }?></li>
    <li><a></a></li>
    <li><a></a></li>
</ul>
