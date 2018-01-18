<a href="../index.php"><h1>CHAMPIONNAT DE BABYFOOT</h1></a>
<div id="connexion">
    <?php
        if($_SESSION['nom'] == ""){
            ?>
            <a href="deconnexion.php"><button id="boutonDeconnexion">Deconnexion</button></a>
            <?php
        }
        else{?>
            <a href="html/connexion.php"><button id="boutonConnexion">Connexion</button></a>
            <a href="html/reationCompte.php"><button id="boutonCreationCompte">Créer un compte</button></a>
       <?php }
    ?>

</div>