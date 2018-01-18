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
        <?php include'include/banniere.php';?>
        </header>

        <div id="content">
            <a id="lienChampionnat" href="championnat.php">Championnats</a>
            <a id="lienJoueurs" href="joueurs.php">Joueurs</a>

        </div>
        <footer>
            <?php include'include/footer.php' ?>
        </footer>
    </body>
</html>