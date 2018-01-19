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
		<form method="post" action="creationCompte.php" onsubmit="return verifAll(this)">
			<label for="nom">Nom : </label>
			<input id="nom" type="text" onblur="verifPseudo(this)" required>

			<label for="prenom">Prénom : </label>
			<input id="prenom" type="text" onblur="verifPseudo(this)" required>

			<label for="pseudo">Pseudo : </label>
			<input id="pseudo" type="text" onblur="verifPseudo(this)" required>

			<label for="photo">Photo : </label>
			<input id="photo" type="file">

			<label for="mdp1">Mot de passe : </label>
			<input id="mdp1" type="password" onblur="verifPseudo(this)" required>

			<label for="mdp2">Confirmer Mot de passe : </label>
			<input id="mdp2" type="password" required>

			<input type="submit" id="submit" value="Valider">

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
