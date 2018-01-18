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
    <form method="post" action="creationCompte.php">
        <label for="pseudo">Nom : </label>
        <input id="pseudo" type="text">
        <label for="mdp">Mot de passe : </label>
        <input id="mdp" type="password">
        <input type="submit" id="submit" value="Valider">

    </form>
</div>
<footer>
    <?php include'footer.php' ?>
</footer>
</body>
</html>
