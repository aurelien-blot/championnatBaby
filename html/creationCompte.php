<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Championnat de babyfoot</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body>
<header>
    <?php include'banniere.php' ?>
</header>

<div id="content">
    <p>Merci de créer votre compte :</p>
    <form method="post" action="creationCompte.php">
        <label for="nom">Nom : </label>
        <input id="pseudo" type="text">
        <label for="pseudo">Pseudo : </label>
        <input id="pseudo" type="text">
        <label for="mdp">Mot de passe : </label>
        <input id="mdp" type="password">
        <label for="mdp2">Confirmer Mot de passe : </label>
        <input id="mdp2" type="password">
        <input type="submit" id="submit" value="Valider">

    </form>
</div>
<footer>
    <?php include'footer.php' ?>
</footer>
</body>
</html>
