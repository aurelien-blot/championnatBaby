<?php session_start();
include'include/connexionBdd.php';?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Championnat de babyfoot</title>

    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<header>
	<div class="wrap">
    	<?php include'include/banniere.php' ?>
	</div>
</header>

<div id="content">
	<div class="wrap">
		<form method="post" action="include/under_connexion.php">
        <label for="nom">Nom : </label>
        <input name="nom" type="text">
        <label for="mdp">Mot de passe : </label>
        <input name="mdp" type="password">
        <input type="submit" id="submit" value="Valider">

    </form>
	</div>
</div>
<footer>
	<div class="wrap">
    	<?php include'include/footer.php' ?>
	</div>
</footer>

<script src="../js/script.js"></script>

</body>
</html>
