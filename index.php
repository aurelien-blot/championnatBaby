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
        <?php include'html/banniere.php';?>
        </header>

        <div id="content">
            <a id="lienChampionnat" href="championnat.php">Championnats</a>
            <a id="lienJoueurs" href="joueurs.php">Joueurs</a>

        </div>
        <footer>
            <?php include'html/footer.php' ?>
        </footer>
    </body>
</html>