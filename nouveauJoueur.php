<?php session_start();

include 'utilCompilDir.php';
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ajout d'un nouveau Joueur</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<header>
    <div class="wrap">
        <?php include'include/banniere.php'; ?>
    </div>
</header>

<div id="content">
    <div class="wrap">
        <nav>
            <?php include'include/navJoueurs.php'; ?>
        </nav>
        <form method="post" action="include/under_nouveauJoueur.php">
            <label for="nom">Nom : </label>
            <input type="text" name="nom"/>
            <label for="prenom">Prenom : </label>
            <input type="text" name="prenom"/>
            <label for="surnom">Surnom : </label>
            <input type="text" name="surnom"/>
            <label for="qualite">Qualité : </label>
            <input type="text" name="qualite"/>
            <label for="defaut">Défaut : </label>
            <input type="text" name="defaut"/>

            <input type="submit" value="Valider">

        </form>
    </div>
</div>
<footer>
    <div class="wrap">
        <?php include'include/footer.php'; ?>
    </div>

</footer>
</body>
</html>
