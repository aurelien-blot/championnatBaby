<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Championnat de babyfoot</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body>
<header>
    <?php include'html/banniere.php' ?>
</header>

<div id="content">
    <p>Merci de créer votre compte :</p>
    <form method="post" action="creationCompte.php">
        <label for="nom">Nom : </label>
        <input name="nom" type="text">
        <label for="prenom">Nom : </label>
        <input name="prenom" type="text">
        <label for="pseudo">Pseudo : </label>
        <input name="pseudo" type="text">
        <label for="mdp">Mot de passe : </label>
        <input name="mdp" type="password">
        <label for="mdp2">Confirmer Mot de passe : </label>
        <input name="mdp2" type="password">
        <input type="submit" id="submit" value="Valider">

    </form>
</div>
<footer>
    <?php include'html/footer.php' ?>
</footer>
</body>
</html>
