<?php session_start() ?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Championnat de babyfoot</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>
        <header>
            <a href="index.php"><h1>CHAMPIONNAT DE BABYFOOT</h1></a>
            <div id="connexion">
                <a href="html/connexion.php"><button id="boutonConnexion">Connexion</button></a>
                <a href="html/creationCompte.php"><button id="boutonCreationCompte">Créer un compte</button></a>
            </div>
        </header>

        <div id="content">
            <a id="lienChampionnat" href="html/championnat.php">Championnats</a>
            <a id="lienJoueurs" href="html/joueurs.php">Joueurs</a>

        </div>
        <footer>
            <?php include'html/footer.php' ?>
        </footer>
    </body>
</html>