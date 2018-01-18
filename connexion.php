<?php session_start(); ?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Championnat de babyfoot</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body>
<header>
    <a href="index.php"><h1>CHAMPIONNAT DE BABYFOOT</h1></a>
</header>

<div id="content">
    <form method="post" action="include/under_connexion.php">
        <label for="nom">Nom : </label>
        <input name="nom" type="text">
        <label for="mdp">Mot de passe : </label>
        <input name="mdp" type="password">
        <input type="submit" id="submit" value="Valider">

    </form>
</div>
<footer>
    <?php include'include/footer.php' ?>
</footer>
<script src="../js/script.js"></script>
</body>
</html>
