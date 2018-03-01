<?php include'include/connexionBdd.php';?>
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
		<p>Merci de créer votre compte :</p>
		<form method="post" action="include/under_creationcompte.php" onsubmit="return verifAll(this)" enctype="multipart/form-data">
			<p><label for="nom">Nom : </label>
			<input name="nom" type="text" onblur="verifPseudo(this)" required></p>

			<p><label for="prenom">Prénom : </label>
			<input name="prenom" type="text" onblur="verifPseudo(this)" required></p>

			<p><label for="pseudo">Pseudo : </label>
			<input name="pseudo" type="text" onblur="verifPseudo(this)" required></p>

			<p><label for="photo">Photo : </label>
			<input type="hidden" name="MAX_FILE_SIZE" value="12345" />
			<input name="photo" type="file" id="photo"></p>

			<p><label for="mdp1">Mot de passe : </label>
			<input name="mdp1" type="password" onblur="verifPseudo(this)" required></p>

			<p><label for="mdp2">Confirmer Mot de passe : </label>
			<input name="mdp2" type="password" required></p>

			<p><label for="defaut">Votre plus gros défaut : </label>
			<input name="defaut" type="text" required></p>

			<p><label for="qualite">Si vous en avez, une qualité : </label>
			<input name="qualite" type="text" required></p>

			<p><input type="submit" id="submit" value="Valider"></p>

		</form>
	</div>
</div>
<footer>
	<div class="wrap">
    	<?php include'include/footer.php' ?>
	</div>

</footer>

	<script src="js/verifform.js"></script>
</body>
</html>
