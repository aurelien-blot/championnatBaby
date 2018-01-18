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
    <form method="post" action="under_connexion.php">
        <label for="nom">Nom : </label>
        <input name="nom" type="text">
        <label for="mdp">Mot de passe : </label>
        <input name="mdp" type="password">
        <input type="submit" id="submit" value="Valider">

    </form>
</div>
<footer>
    <?php include'html/footer.php' ?>
</footer>
<script src="../js/script.js"></script>
</body>
</html>
